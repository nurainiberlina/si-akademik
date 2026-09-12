<?php

namespace App\Models;

use App\Core\Model;

class MahasiswaModel extends Model
{
    protected string $table = 'mahasiswa';

    public function all(): array
    {
        $stmt = $this->db->query(
            "SELECT m.*, p.nama AS prodi_nama 
             FROM mahasiswa m
             JOIN prodi p ON m.prodi_id = p.id
             ORDER BY m.nim"
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search(string $keyword): array
    {
        $stmt = $this->db->prepare(
            "SELECT m.*, p.nama AS prodi_nama 
             FROM mahasiswa m
             JOIN prodi p ON m.prodi_id = p.id
             WHERE m.nama LIKE :keyword OR m.nim LIKE :keyword
             ORDER BY m.nim"
        );
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}