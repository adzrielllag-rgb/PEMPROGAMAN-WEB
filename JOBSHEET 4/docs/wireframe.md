## User Flow — Peminjaman Buku

    `[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman Baru"]
            -> [Pilih Anggota] -> [Pilih Buku (stok > 0)]
            -> [Simpan] -> [Stok buku berkurang 1] -> [Kembali ke Dashboard]
    `

## User Flow — Pengembalian Buku

    `[Dashboard] -> [Menu "Pengembalian"] -> [Cari transaksi aktif (anggota/buku)]
            -> [Tandai "Dikembalikan"] -> [Stok buku bertambah 1]
            -> [Kembali ke Dashboard]
    `

## Wireframe: Halaman Login

    `+--------------------------------------+
    |              SIMPUS-Mini             |
    |--------------------------------------|
    |                                      |
    |        [ Login Petugas ]            |
    |                                      |
    |   Username : [______________]       |
    |   Password : [______________]       |
    |                                      |
    |          [   Masuk   ]              |
    |                                      |
    |   Belum punya akun? Daftar di sini  |
    +--------------------------------------+
    `

## Wireframe: Dashboard Petugas

    `+-----------------------------------------------------+
    | SIMPUS-Mini      Beranda | Buku | Anggota | Peminjaman | (Nama Petugas) Logout |
    |-------------------------------------------------------|
    |  [Total Buku]   [Total Anggota]   [Sedang Dipinjam]    |
    |                                                         |
    |  Aksi Cepat:                                           |
    |  [ + Peminjaman Baru ]   [ + Pengembalian ]            |
    |                                                         |
    |  Transaksi Terbaru                                     |
    |  --------------------------------------------------    |
    |  Anggota | Buku | Tgl Pinjam | Status                  |
    +-----------------------------------------------------+
    `

## Wireframe: Form Peminjaman

    `+--------------------------------------+
    |  Form Peminjaman Buku                |
    |--------------------------------------|
    |  Anggota : [ dropdown pilih anggota ]|
    |  Buku    : [ dropdown, hanya stok>0 ]|
    |  Tanggal Pinjam : [ auto: hari ini ] |
    |                                      |
    |          [  Simpan Peminjaman  ]    |
    +--------------------------------------+
    `

## Wireframe: Form Pengembalian

    `+--------------------------------------+
    |  Pengembalian Buku                   |
    |--------------------------------------|
    |  Cari transaksi aktif:               |
    |  [ nama anggota / judul buku ______ ]|
    |                                      |
    |  Anggota | Buku | Tgl Pinjam | [Kembalikan] |
    +--------------------------------------+
    `

## Wireframe: Riwayat Peminjaman per Anggota

    `+--------------------------------------+
    |  Riwayat Peminjaman — Siti Aminah    |
    |--------------------------------------|
    |  Buku            | Pinjam   | Kembali | Status      |
    |  Laskar Pelangi   | 01/07    | 10/07   | Selesai     |
    |  Bumi Manusia      | 15/07    | -       | Dipinjam    |
    +--------------------------------------+
    `

## Wireframe Registrasi Anggota Baru

+--------------------------------------+
| Registrasi Anggota Baru |
|--------------------------------------|
| |
| Nama Lengkap : [______________] |
| Alamat : [______________] |
| No. Telepon : [______________] |
| Email : [______________] |
| |
| [ Daftar ] |
| |
| Sudah punya akun? Login di sini |
+--------------------------------------+

### User Flow — Pencarian Anggota yang Tunggak

`[Petugas Login] -> [Dashboard] -> [Menu "Anggota"] -> [Cari Anggota]`

`-> [Periksa Status Pinjaman] -> [Ditemukan Tunggakan]`

`-> [Tampilkan Detail Pinjaman] -> [Kembali ke Dashboard]`

---

## Edge Case Tambahan

1. Petugas mencoba meminjamkan buku yang sama kepada anggota yang sama dua kali berturut-turut.

2. Petugas mencoba meminjamkan buku yang stoknya sudah habis.

3. Petugas mencoba meminjamkan buku kepada anggota yang masih memiliki pinjaman aktif.

4. Petugas mencari anggota yang tidak terdaftar.

5. Petugas melakukan pengembalian terhadap transaksi yang sudah dikembalikan.
