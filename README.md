# Sistem Informasi Kost

Aplikasi web untuk mengelola kost yang dibangun menggunakan CodeIgniter 3.

## Fitur Utama

### Halaman Depan
- Menampilkan kamar yang tersedia (kosong) beserta harga sewanya
- Menampilkan tagihan yang jatuh tempo bulan ini
- Menampilkan tagihan yang terlambat bayar
- Menampilkan kamar yang terisi beserta informasi penghuni

### Halaman Admin
- **Dashboard**: Statistik dan informasi penting
- **Data Penghuni**: CRUD data penghuni kost
- **Data Kamar**: CRUD data kamar dan harga sewa
- **Data Barang**: CRUD data barang tambahan (AC, TV, dll)
- **Kamar Penghuni**: Mengelola penghuni menempati kamar
- **Data Tagihan**: Generate dan kelola tagihan bulanan
- **Pembayaran**: Mencatat pembayaran penghuni

## Struktur Database

### Tabel Utama
1. **tb_penghuni** - Data penghuni kost
2. **tb_kamar** - Data kamar dan harga sewa
3. **tb_barang** - Data barang tambahan
4. **tb_kmr_penghuni** - Relasi penghuni menempati kamar
5. **tb_brng_bawaan** - Barang bawaan penghuni
6. **tb_tagihan** - Tagihan bulanan
7. **tb_bayar** - Data pembayaran

## Instalasi

### 1. Persyaratan Sistem
- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Web server (Apache/Nginx)
- XAMPP/WAMP/LAMP

### 2. Langkah Instalasi

#### a. Clone atau Download Project
```bash
git clone [url-repository]
cd app_kost
```

#### b. Konfigurasi Database
1. Buat database baru dengan nama `db_kost`
2. Import file `application/sql/kost_database.sql`
3. Edit file `application/config/database.php`:
   ```php
   'hostname' => 'localhost',
   'username' => 'root', // sesuaikan dengan username database Anda
   'password' => '', // sesuaikan dengan password database Anda
   'database' => 'db_kost',
   ```

#### c. Konfigurasi Base URL
Edit file `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/app_kost/';
```

#### d. Set Permission (Linux/Mac)
```bash
chmod -R 755 application/cache/
chmod -R 755 application/logs/
```

### 3. Akses Aplikasi
- **Halaman Depan**: `http://localhost/app_kost/`
- **Halaman Admin**: `http://localhost/app_kost/admin`

## Cara Penggunaan

### 1. Menambah Penghuni Baru
1. Buka menu **Data Penghuni** di halaman admin
2. Klik **Tambah Penghuni**
3. Isi form data penghuni
4. Klik **Simpan**

### 2. Menambah Kamar
1. Buka menu **Data Kamar**
2. Klik **Tambah Kamar**
3. Isi nomor kamar dan harga sewa
4. Klik **Simpan**

### 3. Assign Penghuni ke Kamar
1. Buka menu **Kamar Penghuni**
2. Klik **Tambah Kamar Penghuni**
3. Pilih penghuni dan kamar
4. Isi tanggal masuk
5. Klik **Simpan**

### 4. Generate Tagihan
1. Buka menu **Data Tagihan**
2. Klik **Generate Tagihan**
3. Pilih bulan untuk generate tagihan
4. Klik **Generate**

### 5. Mencatat Pembayaran
1. Buka menu **Data Tagihan**
2. Klik **Detail** pada tagihan yang ingin dibayar
3. Klik **Tambah Pembayaran**
4. Isi jumlah bayar dan status
5. Klik **Simpan**

## Fitur Khusus

### 1. Perhitungan Tagihan Otomatis
- Tagihan = Harga Sewa Kamar + Total Harga Barang Bawaan
- Generate tagihan otomatis untuk semua penghuni aktif

### 2. Status Pembayaran
- **Cicil**: Pembayaran belum lunas
- **Lunas**: Pembayaran sudah lunas

### 3. Pindah Kamar
- Penghuni dapat pindah kamar
- Sistem otomatis mencatat tanggal keluar dari kamar lama
- Membuat record baru untuk kamar baru

### 4. Keluar Kost
- Update tanggal keluar di tabel penghuni
- Update tanggal keluar di tabel kamar penghuni

## Troubleshooting

### 1. Error Database Connection
- Pastikan database `db_kost` sudah dibuat
- Periksa konfigurasi database di `application/config/database.php`
- Pastikan MySQL service berjalan

### 2. Error 404
- Periksa konfigurasi base_url
- Pastikan mod_rewrite Apache aktif
- Periksa file `.htaccess`

### 3. Error Permission
- Set permission folder cache dan logs
- Pastikan web server dapat menulis ke folder tersebut

## Kontribusi

Untuk berkontribusi pada project ini:
1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

Project ini menggunakan lisensi MIT.

## Support

Untuk pertanyaan atau bantuan, silakan buat issue di repository ini. 