<?php

namespace App\Controllers;

use App\Models\Prodi;

class ProdiController
{
    public function index()
    {
        $model = new Prodi();
        $daftarProdi = $model->all();

        echo "<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'>
              <title>Daftar Prodi</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
              </head><body><div class='container mt-4'>";
        echo "<h1 class='mb-4'>Daftar Program Studi</h1>";
        echo "<a href='/si-akademik/public/prodi/create' class='btn btn-primary mb-3'>Tambah Prodi</a>";
        echo "<table class='table table-bordered table-striped'>
                <thead class='table-dark'><tr><th>Kode</th><th>Nama Prodi</th></tr></thead><tbody>";

        foreach ($daftarProdi as $prodi) {
            echo "<tr>
                    <td>" . htmlspecialchars($prodi['kode']) . "</td>
                    <td>" . htmlspecialchars($prodi['nama']) . "</td>
                  </tr>";
        }

        echo "</tbody></table></div></body></html>";
    }

    public function create()
    {
        echo "<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'>
              <title>Tambah Prodi</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
              </head><body><div class='container mt-4'>";
        echo "<h1 class='mb-4'>Tambah Program Studi</h1>";
        echo "<form method='POST' action='/si-akademik/public/prodi'>
                <div class='mb-3'>
                  <label class='form-label'>Kode</label>
                  <input type='text' name='kode' class='form-control' required>
                </div>
                <div class='mb-3'>
                  <label class='form-label'>Nama Prodi</label>
                  <input type='text' name='nama' class='form-control' required>
                </div>
                <button type='submit' class='btn btn-primary'>Simpan</button>
                <a href='/si-akademik/public/prodi' class='btn btn-secondary'>Batal</a>
              </form></div></body></html>";
    }

    public function store()
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');

        $model = new Prodi();
        $model->create([
            'kode' => $kode,
            'nama' => $nama,
        ]);

        header('Location: /si-akademik/public/prodi');
        exit;
    }
}