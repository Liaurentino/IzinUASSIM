<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Servify</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .back-link {
            color: #687bdb;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .form-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-title {
            font-size: 28px;
            color: #687bdb;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group label span {
            color: #e74c3c;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #687bdb;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
            flex: 1;
        }

        .btn-primary {
            background: #687bdb;
            color: white;
        }

        .btn-primary:hover {
            background: #5568c3;
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #666;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .form-hint {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }
    </style>
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
                    <label for="name">Nama Produk <span>*</span></label>
                    <input type="text" id="name" name="name" class="form-control" 
                           value="<?= old('name') ?>" placeholder="Contoh: Laptop Asus ROG" required>
                    <?php if ($validation->getError('name')): ?>
                        <div class="error-message"><?= $validation->getError('name') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi Produk <span>*</span></label>
                    <textarea id="description" name="description" class="form-control" 
                              placeholder="Deskripsikan produk Anda dengan detail..." required><?= old('description') ?></textarea>
                    <?php if ($validation->getError('description')): ?>
                        <div class="error-message"><?= $validation->getError('description') ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Harga (Rp) <span>*</span></label>
                        <input type="number" id="price" name="price" class="form-control" 
                               value="<?= old('price') ?>" placeholder="15000000" required>
                        <?php if ($validation->getError('price')): ?>
                            <div class="error-message"><?= $validation->getError('price') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stok <span>*</span></label>
                        <input type="number" id="stock" name="stock" class="form-control" 
                               value="<?= old('stock') ?>" placeholder="10" required>
                        <?php if ($validation->getError('stock')): ?>
                            <div class="error-message"><?= $validation->getError('stock') ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="variant">Varian</label>
                        <input type="text" id="variant" name="variant" class="form-control" 
                               value="<?= old('variant') ?>" placeholder="Warna, Ukuran, dll">
                    </div>

                    <div class="form-group">
                        <label for="location">Lokasi <span>*</span></label>
                        <input type="text" id="location" name="location" class="form-control" 
                               value="<?= old('location') ?>" placeholder="Jakarta" required>
                        <?php if ($validation->getError('location')): ?>
                            <div class="error-message"><?= $validation->getError('location') ?></div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_url">URL Gambar</label>
                    <input type="url" id="image_url" name="image_url" class="form-control" 
                           value="<?= old('image_url') ?>" placeholder="https://example.com/image.jpg">
                    <div class="form-hint">Kosongkan jika ingin menggunakan gambar default</div>
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