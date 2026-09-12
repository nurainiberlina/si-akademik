<?php
namespace App\Repositories;
class MahasiswaRepository
{
    public function __construct(private \PDO $pdo) {}
    public function all(): array
    {
        $stmt = $this->pdo->query(
            "SELECT m.*, p.nama AS prodi_nama
             FROM mahasiswa m
             JOIN prodi p ON m.prodi_id = p.id
             ORDER BY m.nim"
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function search(string $keyword): array
    {
        $stmt = $this->pdo->prepare(
            "SELECT m.*, p.nama AS prodi_nama
             FROM mahasiswa m
             JOIN prodi p ON m.prodi_id = p.id
             WHERE m.nama LIKE :keyword OR m.nim LIKE :keyword
             ORDER BY m.nim"
        );
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function find(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mahasiswa WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ?: null;
    }
    public function create(array $data): int
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan)
             VALUES (:nim, :nama, :email, :prodi_id, :angkatan)"
        );
        $stmt->execute($data);
        return (int) $this->pdo->lastInsertId();
    }
    public function update(int $id, array $data): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE mahasiswa 
             SET nim = :nim, nama = :nama, email = :email, prodi_id = :prodi_id, angkatan = :angkatan
             WHERE id = :id"
        );
        $data['id'] = $id;
        return $stmt->execute($data);
    }
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM mahasiswa WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}