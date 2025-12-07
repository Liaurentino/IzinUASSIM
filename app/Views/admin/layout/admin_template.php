<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <header class="admin-header">
        <h1>Administrasi Sistem</h1>
    </header>
    
    <main>

        <?= $this->renderSection('content') ?>
    </main>

</body>
</html>