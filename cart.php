<?php
include 'config.php';

// Fitur Tambah (Create)
if(isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    header("Location: dashboard.php");
}

// Fitur Hapus (Delete)
if(isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    header("Location: cart.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang - Mandala</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h3>Keranjang Belanja Anda</h3>
        <table>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
            <?php 
            if(!empty($_SESSION['cart'])):
                foreach($_SESSION['cart'] as $id => $qty): 
                    $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
                    $p = mysqli_fetch_assoc($res);
            ?>
            <tr>
                <td><?php echo $p['name']; ?></td>
                <td><?php echo $qty; ?></td>
                <td><a href="cart.php?remove=<?php echo $id; ?>" class="btn-danger">Hapus</a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td colspan="3">Keranjang kosong.</td></tr>
            <?php endif; ?>
        </table>
        <br>
        <a href="checkout.php" class="btn">Lanjut ke Checkout</a>
    </div>
</body>
</html>