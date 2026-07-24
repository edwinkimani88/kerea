<?php
/**
 * KEREA — Secure File Uploader
 * MIME validation, size limits, safe renaming, image resizing awareness.
 * PHP 8+ | GD optional for image info
 */
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/Security.php';

class Uploader
{
    /** Allowed MIME types grouped by type */
    private const ALLOWED_MIMES = [
        'image' => ['image/jpeg','image/png','image/gif','image/webp','image/svg+xml'],
        'document' => [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'text/plain',
            'text/csv',
        ],
        'video'  => ['video/mp4','video/webm','video/ogg'],
        'audio'  => ['audio/mpeg','audio/ogg','audio/wav'],
    ];

    private const UPLOAD_BASE  = UPLOAD_DIR;
    private const UPLOAD_URL_BASE = UPLOAD_URL;

    // ── Upload a single file ─────────────────────────────────
    /**
     * @param array  $file       $_FILES['field_name']
     * @param string $subdir     Subdirectory under uploads/ (e.g. 'images', 'documents')
     * @param array  $types      Allowed type groups: ['image','document']
     * @param int    $maxBytes   Max file size in bytes (default: MAX_FILE_SIZE)
     * @return array             ['success'=>bool, 'message'=>string, 'file'=>array|null]
     */
    public static function upload(
        array  $file,
        string $subdir  = 'general',
        array  $types   = ['image','document'],
        int    $maxBytes = MAX_FILE_SIZE
    ): array {
        // 1. Basic error check
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return self::fail(self::uploadError($file['error'] ?? -1));
        }

        // 2. Size check
        if ($file['size'] > $maxBytes) {
            $mb = round($maxBytes / 1024 / 1024, 0);
            return self::fail("File is too large. Maximum size is {$mb}MB.");
        }

        // 3. MIME validation (use finfo, NOT just extension)
        $finfo    = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);
        $allowed  = self::allowedMimes($types);

        if (!in_array($mimeType, $allowed, true)) {
            return self::fail("File type not allowed ({$mimeType}).");
        }

        // 4. Build safe destination
        $ext       = self::mimeToExt($mimeType);
        $safeName  = Security::generateToken(16) . '_' . time() . '.' . $ext;
        $year      = date('Y');
        $month     = date('m');
        $destDir   = self::UPLOAD_BASE . "{$subdir}/{$year}/{$month}/";
        $destPath  = $destDir . $safeName;
        $destUrl   = self::UPLOAD_URL_BASE . "{$subdir}/{$year}/{$month}/{$safeName}";

        // 5. Create directory
        if (!is_dir($destDir) && !mkdir($destDir, 0755, true)) {
            return self::fail('Upload directory could not be created.');
        }

        // 6. Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $destPath)) {
            return self::fail('Failed to save uploaded file.');
        }

        // 7. Image metadata
        $width = $height = null;
        if (str_starts_with($mimeType, 'image/') && function_exists('getimagesize')) {
            [$width, $height] = getimagesize($destPath) ?: [null, null];
        }

        return [
            'success'       => true,
            'message'       => 'File uploaded successfully.',
            'file'          => [
                'filename'      => $safeName,
                'original_name' => $file['name'],
                'file_path'     => $destPath,
                'file_url'      => $destUrl,
                'mime_type'     => $mimeType,
                'file_size'     => $file['size'],
                'width'         => $width,
                'height'        => $height,
            ],
        ];
    }

    // ── Delete a file from the filesystem ────────────────────
    public static function delete(string $filePath): bool
    {
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath);
        }
        return false;
    }

    // ── Human-readable file size ─────────────────────────────
    public static function humanSize(int $bytes): string
    {
        $units = ['B','KB','MB','GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 1) . ' ' . $units[$i];
    }

    // ── Private helpers ──────────────────────────────────────
    private static function fail(string $message): array
    {
        return ['success' => false, 'message' => $message, 'file' => null];
    }

    private static function allowedMimes(array $types): array
    {
        $mimes = [];
        foreach ($types as $t) {
            if (isset(self::ALLOWED_MIMES[$t])) {
                $mimes = array_merge($mimes, self::ALLOWED_MIMES[$t]);
            }
        }
        return $mimes;
    }

    private static function mimeToExt(string $mime): string
    {
        $map = [
            'image/jpeg'    => 'jpg',
            'image/png'     => 'png',
            'image/gif'     => 'gif',
            'image/webp'    => 'webp',
            'image/svg+xml' => 'svg',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'text/plain' => 'txt',
            'text/csv'   => 'csv',
            'video/mp4'  => 'mp4',
            'video/webm' => 'webm',
            'audio/mpeg' => 'mp3',
        ];
        return $map[$mime] ?? 'bin';
    }

    private static function uploadError(int $code): string
    {
        return match ($code) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'File exceeds maximum allowed size.',
            UPLOAD_ERR_PARTIAL   => 'File was only partially uploaded.',
            UPLOAD_ERR_NO_FILE   => 'No file was uploaded.',
            UPLOAD_ERR_NO_TMP_DIR=> 'Missing temporary folder.',
            UPLOAD_ERR_CANT_WRITE=> 'Failed to write file to disk.',
            default              => 'Unknown upload error.',
        };
    }
}
