<?php
$conn = mysqli_connect("localhost", "root", "", "mandala_db");
session_start();

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>