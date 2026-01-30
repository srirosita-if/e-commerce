<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Mandala Shop - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h2>Mandala E-Commerce</h2>
        <nav>
            <a href="dashboard.php">Produk</a> | 
            <a href="cart.php">Keranjang (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
        </nav>
    </header>

    <main class="container">
        <h3>Daftar Produk</h3>
        <div class="product-grid">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM products");
            while($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <h4><?php echo $row['name']; ?></h4>
                <p>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="add_to_cart" class="btn">Tambah ke Keranjang</button>
                </form>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
</body>
</html>