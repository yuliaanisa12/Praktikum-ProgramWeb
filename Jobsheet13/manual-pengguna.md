# Manual Pengguna SIMPUS-Mini

## 1. Pendahuluan

SIMPUS-Mini adalah aplikasi perpustakaan sederhana yang digunakan untuk mengelola data buku, data anggota, peminjaman buku, pengembalian buku, dan riwayat peminjaman. Manual ini dibuat untuk membantu pengguna memahami cara menggunakan aplikasi.

## 2. Cara Menjalankan Aplikasi

1. Jalankan layanan PostgreSQL dan pastikan database `simpus_mini` tersedia.
2. Buka terminal pada folder project SIMPUS-Mini.
3. Jalankan server PHP sesuai konfigurasi project.
4. Buka browser dan akses `http://localhost:8000/index.php`.
5. Login menggunakan akun yang sudah terdaftar.

**[Screenshot 1: Halaman login SIMPUS-Mini]**

## 3. Halaman Beranda

Halaman beranda merupakan halaman utama aplikasi. Pada halaman ini, pengguna dapat melihat ringkasan informasi perpustakaan dan menggunakan menu navigasi untuk membuka fitur lainnya.

**[Screenshot 2: Halaman beranda SIMPUS-Mini]**

## 4. Mengelola Data Buku

Halaman daftar buku digunakan untuk melihat data buku yang tersimpan di database.

Langkah-langkah:

1. Pilih menu Buku.
2. Periksa daftar buku yang ditampilkan.
3. Gunakan fitur pencarian jika ingin menemukan buku tertentu.
4. Klik tombol Tambah Buku untuk menambahkan buku baru.
5. Isi data buku sesuai formulir, kemudian simpan.

**[Screenshot 3: Halaman daftar buku]**

**[Screenshot 4: Form tambah buku]**

## 5. Mengelola Data Anggota

Halaman anggota digunakan untuk melihat dan menambahkan data anggota perpustakaan.

Langkah-langkah:

1. Pilih menu Anggota.
2. Lihat daftar anggota yang tersedia.
3. Klik tombol Tambah Anggota.
4. Isi formulir data anggota.
5. Simpan data dan periksa hasilnya pada daftar anggota.

**[Screenshot 5: Halaman daftar anggota]**

**[Screenshot 6: Form tambah anggota]**

## 6. Melakukan Peminjaman Buku

Fitur peminjaman digunakan untuk mencatat anggota yang meminjam buku.

Langkah-langkah:

1. Buka menu Peminjaman Baru.
2. Pilih anggota yang akan meminjam buku.
3. Pilih buku yang akan dipinjam.
4. Isi tanggal peminjaman dan tanggal jatuh tempo sesuai formulir.
5. Simpan transaksi.
6. Periksa pesan hasil penyimpanan.

Sistem dapat menolak peminjaman jika anggota memiliki keterlambatan pengembalian lebih dari 14 hari, sesuai aturan aplikasi.

**[Screenshot 7: Form peminjaman buku]**

**[Screenshot 8: Hasil peminjaman atau pesan validasi]**

## 7. Melakukan Pengembalian Buku

Fitur pengembalian digunakan untuk mencatat buku yang telah dikembalikan oleh anggota.

Langkah-langkah:

1. Buka menu Pengembalian.
2. Cari transaksi peminjaman yang masih aktif.
3. Pilih transaksi atau tombol pengembalian yang tersedia.
4. Ikuti proses pengembalian.
5. Periksa pesan hasil proses.

**[Screenshot 9: Halaman pengembalian buku]**

## 8. Melihat Riwayat Peminjaman

Halaman riwayat digunakan untuk melihat catatan transaksi peminjaman dan pengembalian buku.

Langkah-langkah:

1. Buka menu Riwayat.
2. Periksa data transaksi yang ditampilkan.
3. Gunakan pencarian atau navigasi halaman jika tersedia.

**[Screenshot 10: Halaman riwayat peminjaman]**

## 9. Penutup

Dengan menggunakan SIMPUS-Mini, petugas perpustakaan dapat mengelola data buku dan anggota serta mencatat transaksi peminjaman dan pengembalian. Pengguna perlu memastikan data yang dimasukkan sudah benar agar pengelolaan perpustakaan berjalan dengan baik.
