<?php
/**
 * KEREA — Media Library Model
 * Handles file uploads to DB + filesystem.
 */
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Uploader.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Security.php';

class Media
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // ── Upload a file and record in media_library ────────────
    public function upload(array $file, string $type = 'general', array $meta = []): array
    {
        $types   = ($type === 'image') ? ['image'] : ['image','document','video','audio'];
        $result  = Uploader::upload($file, $type, $types);

        if (!$result['success']) return $result;

        $f   = $result['file'];
        $id  = $this->db->insert('media_library', [
            'uploaded_by'   => Auth::id(),
            'filename'      => $f['filename'],
            'original_name' => $f['original_name'],
            'file_path'     => $f['file_path'],
            'file_url'      => $f['file_url'],
            'mime_type'     => $f['mime_type'],
            'file_size'     => $f['file_size'],
            'alt_text'      => Security::clean($meta['alt_text'] ?? ''),
            'caption'       => Security::clean($meta['caption']  ?? ''),
            'width'         => $f['width'],
            'height'        => $f['height'],
        ]);

        Auth::log('media.upload', 'media', $id, "Uploaded: {$f['original_name']}");

        return [
            'success' => true,
            'message' => 'File uploaded successfully.',
            'media'   => array_merge($f, ['id' => $id]),
        ];
    }

    // ── List media library with pagination ───────────────────
    public function list(int $page = 1, int $perPage = 40, string $type = '', string $search = ''): array
    {
        $where  = ['1=1'];
        $params = [];

        if ($type === 'image') {
            $where[] = "mime_type LIKE 'image/%'";
        } elseif ($type === 'document') {
            $where[] = "mime_type NOT LIKE 'image/%' AND mime_type NOT LIKE 'video/%' AND mime_type NOT LIKE 'audio/%'";
        }
        if ($search) {
            $where[] = '(original_name LIKE :s OR alt_text LIKE :s)';
            $params[':s'] = '%' . $search . '%';
        }

        $sql = 'SELECT m.*, u.first_name, u.last_name FROM media_library m
                LEFT JOIN users u ON u.id = m.uploaded_by
                WHERE ' . implode(' AND ', $where) . '
                ORDER BY m.created_at DESC';

        return $this->db->paginate($sql, $params, $page, $perPage);
    }

    // ── Get single media item ────────────────────────────────
    public function findById(int $id): array|false
    {
        return $this->db->fetchOne('SELECT * FROM media_library WHERE id = :id', [':id' => $id]);
    }

    // ── Delete a media item ──────────────────────────────────
    public function delete(int $id): array
    {
        $media = $this->findById($id);
        if (!$media) return ['success' => false, 'message' => 'File not found.'];

        Uploader::delete($media['file_path']);
        $this->db->delete('media_library', 'id = :id', [':id' => $id]);
        Auth::log('media.delete', 'media', $id, "Deleted: {$media['original_name']}");
        return ['success' => true, 'message' => 'File deleted.'];
    }

    // ── Update alt text / caption ────────────────────────────
    public function update(int $id, array $data): array
    {
        $this->db->update(
            'media_library',
            [
                'alt_text' => Security::clean($data['alt_text'] ?? ''),
                'caption'  => Security::clean($data['caption']  ?? ''),
            ],
            'id = :id',
            [':id' => $id]
        );
        return ['success' => true];
    }

    // ── Stats ─────────────────────────────────────────────────
    public function stats(): array
    {
        return [
            'total'     => (int)$this->db->fetchColumn('SELECT COUNT(*) FROM media_library'),
            'images'    => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM media_library WHERE mime_type LIKE 'image/%'"),
            'documents' => (int)$this->db->fetchColumn("SELECT COUNT(*) FROM media_library WHERE mime_type LIKE 'application/%' OR mime_type LIKE 'text/%'"),
            'total_size'=> (int)$this->db->fetchColumn('SELECT SUM(file_size) FROM media_library'),
        ];
    }
}
