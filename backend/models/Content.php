<?php
/**
 * KEREA — Content Model
 * Generic CRUD for: news, blog, publications, knowledge_hub,
 * downloads, success_stories, faqs, testimonials, partners, team_members.
 */
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../core/Auth.php';

class Content
{
    private Database $db;

    /** Allowed content types mapped to their DB tables */
    private const TABLE_MAP = [
        'news'           => 'news_articles',
        'blog'           => 'blog_posts',
        'publication'    => 'publications',
        'knowledge_hub'  => 'knowledge_hub',
        'download'       => 'downloads',
        'success_story'  => 'success_stories',
        'faq'            => 'faqs',
        'testimonial'    => 'testimonials',
        'partner'        => 'partners',
        'team'           => 'team_members',
        'hero_slide'     => 'hero_slides',
        'page'           => 'pages',
        'event'          => 'events',
        'workshop'       => 'workshops',
        'training_programme' => 'training_programmes',
    ];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Resolve table from content type ─────────────────────
    private function table(string $type): string
    {
        if (!isset(self::TABLE_MAP[$type])) {
            throw new InvalidArgumentException("Unknown content type: {$type}");
        }
        return self::TABLE_MAP[$type];
    }

    // ── List content with pagination & search ────────────────
    public function list(
        string $type,
        int    $page    = 1,
        int    $perPage = 20,
        string $search  = '',
        string $status  = '',
        string $category= ''
    ): array {
        $table  = $this->table($type);
        $where  = ['1=1'];
        $params = [];

        if ($search) {
            $where[] = '(title LIKE :s OR description LIKE :s)';
            $params[':s'] = '%' . $search . '%';
        }
        if ($status) {
            $where[] = 'status = :status';
            $params[':status'] = $status;
        }
        if ($category) {
            $where[] = 'category = :cat';
            $params[':cat'] = $category;
        }

        $orderBy = $this->defaultOrder($table);
        $sql = "SELECT * FROM `{$table}` WHERE " . implode(' AND ', $where) . " ORDER BY {$orderBy}";

        return $this->db->paginate($sql, $params, $page, $perPage);
    }

    // ── Get a single item by ID ──────────────────────────────
    public function findById(string $type, int $id): array|false
    {
        $table = $this->table($type);
        return $this->db->fetchOne("SELECT * FROM `{$table}` WHERE id = :id LIMIT 1", [':id' => $id]);
    }

    // ── Get a single item by slug ────────────────────────────
    public function findBySlug(string $type, string $slug): array|false
    {
        $table = $this->table($type);
        return $this->db->fetchOne("SELECT * FROM `{$table}` WHERE slug = :slug LIMIT 1", [':slug' => $slug]);
    }

    // ── Create a new content item ────────────────────────────
    public function create(string $type, array $data): array
    {
        $table = $this->table($type);
        $data  = $this->sanitize($data);

        // Auto-generate slug for types that need it
        if (in_array($type, ['news','blog','publication','knowledge_hub','success_story','event','workshop','training_programme'])) {
            if (empty($data['slug']) && !empty($data['title'])) {
                $data['slug'] = $this->uniqueSlug($table, Security::slug($data['title']));
            }
        }

        // Set author if user is logged in
        if (in_array($type, ['news','blog']) && Auth::id()) {
            $data['author_id'] = Auth::id();
        }

        // Set published_at if publishing
        if (($data['status'] ?? '') === 'published' && empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $id = $this->db->insert($table, $data);
        Auth::log("{$type}.create", $type, $id, "Created: " . ($data['title'] ?? $id));
        return ['success' => true, 'id' => $id];
    }

    // ── Update an existing content item ──────────────────────
    public function update(string $type, int $id, array $data): array
    {
        $table = $this->table($type);
        $data  = $this->sanitize($data);

        // Regenerate slug only if title changed and no explicit slug given
        if (empty($data['slug']) && !empty($data['title'])) {
            $existing = $this->findById($type, $id);
            if ($existing && $existing['title'] !== $data['title']) {
                $data['slug'] = $this->uniqueSlug($table, Security::slug($data['title']), $id);
            }
        }

        if (($data['status'] ?? '') === 'published') {
            $existing = $this->findById($type, $id);
            if ($existing && empty($existing['published_at'])) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
        }

        $rows = $this->db->update($table, $data, 'id = :id', [':id' => $id]);
        Auth::log("{$type}.update", $type, $id, "Updated item {$id}");
        return ['success' => true, 'rows' => $rows];
    }

    // ── Delete a content item ────────────────────────────────
    public function delete(string $type, int $id): array
    {
        $table = $this->table($type);
        $rows  = $this->db->delete($table, 'id = :id', [':id' => $id]);
        Auth::log("{$type}.delete", $type, $id, "Deleted item {$id}");
        return ['success' => $rows > 0, 'rows' => $rows];
    }

    // ── Toggle a boolean field (e.g. featured, is_active) ────
    public function toggle(string $type, int $id, string $field): array
    {
        $table    = $this->table($type);
        $allowed  = ['is_active','featured','status'];
        if (!in_array($field, $allowed) && !str_starts_with($field, 'is_')) {
            return ['success' => false, 'message' => 'Field not toggleable.'];
        }
        $this->db->query(
            "UPDATE `{$table}` SET `{$field}` = NOT `{$field}` WHERE id = :id",
            [':id' => $id]
        );
        $row = $this->db->fetchOne("SELECT `{$field}` FROM `{$table}` WHERE id = :id", [':id' => $id]);
        return ['success' => true, 'value' => $row[$field] ?? null];
    }

    // ── Get featured / recent items for frontend ─────────────
    public function featured(string $type, int $limit = 6): array
    {
        $table = $this->table($type);
        $cols  = ['news','blog','publication','success_story']
               ? 'id, title, slug, excerpt, category, published_at, image_id, featured'
               : '*';
        try {
            return $this->db->fetchAll(
                "SELECT {$cols} FROM `{$table}` WHERE status = 'published' AND featured = 1 ORDER BY published_at DESC LIMIT :lim",
                [':lim' => $limit]
            );
        } catch (Throwable) {
            return $this->db->fetchAll(
                "SELECT * FROM `{$table}` WHERE status IN ('published','active') LIMIT :lim",
                [':lim' => $limit]
            );
        }
    }

    // ── Get recent items ─────────────────────────────────────
    public function recent(string $type, int $limit = 5): array
    {
        $table = $this->table($type);
        $order = $this->defaultOrder($table);
        try {
            return $this->db->fetchAll(
                "SELECT * FROM `{$table}` WHERE status IN ('published','active') ORDER BY {$order} LIMIT :lim",
                [':lim' => $limit]
            );
        } catch (Throwable) {
            return $this->db->fetchAll("SELECT * FROM `{$table}` ORDER BY id DESC LIMIT :lim", [':lim' => $limit]);
        }
    }

    // ── Dashboard stats across content types ─────────────────
    public function dashboardStats(): array
    {
        return [
            'news'       => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM news_articles WHERE status='published'"),
            'events'     => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM events WHERE status='upcoming'"),
            'publications'=> (int)$this->db->fetchColumn("SELECT COUNT(*) FROM publications WHERE status='published'"),
            'members'    => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM users WHERE status='active'"),
            'messages'   => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM contact_messages WHERE status='unread'"),
            'partners'   => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM partners WHERE is_active=1"),
        ];
    }

    // ── Increment view count ──────────────────────────────────
    public function incrementViews(string $type, int $id): void
    {
        $table = $this->table($type);
        try {
            $this->db->query("UPDATE `{$table}` SET views = views + 1 WHERE id = :id", [':id' => $id]);
        } catch (Throwable) {}
    }

    // ── Helpers ──────────────────────────────────────────────
    private function sanitize(array $data): array
    {
        $clean = [];
        foreach ($data as $key => $val) {
            if ($key === 'content') {
                $clean[$key] = Security::sanitizeHtml((string)$val);
            } elseif (in_array($key, ['image_id','file_id','author_id','sort_order','capacity'])) {
                $clean[$key] = Security::int($val);
            } elseif (in_array($key, ['is_active','featured','is_board'])) {
                $clean[$key] = (int)(bool)$val;
            } elseif (in_array($key, ['fee'])) {
                $clean[$key] = Security::float($val);
            } elseif (in_array($key, ['url','cta_url','website_url','registration_url','linkedin_url'])) {
                $clean[$key] = Security::url((string)$val);
            } else {
                $clean[$key] = Security::clean((string)$val);
            }
        }
        return $clean;
    }

    private function uniqueSlug(string $table, string $slug, int $excludeId = 0): string
    {
        $base     = $slug;
        $counter  = 1;
        while (true) {
            $sql  = "SELECT COUNT(*) FROM `{$table}` WHERE slug = :slug AND id != :id";
            $count = (int)$this->db->fetchColumn($sql, [':slug' => $slug, ':id' => $excludeId]);
            if ($count === 0) break;
            $slug = $base . '-' . $counter++;
        }
        return $slug;
    }

    private function defaultOrder(string $table): string
    {
        return match ($table) {
            'hero_slides','menu_items','partners','team_members','faqs','testimonials' => 'sort_order ASC, id ASC',
            'events','workshops' => 'start_date ASC',
            default              => 'created_at DESC',
        };
    }
}
