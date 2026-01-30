<?php
include 'config.php';

// Proteksi halaman: Jika belum login, tendang ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Jika keranjang kosong, balikkan ke dashboard
if (empty($_SESSION['cart'])) {
    echo "<script>alert('Keranjang Anda kosong!'); window.location='dashboard.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$total_bayar = 0;
$items = [];

// Hitung total harga berdasarkan database (lebih aman daripada input user)
foreach ($_SESSION['cart'] as $id => $qty) {
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $p = mysqli_fetch_assoc($res);
    $subtotal = $p['price'] * $qty;
    $total_bayar += $subtotal;
    $items[] = [
        'id' => $id,
        'qty' => $qty,
        'subtotal' => $subtotal
    ];
}

// Logika ketika tombol "Bayar Sekarang" diklik
if (isset($_POST['proses_bayar'])) {
    // 1. Simpan ke tabel orders
    $insert_order = mysqli_query($conn, "INSERT INTO orders (user_id, total_price, status) VALUES ('$user_id', '$total_bayar', 'pending')");
    $order_id = mysqli_insert_id($conn);

    if ($insert_order) {
        // 2. Simpan detail produk ke tabel order_details
        foreach ($items as $item) {
            $p_id = $item['id'];
            $qty = $item['qty'];
            $sub = $item['subtotal'];
            mysqli_query($conn, "INSERT INTO order_details (order_id, product_id, quantity, subtotal) VALUES ('$order_id', '$p_id', '$qty', '$sub')");
        }

        // 3. Kosongkan keranjang
        unset($_SESSION['cart']);
        
        echo "<script>alert('Pesanan Berhasil! ID Pesanan Anda: #$order_id'); window.location='dashboard.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - MANDALA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h4 class="mb-4">Konfirmasi Pesanan</h4>
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): 
                                $id_p = $item['id'];
                                $p_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT name, price FROM products WHERE id=$id_p"));
                            ?>
                            <tr>
                                <td><?= $p_info['name']; ?></td>
                                <td>Rp <?= number_format($p_info['price'], 0, ',', '.'); ?></td>
                                <td><?= $item['qty']; ?></td>
                                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 text-white bg-dark">
                <div class="card-body">
                    <h5>Ringkasan Pembayaran</h5>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Belanja</span>
                        <span>Rp <?= number_format($total_bayar, 0, ',', '.'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span>Biaya Admin</span>
                        <span class="text-success">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="h5">Total Bayar</span>
                        <span class="h5">Rp <?= number_format($total_bayar, 0, ',', '.'); ?></span>
                    </div>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select class="form-select bg-light text-dark" required>
                                <option value="">Pilih Metode...</option>
                                <option value="transfer">Transfer Bank (Mandala Pay)</option>
                                <option value="cod">Bayar di Tempat (COD)</option>
                            </select>
                        </div>
                        <button type="submit" name="proses_bayar" class="btn btn-primary w-100 py-2 fw-bold">PROSES PEMBAYARAN</button>
                    </form>
                </div>
            </div>
            <a href="cart.php" class="btn btn-link text-dark mt-2 text-decoration-none">← Kembali ke Keranjang</a>
        </div>
    </div>
</div>

</body>
</html>