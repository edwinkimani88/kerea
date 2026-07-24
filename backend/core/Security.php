<?php
/**
 * KEREA — Security Utilities
 * XSS filtering, input validation, output sanitization.
 * Used throughout backend before any data is processed or output.
 */
declare(strict_types=1);

class Security
{
    // ── Output sanitization (always call before echoing user data) ──
    public static function esc(mixed $value): string
    {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    // ── Sanitize a string input (strip tags, trim) ──────────────────
    public static function clean(mixed $value): string
    {
        return trim(strip_tags((string)($value ?? '')));
    }

    // ── Sanitize integer ────────────────────────────────────────────
    public static function int(mixed $value): int
    {
        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    // ── Sanitize float ──────────────────────────────────────────────
    public static function float(mixed $value): float
    {
        return (float) filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    // ── Validate email ──────────────────────────────────────────────
    public static function validateEmail(string $email): bool
    {
        return (bool) filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

    // ── Validate URL ─────────────────────────────────────────────────
    public static function validateUrl(string $url): bool
    {
        return (bool) filter_var(trim($url), FILTER_VALIDATE_URL);
    }

    // ── Sanitize a URL value ─────────────────────────────────────────
    public static function url(string $url): string
    {
        return filter_var(trim($url), FILTER_SANITIZE_URL) ?: '';
    }

    // ── Validate string length ───────────────────────────────────────
    public static function validateLength(string $value, int $min = 0, int $max = PHP_INT_MAX): bool
    {
        $len = mb_strlen(trim($value));
        return $len >= $min && $len <= $max;
    }

    // ── Validate password strength ───────────────────────────────────
    // Requires: min 8 chars, 1 uppercase, 1 lowercase, 1 number
    public static function validatePassword(string $password): bool
    {
        if (strlen($password) < 8) return false;
        if (!preg_match('/[A-Z]/', $password)) return false;
        if (!preg_match('/[a-z]/', $password)) return false;
        if (!preg_match('/[0-9]/', $password)) return false;
        return true;
    }

    // ── Hash a password ──────────────────────────────────────────────
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    // ── Verify a password ────────────────────────────────────────────
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    // ── Generate a secure random token ──────────────────────────────
    public static function generateToken(int $bytes = 32): string
    {
        return bin2hex(random_bytes($bytes));
    }

    // ── Generate a URL-safe slug from a string ───────────────────────
    public static function slug(string $text): string
    {
        $text = mb_strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        return trim($text, '-');
    }

    // ── Sanitize file name ───────────────────────────────────────────
    public static function sanitizeFilename(string $filename): string
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $ext  = pathinfo($filename, PATHINFO_EXTENSION);
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
        $ext  = preg_replace('/[^a-zA-Z0-9]/', '', $ext);
        return strtolower($name . '.' . $ext);
    }

    // ── Sanitize rich HTML content (basic — strip dangerous tags) ────
    public static function sanitizeHtml(string $html): string
    {
        $allowed = '<p><br><b><strong><i><em><u><ul><ol><li><h2><h3><h4>'
                 . '<blockquote><a><img><table><thead><tbody><tr><th><td>'
                 . '<span><div><figure><figcaption>';
        return strip_tags($html, $allowed);
    }

    // ── Truncate a string to max chars, preserving words ────────────
    public static function truncate(string $text, int $max = 160, string $suffix = '…'): string
    {
        $text = strip_tags($text);
        if (mb_strlen($text) <= $max) return $text;
        return mb_substr($text, 0, $max) . $suffix;
    }

    // ── Get real client IP ───────────────────────────────────────────
    public static function clientIp(): string
    {
        $keys = ['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','REMOTE_ADDR'];
        foreach ($keys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = trim(explode(',', $_SERVER[$key])[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
            }
        }
        return '0.0.0.0';
    }

    // ── JSON response helper ─────────────────────────────────────────
    public static function jsonResponse(bool $success, string $message, array $data = [], int $status = 200): never
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // ── Rate limit check (simple session-based) ──────────────────────
    public static function rateLimit(string $key, int $maxAttempts = 5, int $windowSeconds = 300): bool
    {
        $sessionKey = 'rl_' . $key;
        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = ['count' => 0, 'reset' => time() + $windowSeconds];
        }
        if (time() > $_SESSION[$sessionKey]['reset']) {
            $_SESSION[$sessionKey] = ['count' => 0, 'reset' => time() + $windowSeconds];
        }
        $_SESSION[$sessionKey]['count']++;
        return $_SESSION[$sessionKey]['count'] <= $maxAttempts;
    }
}
