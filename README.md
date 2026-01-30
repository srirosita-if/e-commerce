# 🛒 MANDALA - Aplikasi E-Commerce Sederhana

Aplikasi penjualan produk berbasis web yang dibangun untuk memenuhi tugas pemrograman. Proyek ini mencakup fitur autentikasi, manajemen produk, keranjang belanja, hingga proses checkout.

---

## 👤 Identitas Mahasiswa
* **Nama** : Sri Rosita
* **NIM** : 2341042
* **Prodi** : Teknik Informatika

---

## 🚀 Fitur Utama (MANDALA)
1.  **Halaman Login**: Autentikasi pengguna menggunakan session PHP.
2.  **Halaman Dashboard**: Menampilkan daftar produk secara dinamis dari database MySQL.
3.  **Halaman Daftar Produk**: Pengguna dapat memilih produk untuk dimasukkan ke keranjang.
4.  **Halaman Keranjang**: Fitur CRUD (Create, Read, Update, Delete) item belanja di dalam session.
5.  **Halaman Checkout**: Ringkasan pembayaran dan penyimpanan data pesanan secara permanen ke database.

## 🛠️ Teknologi yang Digunakan
* **Frontend**: HTML5, CSS3 (Custom & Bootstrap 5), JavaScript.
* **Backend**: PHP (Procedural).
* **Database**: MySQL.

## 📂 Struktur Database
Proyek ini menggunakan database `mandala_db` dengan tabel-tabel berikut:
- `users`: Data akun pelanggan.
- `products`: Informasi produk (nama, harga, stok).
- `categories`: Pengelompokan jenis produk.
- `orders`: Data utama transaksi.
- `order_details`: Rincian item yang dibeli per transaksi.

## ⚙️ Cara Instalasi
1. Clone repositori ini atau download sebagai ZIP.
2. Letakkan folder proyek di dalam direktori `htdocs` (jika menggunakan XAMPP).
3. Import file database (SQL) yang tersedia ke dalam **phpMyAdmin**.
4. Sesuaikan konfigurasi database di file `config.php`.
5. Akses melalui browser di `http://localhost/nama_folder_kamu/index.php`.

---
*Proyek ini dikembangkan untuk tujuan pembelajaran di Prodi Teknik Informatika.*
