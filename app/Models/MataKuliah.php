<?php

namespace App\Models;

use App\Core\Model;

class MataKuliah extends Model
{
    protected string $table = 'matakuliah';

    public function all(): array
    {
        $stmt = $this->db->query(
            "SELECT mk.*, p.nama AS prodi_nama 
             FROM matakuliah mk
             JOIN prodi p ON mk.prodi_id = p.id
             ORDER BY mk.kode"
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}