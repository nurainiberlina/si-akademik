<?php

namespace App\Controllers;

use App\Models\MataKuliah;
use App\Models\Prodi;

class MataKuliahController
{
    public function index()
    {
        $model = new MataKuliah();
        $daftarMatkul = $model->all();

        echo "<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'>
              <title>Daftar Mata Kuliah</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
              </head><body><div class='container mt-4'>";
        echo "<h1 class='mb-4'>Daftar Mata Kuliah</h1>";
        echo "<a href='/si-akademik/public/matakuliah/create' class='btn btn-primary mb-3'>Tambah Mata Kuliah</a>";
        echo "<table class='table table-bordered table-striped'>
                <thead class='table-dark'><tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Prodi</th></tr></thead><tbody>";

        foreach ($daftarMatkul as $mk) {
            echo "<tr>
                    <td>" . htmlspecialchars($mk['kode']) . "</td>
                    <td>" . htmlspecialchars($mk['nama']) . "</td>
                    <td>" . htmlspecialchars($mk['sks']) . "</td>
                    <td>" . htmlspecialchars($mk['prodi_nama']) . "</td>
                  </tr>";
        }

        echo "</tbody></table></div></body></html>";
    }

    public function create()
    {
        $prodiModel = new Prodi();
        $daftarProdi = $prodiModel->all();

        echo "<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'>
              <title>Tambah Mata Kuliah</title>
              <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
              </head><body><div class='container mt-4'>";
        echo "<h1 class='mb-4'>Tambah Mata Kuliah</h1>";
        echo "<form method='POST' action='/si-akademik/public/matakuliah'>
                <div class='mb-3'>
                  <label class='form-label'>Kode</label>
                  <input type='text' name='kode' class='form-control' required>
                </div>
                <div class='mb-3'>
                  <label class='form-label'>Nama Mata Kuliah</label>
                  <input type='text' name='nama' class='form-control' required>
                </div>
                <div class='mb-3'>
                  <label class='form-label'>SKS</label>
                  <input type='number' name='sks' class='form-control' required>
                </div>
                <div class='mb-3'>
                  <label class='form-label'>Prodi</label>
                  <select name='prodi_id' class='form-select' required>";
        foreach ($daftarProdi as $prodi) {
            echo "<option value='{$prodi['id']}'>" . htmlspecialchars($prodi['nama']) . "</option>";
        }
        echo "        </select>
                </div>
                <button type='submit' class='btn btn-primary'>Simpan</button>
                <a href='/si-akademik/public/matakuliah' class='btn btn-secondary'>Batal</a>
              </form></div></body></html>";
    }

    public function store()
    {
        $kode = trim($_POST['kode'] ?? '');
        $nama = trim($_POST['nama'] ?? '');
        $sks = (int)($_POST['sks'] ?? 0);
        $prodi_id = (int)($_POST['prodi_id'] ?? 0);

        $model = new MataKuliah();
        $model->create([
            'kode' => $kode,
            'nama' => $nama,
            'sks' => $sks,
            'prodi_id' => $prodi_id,
        ]);

        header('Location: /si-akademik/public/matakuliah');
        exit;
    }
}