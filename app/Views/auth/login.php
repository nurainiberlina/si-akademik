<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login SI Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container" style="max-width: 400px;">
    <div class="card p-4 shadow-sm">
        <h4 class="mb-3 text-center">Login Sistem</h4>
        <?php if (!empty($_SESSION['flash'])): ?>
            <div class="alert alert-<?= $_SESSION['flash']['type']; ?>">
                <?= $_SESSION['flash']['message']; ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        <form action="/si-akademik/public/login" method="POST">
            <div class="mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
    </div>
</div>
</body>
</html>
