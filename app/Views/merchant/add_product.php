<?php
$validation = $validation ?? \Config\Services::validation();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/merchantcss') ?>">
</head>
<body>
<div class="container">
    <a href="<?= base_url('merchant/dashboard') ?>" class="back-link">
        ← Kembali ke Dashboard
    </a>

    <div class="form-card">
        <h1 class="form-title">Tambah Produk Baru</h1>

        <form action="<?= base_url('merchant/products/store') ?>" method="POST">

            <div class="form-group">
                <label>Nama Produk <span>*</span></label>
                <input type="text" name="name" value="<?= old('name') ?>" required>
                <?php if ($validation->hasError('name')): ?>
                    <div class="error-message"><?= $validation->getError('name') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Deskripsi <span>*</span></label>
                <textarea name="description" required><?= old('description') ?></textarea>
                <?php if ($validation->hasError('description')): ?>
                    <div class="error-message"><?= $validation->getError('description') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Harga <span>*</span></label>
                    <input type="number" name="price" value="<?= old('price') ?>" required>
                    <?php if ($validation->hasError('price')): ?>
                        <div class="error-message"><?= $validation->getError('price') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Stok <span>*</span></label>
                    <input type="number" name="stock" value="<?= old('stock') ?>" required>
                    <?php if ($validation->hasError('stock')): ?>
                        <div class="error-message"><?= $validation->getError('stock') ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label>Varian</label>
                <input type="text" name="variant" value="<?= old('variant') ?>">
            </div>

            <div class="form-group">
                <label>Lokasi <span>*</span></label>
                <input type="text" name="location" value="<?= old('location') ?>" required>
                <?php if ($validation->hasError('location')): ?>
                    <div class="error-message"><?= $validation->getError('location') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>URL Gambar</label>
                <input type="url" name="image_url" value="<?= old('image_url') ?>">
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                <a href="<?= base_url('merchant/dashboard') ?>" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>
</body>
</html>
