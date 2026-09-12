<?php

namespace App\Repositories;

class ProdiRepository
{
    public function __construct(private \PDO $pdo) {}

    public function all(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM prodi ORDER BY nama");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}