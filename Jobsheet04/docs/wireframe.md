User Flow Peminjaman Buku
[Petugas Login]
       ↓
   [Dashboard]
       ↓
[Peminjaman Baru]
       ↓
 [Pilih Anggota]
       ↓
   [Pilih Buku]
   (stok > 0)
       ↓
     [Simpan]
       ↓
[Stok Buku - 1]
       ↓
 [Dashboard]

User Flow Pengembalian Buku
   [Dashboard]
       ↓
 [Pengembalian]
       ↓
[Cari Transaksi Aktif]
       ↓
 [Pilih Transaksi]
       ↓
 [Dikembalikan]
       ↓
[Stok Buku + 1]
       ↓
 [Dashboard]

 Wireframe Login Petugas
 +--------------------------------------+
|             SIMPUS-Mini              |
|--------------------------------------|
|                                      |
|          [ LOGIN PETUGAS ]           |
|                                      |
| Username : [________________]        |
|                                      |
| Password : [________________]        |
|                                      |
|             [  MASUK  ]              |
|                                      |
|       Belum punya akun? Daftar       |
+--------------------------------------+

Wireframe Dashboard Petugas
+-----------------------------------------------------+
| SIMPUS-Mini | Beranda | Buku | Anggota | Peminjaman |
|             | Nama Petugas | Logout                 |
|-----------------------------------------------------|
|                                                     |
| [ Total Buku ] [ Total Anggota ] [ Sedang Dipinjam ]|
|                                                     |
| Aksi Cepat:                                         |
|                                                     |
| [ + Peminjaman Baru ]    [ + Pengembalian ]         |
|                                                     |
| Transaksi Terbaru                                   |
|-----------------------------------------------------|
| Anggota | Buku | Tgl Pinjam | Status                |
+-----------------------------------------------------+

Wireframe Form Peminjaman
+--------------------------------------+
|       FORM PEMINJAMAN BUKU           |
|--------------------------------------|
|                                      |
| Anggota : [ Pilih Anggota ▼ ]        |
|                                      |
| Buku    : [ Pilih Buku ▼ ]           |
|           (stok tersedia)             |
|                                      |
| Tanggal Pinjam : [ Hari Ini ]        |
|                                      |
|       [ SIMPAN PEMINJAMAN ]          |
+--------------------------------------+

Wireframe Form Pengembalian
+--------------------------------------+
|        PENGEMBALIAN BUKU             |
|--------------------------------------|
|                                      |
| Cari transaksi aktif:                |
| [ nama anggota / judul buku _____ ]  |
|                                      |
| Anggota | Buku | Tgl Pinjam |        |
|                         [Kembalikan]  |
+--------------------------------------+

Wireframe Riwayat Peminjaman
+--------------------------------------+
| RIWAYAT PEMINJAMAN — SITI AMINAH     |
|--------------------------------------|
|                                      |
| Buku           | Pinjam | Kembali    |
|--------------------------------------|
| Laskar Pelangi | 01/07  | 10/07      |
| Status         |        | Selesai    |
|                                      |
| Bumi Manusia   | 15/07  | -          |
| Status         |        | Dipinjam   |
+--------------------------------------+

Aktor Sistem
| Aktor       | Hak Akses                                                    |
| ----------- | ------------------------------------------------------------ |
| **Tamu**    | Melihat katalog buku dan daftar buku                         |
| **Petugas** | Login, mengelola buku, anggota, peminjaman, dan pengembalian |
