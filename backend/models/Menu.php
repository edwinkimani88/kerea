<?php
/**
 * KEREA — Menu Model
 * Database operations for managing Header and Footer menus and menu links.
 */
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../core/Auth.php';

class Menu
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Get all menus ────────────────────────────────────────
    public function listMenus(): array
    {
        return $this->db->fetchAll('SELECT * FROM `menus` ORDER BY `id` ASC');
    }

    // ── Get all items for a specific menu (flat, sorted) ─────
    public function getItems(int $menuId): array
    {
        return $this->db->fetchAll(
            'SELECT * FROM `menu_items` 
              WHERE `menu_id` = :mid 
              ORDER BY `parent_id` ASC, `sort_order` ASC, `id` ASC',
            [':mid' => $menuId]
        );
    }

    // ── Get a single menu item by ID ─────────────────────────
    public function findItemById(int $id): array|false
    {
        return $this->db->fetchOne('SELECT * FROM `menu_items` WHERE `id` = :id LIMIT 1', [':id' => $id]);
    }

    // ── Save menu item (Create or Update) ────────────────────
    public function saveItem(array $data): array
    {
        $clean = [
            'menu_id'    => Security::int($data['menu_id'] ?? 0),
            'parent_id'  => !empty($data['parent_id']) ? Security::int($data['parent_id']) : null,
            'label'      => Security::clean($data['label'] ?? ''),
            'url'        => Security::clean($data['url'] ?? ''),
            'target'     => in_array($data['target'] ?? '_self', ['_self', '_blank']) ? $data['target'] : '_self',
            'icon'       => !empty($data['icon']) ? Security::clean($data['icon']) : null,
            'sort_order' => isset($data['sort_order']) ? Security::int($data['sort_order']) : 0,
            'is_active'  => isset($data['is_active']) ? (int)(bool)$data['is_active'] : 1
        ];

        if (empty($clean['label'])) {
            return ['success' => false, 'message' => 'Label is required.'];
        }
        if (empty($clean['url'])) {
            return ['success' => false, 'message' => 'URL is required.'];
        }

        $id = Security::int($data['id'] ?? 0);

        if ($id > 0) {
            // Update
            $this->db->update('menu_items', $clean, 'id = :id', [':id' => $id]);
            Auth::log('menu.item_update', 'menu', $id, "Updated menu item: {$clean['label']}");
            return ['success' => true, 'id' => $id];
        } else {
            // Insert
            $newId = $this->db->insert('menu_items', $clean);
            Auth::log('menu.item_create', 'menu', $newId, "Created menu item: {$clean['label']}");
            return ['success' => true, 'id' => $newId];
        }
    }

    // ── Delete menu item ─────────────────────────────────────
    public function deleteItem(int $id): bool
    {
        // Set children's parent_id to null or delete? In schema: ON DELETE SET NULL on parent_id
        $rows = $this->db->delete('menu_items', 'id = :id', [':id' => $id]);
        Auth::log('menu.item_delete', 'menu', $id, "Deleted menu item ID: {$id}");
        return $rows > 0;
    }

    // ── Reorder items in a menu ──────────────────────────────
    public function updateSort(array $orders): bool
    {
        try {
            $this->db->beginTransaction();
            foreach ($orders as $item) {
                $id = Security::int($item['id'] ?? 0);
                $sort = Security::int($item['sort_order'] ?? 0);
                if ($id > 0) {
                    $this->db->update('menu_items', ['sort_order' => $sort], 'id = :id', [':id' => $id]);
                }
            }
            $this->db->commit();
            Auth::log('menu.reorder', 'menu', null, "Reordered menu items");
            return true;
        } catch (Throwable $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
