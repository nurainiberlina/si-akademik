<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-4">
    <h1 class="mb-4">Daftar Mahasiswa</h1>

    <a href="/si-akademik/public/mahasiswa/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

    <form method="GET" action="/si-akademik/public/mahasiswa" class="mb-3 d-flex gap-2">
      <input type="text" name="q" class="form-control" placeholder="Cari nama atau NIM..."
             value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
      <button type="submit" class="btn btn-secondary">Cari</button>
    </form>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>NIM</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Prodi</th>
          <th>Angkatan</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($daftarMahasiswa as $mhs): ?>
        <tr>
          <td><?= htmlspecialchars($mhs['nim']) ?></td>
          <td><?= htmlspecialchars($mhs['nama']) ?></td>
          <td><?= htmlspecialchars($mhs['email']) ?></td>
          <td><?= htmlspecialchars($mhs['prodi_nama']) ?></td>
          <td><?= htmlspecialchars($mhs['angkatan']) ?></td>
          <td><?= htmlspecialchars($mhs['status']) ?></td>
          <td>
            <a href="/si-akademik/public/mahasiswa/<?= $mhs['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>
            <form action="/si-akademik/public/mahasiswa/<?= $mhs['id'] ?>/delete" method="POST" style="display:inline"
                  onsubmit="return confirm('Yakin mau hapus data ini?');">
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-end mt-3">
     <a href="/si-akademik/public/logout" class="btn btn-danger mb-3">Logout</a>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

