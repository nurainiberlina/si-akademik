<?php

namespace App\Core;

class Model
{
    protected \PDO $db;
    protected string $table = '';

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

        $this->db = new \PDO($dsn, $config['username'], $config['password']);
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create(array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})"
        );
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $setParts = [];
        foreach (array_keys($data) as $col) {
            $setParts[] = "{$col} = :{$col}";
        }
        $setClause = implode(', ', $setParts);

        $data['id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET {$setClause} WHERE id = :id"
        );
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}