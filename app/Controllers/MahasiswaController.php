<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Database;
use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
class MahasiswaController extends Controller
{
    private MahasiswaRepository $mahasiswaRepo;
    private ProdiRepository $prodiRepo;
    public function __construct()
    {
        $pdo = Database::getConnection();
        $this->mahasiswaRepo = new MahasiswaRepository($pdo);
        $this->prodiRepo = new ProdiRepository($pdo);
    }
    public function index(): void
    {
        $keyword = $_GET['q'] ?? '';
        $daftarMahasiswa = $keyword !== ''
            ? $this->mahasiswaRepo->search($keyword)
            : $this->mahasiswaRepo->all();

        $this->view('mahasiswa/index', [
            'title' => 'Daftar Mahasiswa',
            'daftarMahasiswa' => $daftarMahasiswa,
        ]);
    }
    public function create(): void
    {
        $daftarProdi = $this->prodiRepo->all();
        $this->view('mahasiswa/create', [
            'title' => 'Tambah Mahasiswa',
            'daftarProdi' => $daftarProdi,
        ]);
    }
    public function store(): void
    {
        $this->mahasiswaRepo->create([
            'nim' => trim($_POST['nim'] ?? ''),
            'nama' => trim($_POST['nama'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'prodi_id' => (int) ($_POST['prodi_id'] ?? 0),
            'angkatan' => (int) ($_POST['angkatan'] ?? date('Y')),
        ]);
        $this->redirect('/si-akademik/public/mahasiswa');
    }
    public function edit($id): void
    {
        $mahasiswa = $this->mahasiswaRepo->find((int) $id);
        $daftarProdi = $this->prodiRepo->all();
        $this->view('mahasiswa/edit', [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswa,
            'daftarProdi' => $daftarProdi,
        ]);
    }
    public function update($id): void
    {
        $this->mahasiswaRepo->update((int) $id, [
            'nim' => trim($_POST['nim'] ?? ''),
            'nama' => trim($_POST['nama'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'prodi_id' => (int) ($_POST['prodi_id'] ?? 0),
            'angkatan' => (int) ($_POST['angkatan'] ?? date('Y')),
        ]);
        $this->redirect('/si-akademik/public/mahasiswa');
    }
    public function destroy($id): void
    {
        $this->mahasiswaRepo->delete((int) $id);
        $this->redirect('/si-akademik/public/mahasiswa');
    }
    public function show($id): void
    {
        $mahasiswa = $this->mahasiswaRepo->find((int) $id);
        if (!$mahasiswa) {
            http_response_code(404);
            echo "Mahasiswa tidak ditemukan";
            return;
        }
        echo "<h2>Detail Mahasiswa</h2>";
        echo "<p>NIM: {$mahasiswa['nim']}</p>";
        echo "<p>Nama: {$mahasiswa['nama']}</p>";
        echo "<p>Email: {$mahasiswa['email']}</p>";
    }
}

