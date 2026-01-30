<?php
session_start();

// Menghapus semua data session
session_unset();

// Menghancurkan session yang tersisa
session_destroy();

// Mengarahkan kembali ke halaman login dengan pesan sukses
header("Location: index.php?pesan=logout_berhasil");
exit();
?>