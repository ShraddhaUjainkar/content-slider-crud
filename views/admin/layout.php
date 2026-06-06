<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - <?= e(APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-navy shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="<?= e(admin_url()) ?>">WPoets Admin</a>
        <div class="d-flex gap-2">
            <a class="btn btn-sm btn-outline-light" href="../index.php" target="_blank">View Site</a>
        </div>
    </div>
</nav>

<main class="container py-4">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= e($error) ?></div>
    <?php endif; ?>

    <ul class="nav nav-pills mb-4">
        <li class="nav-item">
            <a class="nav-link <?= $resource === 'tabs' ? 'active' : '' ?>" href="<?= e(admin_url('resource=tabs')) ?>">Tabs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $resource === 'slides' ? 'active' : '' ?>" href="<?= e(admin_url('resource=slides')) ?>">Slides</a>
        </li>
    </ul>

    <?php if ($resource === 'slides'): ?>
        <?php require __DIR__ . '/slides.php'; ?>
    <?php else: ?>
        <?php require __DIR__ . '/tabs.php'; ?>
    <?php endif; ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
