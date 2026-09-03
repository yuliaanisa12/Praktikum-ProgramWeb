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
|           (stok tersedia)            |
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
|                         [Kembalikan] |
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

Wireframe Registrasi Anggota Baru 
+--------------------------------------+
|          SIMPUS-Mini                 |
|--------------------------------------|
|                                      |
|     REGISTRASI ANGGOTA BARU          |
|                                      |
| Nama        : [________________]     |
| Email       : [________________]     |
| No. Telepon : [________________]     |
| Alamat      : [________________]     |
| Password    : [________________]     |
| Konfirmasi  : [________________]     |
| Password                             |
|                                      |
|          [ DAFTAR ]   [ BATAL ]      |
|                                      |
| Sudah punya akun? Login di sini      |
+--------------------------------------+

User Flow Petugas Mencari Anggota dengan Tunggakan

[Petugas Login]
       |
       v
   [Dashboard]
       |
       v
 [Menu Anggota]
       |
       v
 [Cari Anggota]
       |
       v
 [Pilih Anggota]
       |
       v
 [Cek Tunggakan]
       |
       v
[Apakah ada tunggakan?]
       |
      / \
    Ya   Tidak
    |      |
    v      v
[Apakah sudah     [Tampilkan status
 lewat jatuh       tidak ada tunggakan]
 tempo?]
    |
   / \
 Ya   Tidak
 |      |
 v      v
[Tampilkan      [Tampilkan status
 status          masih dalam
 terlambat]      batas waktu]

 Edge Case

Kasus:
Petugas mencoba meminjamkan buku yang sama kepada
anggota yang sama dua kali berturut-turut.

Kondisi:
Buku masih berstatus "Dipinjam" oleh anggota tersebut.

Penanganan:
Sistem harus menolak peminjaman kedua dan menampilkan
pesan bahwa buku tersebut masih sedang dipinjam oleh
anggota tersebut.