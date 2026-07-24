<?php
/**
 * KEREA — Site Settings Model
 * Read/write all site settings from MySQL (replaces settings.json).
 * Includes in-memory caching per request.
 */
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../core/Auth.php';

class Setting
{
    private Database $db;
    private static array $cache = [];
    private static bool  $loaded = false;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Load all settings into static cache ─────────────────
    private function loadAll(): void
    {
        if (self::$loaded) return;
        $rows = $this->db->fetchAll('SELECT setting_key, setting_val FROM site_settings ORDER BY sort_order');
        foreach ($rows as $row) {
            self::$cache[$row['setting_key']] = $row['setting_val'];
        }
        self::$loaded = true;
    }

    // ── Get all settings as key→value array ──────────────────
    public function all(): array
    {
        $this->loadAll();
        return self::$cache;
    }

    // ── Get a single setting ─────────────────────────────────
    public function get(string $key, mixed $default = ''): mixed
    {
        $this->loadAll();
        $val = self::$cache[$key] ?? null;
        if ($val === null) return $default;
        // Convert boolean string
        if ($val === '1') return true;
        if ($val === '0') return false;
        return $val;
    }

    // ── Get all settings grouped by group_name ───────────────
    public function grouped(): array
    {
        $rows = $this->db->fetchAll(
            'SELECT * FROM site_settings ORDER BY group_name, sort_order'
        );
        $grouped = [];
        foreach ($rows as $row) {
            $grouped[$row['group_name']][] = $row;
        }
        return $grouped;
    }

    // ── Save multiple settings at once ───────────────────────
    public function saveMultiple(array $data): array
    {
        $errors = [];
        $saved  = 0;

        foreach ($data as $key => $value) {
            // Sanitize key
            if (!preg_match('/^[a-z0-9_]+$/', $key)) {
                $errors[] = "Invalid setting key: {$key}";
                continue;
            }
            $result = $this->save($key, $value);
            if ($result) $saved++;
        }

        // Bust cache
        self::$cache  = [];
        self::$loaded = false;

        Auth::log('settings.save', 'settings', null, "Saved {$saved} settings");

        return [
            'success' => empty($errors),
            'saved'   => $saved,
            'errors'  => $errors,
        ];
    }

    // ── Save a single setting ────────────────────────────────
    public function save(string $key, mixed $value): bool
    {
        $key   = preg_replace('/[^a-z0-9_]/', '', strtolower($key));
        $value = is_bool($value) ? ($value ? '1' : '0') : (string)$value;

        // Check if key exists
        $exists = $this->db->fetchColumn(
            'SELECT COUNT(*) FROM site_settings WHERE setting_key = :k',
            [':k' => $key]
        );

        if ($exists) {
            $this->db->update(
                'site_settings',
                ['setting_val' => $value],
                'setting_key = :k',
                [':k' => $key]
            );
        } else {
            // Auto-create new key
            $this->db->insert('site_settings', [
                'setting_key' => $key,
                'setting_val' => $value,
                'group_name'  => 'custom',
            ]);
        }

        // Update local cache immediately
        self::$cache[$key] = $value;
        return true;
    }

    // ── Delete a setting ─────────────────────────────────────
    public function delete(string $key): bool
    {
        $rows = $this->db->delete('site_settings', 'setting_key = :k', [':k' => $key]);
        unset(self::$cache[$key]);
        return $rows > 0;
    }

    // ── Static shorthand (for use in templates) ───────────────
    public static function getValue(string $key, mixed $default = ''): mixed
    {
        static $instance = null;
        if ($instance === null) {
            try {
                $instance = new self();
            } catch (Throwable) {
                return $default;
            }
        }
        return $instance->get($key, $default);
    }
}
