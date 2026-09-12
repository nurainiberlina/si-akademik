<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h1 class="mb-4">Tambah Mahasiswa</h1>
    <form method="POST" action="/si-akademik/public/mahasiswa">
      <div class="mb-3">
        <label class="form-label">NIM</label>
        <input type="text" name="nim" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Prodi</label>
        <select name="prodi_id" class="form-select" required>
          <?php foreach ($daftarProdi as $prodi): ?>
            <option value="<?= $prodi['id'] ?>"><?= htmlspecialchars($prodi['nama']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Angkatan</label>
        <input type="number" name="angkatan" class="form-control" value="<?= date('Y') ?>" required>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="/si-akademik/public/mahasiswa" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>