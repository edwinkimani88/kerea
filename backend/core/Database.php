<?php
/**
 * KEREA — Core Database PDO Wrapper
 * Singleton pattern with prepared statement helpers.
 * PHP 8+ | PDO | utf8mb4
 */
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    // ── Constructor ──────────────────────────────────────────
    private function __construct()
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST, DB_NAME, DB_CHARSET
        );

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            (defined('Pdo\Mysql::ATTR_INIT_COMMAND') ? \Pdo\Mysql::ATTR_INIT_COMMAND : \PDO::MYSQL_ATTR_INIT_COMMAND) => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
        ];

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log error, show safe message to user
            error_log('[KEREA DB] Connection failed: ' . $e->getMessage());
            throw new RuntimeException('Database connection failed. Please try again later.');
        }
    }

    // ── Singleton Access ─────────────────────────────────────
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // ── Prevent cloning / unserialization ───────────────────
    private function __clone() {}
    public function __wakeup(): void { throw new \Exception('Cannot unserialize singleton.'); }

    // ── Raw PDO Access ───────────────────────────────────────
    public function pdo(): PDO
    {
        return $this->pdo;
    }

    // ── Execute a prepared statement and return statement ────
    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // ── Fetch all rows ───────────────────────────────────────
    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    // ── Fetch single row ─────────────────────────────────────
    public function fetchOne(string $sql, array $params = []): array|false
    {
        return $this->query($sql, $params)->fetch();
    }

    // ── Fetch single scalar value ────────────────────────────
    public function fetchColumn(string $sql, array $params = [], int $col = 0): mixed
    {
        return $this->query($sql, $params)->fetchColumn($col);
    }

    // ── Insert row, return last insert ID ────────────────────
    public function insert(string $table, array $data): int
    {
        $table  = $this->sanitizeIdentifier($table);
        $cols   = array_keys($data);
        $placeholders = array_map(fn($c) => ':' . $c, $cols);

        $sql = sprintf(
            'INSERT INTO `%s` (%s) VALUES (%s)',
            $table,
            implode(', ', array_map(fn($c) => '`' . $c . '`', $cols)),
            implode(', ', $placeholders)
        );

        $this->query($sql, $data);
        return (int) $this->pdo->lastInsertId();
    }

    // ── Update rows by condition ─────────────────────────────
    public function update(string $table, array $data, string $where, array $whereParams = []): int
    {
        $table = $this->sanitizeIdentifier($table);
        $sets  = array_map(fn($c) => '`' . $c . '` = :' . $c, array_keys($data));

        $sql = sprintf(
            'UPDATE `%s` SET %s WHERE %s',
            $table,
            implode(', ', $sets),
            $where
        );

        $stmt = $this->query($sql, array_merge($data, $whereParams));
        return $stmt->rowCount();
    }

    // ── Delete rows by condition ─────────────────────────────
    public function delete(string $table, string $where, array $params = []): int
    {
        $table = $this->sanitizeIdentifier($table);
        $stmt  = $this->query("DELETE FROM `{$table}` WHERE {$where}", $params);
        return $stmt->rowCount();
    }

    // ── Paginated query helper ───────────────────────────────
    public function paginate(string $sql, array $params, int $page, int $perPage): array
    {
        $page    = max(1, $page);
        $offset  = ($page - 1) * $perPage;

        // Count total
        $countSql = preg_replace('/SELECT .+? FROM/is', 'SELECT COUNT(*) FROM', $sql, 1);
        $countSql = preg_replace('/ORDER BY .+$/is', '', $countSql);
        $total    = (int) $this->fetchColumn($countSql, $params);

        // Paginated results
        $rows = $this->fetchAll($sql . " LIMIT {$perPage} OFFSET {$offset}", $params);

        return [
            'data'         => $rows,
            'total'        => $total,
            'per_page'     => $perPage,
            'current_page' => $page,
            'last_page'    => (int) ceil($total / $perPage),
        ];
    }

    // ── Transactions ─────────────────────────────────────────
    public function beginTransaction(): void { $this->pdo->beginTransaction(); }
    public function commit(): void           { $this->pdo->commit(); }
    public function rollBack(): void         { $this->pdo->rollBack(); }

    // ── Prevent SQL injection in identifiers ─────────────────
    private function sanitizeIdentifier(string $name): string
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
            throw new InvalidArgumentException("Invalid DB identifier: {$name}");
        }
        return $name;
    }
}
