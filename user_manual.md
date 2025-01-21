# Manual Pengguna - Sistem Manajemen Tim

## Gambaran Umum Halaman Frontend

### Halaman Bergabung dengan Tim (`teamjoinproposal.php`)
Halaman ini memungkinkan anggota untuk mengajukan permohonan bergabung dengan tim yang ada.

#### Fitur-fitur:
1. **Pemilihan Tim**
   - Anggota dapat memilih tim yang ingin mereka ajukan untuk bergabung.
   - Menampilkan daftar tim yang tersedia untuk diajukan.

2. **Deskripsi Proposal**
   - Anggota dapat menambahkan deskripsi untuk proposal bergabung mereka.

3. **Pengajuan Proposal**
   - Setelah memilih tim dan menambahkan deskripsi, anggota dapat mengajukan proposal bergabung.
   - Sistem akan memeriksa apakah anggota sudah menjadi bagian dari tim lain sebelum mengizinkan pengajuan.

#### Navigasi
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama setelah mengajukan proposal.

### Halaman Tim Saya (`myteam.php`)
Halaman ini menampilkan semua tim yang dimiliki oleh anggota, beserta detail dan aktivitasnya.

#### Fitur-fitur:
1. **Tampilan Informasi Tim**
   - Nama tim dan game terkait.
   - Daftar anggota tim dengan paginasi.
   - Tampilan logo/gambar tim.
   - Daftar anggota tim terkini.

2. **Bagian Prestasi Tim**
   - Menampilkan semua prestasi tim.
   - Menunjukkan nama prestasi, tanggal, dan deskripsi.
   - Tampilan halaman bertahap (2 item per halaman).
   - Navigasi mudah melalui riwayat prestasi.

3. **Bagian Event Tim**
   - Menampilkan event yang akan datang dan yang telah lewat.
   - Menunjukkan nama event, tanggal, dan deskripsi.
   - Tampilan halaman bertahap (2 item per halaman).
   - Daftar event berdasarkan urutan waktu.

#### Navigasi
- Gunakan kontrol paginasi untuk menjelajahi beberapa halaman anggota, prestasi, atau event.
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama.
- Akses detail tim dengan memilih tim tertentu dari daftar.

#### Elemen Antarmuka Pengguna
- Tata letak yang bersih dan terorganisir untuk akses informasi yang mudah.
- Desain responsif yang bekerja di berbagai ukuran layar.
- Header bagian yang jelas untuk berbagai jenis informasi.
- Tampilan tabel untuk anggota tim, prestasi, dan event.

### Tips Penggunaan
- Jaga sesi tetap aktif dengan login.
- Gunakan kontrol paginasi untuk melihat semua informasi yang tersedia.
- Periksa event tim secara rutin untuk aktivitas mendatang.
- Pantau prestasi tim untuk melacak kemajuan.
- Verifikasi informasi anggota tim di bagian daftar anggota.

### Catatan Keamanan
- Akses ke halaman tim memerlukan autentikasi anggota.
- Hanya anggota tim yang berwenang yang dapat melihat detail tim.
- Manajemen sesi memastikan akses informasi yang aman.

# Manual Admin - Sistem Manajemen Tim

## Gambaran Umum Halaman Backend

### Halaman Kelola Proposal Bergabung (`adminjoinproposal.php`)
Halaman ini memungkinkan admin untuk mengelola proposal bergabung yang diajukan oleh anggota.

#### Fitur-fitur:
1. **Tinjau Proposal**
   - Admin dapat melihat daftar proposal bergabung yang diajukan oleh anggota.
   - Menampilkan nama anggota, tim yang ingin mereka gabung, deskripsi, dan status proposal.

2. **Persetujuan/Tolak Proposal**
   - Admin dapat menyetujui atau menolak proposal bergabung.
   - Setelah disetujui, anggota akan ditambahkan ke tim yang dipilih.

#### Navigasi
- Gunakan kontrol paginasi untuk menjelajahi beberapa halaman proposal.
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama.

### Halaman Kelola Tim (`team.php`)
Halaman ini memungkinkan admin untuk mengelola tim yang ada.

#### Fitur-fitur:
1. **Tampilan Informasi Tim**
   - Menampilkan daftar tim beserta gambar, nama, dan game terkait.

2. **Aksi Tim**
   - Admin dapat mengedit atau menghapus tim yang ada.

#### Navigasi
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama.

### Halaman Kelola Game (`game.php`)
Halaman ini memungkinkan admin untuk mengelola game yang ada.

#### Fitur-fitur:
1. **Tampilan Informasi Game**
   - Menampilkan daftar game beserta deskripsi.

2. **Aksi Game**
   - Admin dapat menambah, mengedit, atau menghapus game.

#### Navigasi
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama.

### Halaman Kelola Prestasi (`achievement.php`)
Halaman ini memungkinkan admin untuk mengelola prestasi tim.

#### Fitur-fitur:
1. **Tampilan Informasi Prestasi**
   - Menampilkan daftar prestasi beserta nama, tanggal, deskripsi, dan tim terkait.

2. **Aksi Prestasi**
   - Admin dapat menambah, mengedit, atau menghapus prestasi.

#### Navigasi
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama.

### Halaman Kelola Event (`event.php`)
Halaman ini memungkinkan admin untuk mengelola event yang ada.

#### Fitur-fitur:
1. **Tampilan Informasi Event**
   - Menampilkan daftar event beserta nama, tanggal, dan deskripsi.

2. **Aksi Event**
   - Admin dapat menambah, mengedit, atau menghapus event.

#### Navigasi
- Klik "Kembali ke Dashboard" untuk kembali ke dashboard utama.

### Tips Penggunaan
- Pastikan untuk memeriksa proposal bergabung secara rutin.
- Kelola tim, game, prestasi, dan event dengan hati-hati untuk menjaga integritas data.

### Catatan Keamanan
- Akses ke halaman admin memerlukan autentikasi sebagai admin.
- Hanya admin yang berwenang yang dapat mengelola data tim, game, prestasi, dan event.
- Manajemen sesi memastikan akses informasi yang aman.
