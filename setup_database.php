<?php
/**
 * Script untuk setup database aplikasi kost
 * Jalankan file ini melalui browser atau command line
 */

// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_kost';

try {
    // Koneksi ke MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Berhasil terhubung ke MySQL\n";
    
    // Buat database jika belum ada
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database`");
    echo "✓ Database '$database' berhasil dibuat/ditemukan\n";
    
    // Pilih database
    $pdo->exec("USE `$database`");
    
    // Baca file SQL
    $sql_file = 'application/sql/kost_database.sql';
    if (file_exists($sql_file)) {
        $sql = file_get_contents($sql_file);
        
        // Eksekusi query SQL
        $pdo->exec($sql);
        echo "✓ Database berhasil di-setup dengan struktur tabel\n";
        
        echo "\n=== INFORMASI ===\n";
        echo "Database: $database\n";
        echo "Host: $host\n";
        echo "Username: $username\n";
        echo "\nAplikasi siap digunakan!\n";
        echo "Akses: http://localhost/app_kost/\n";
        
    } else {
        echo "✗ File SQL tidak ditemukan: $sql_file\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "\nPastikan:\n";
    echo "1. MySQL/MariaDB sudah berjalan\n";
    echo "2. Username dan password database benar\n";
    echo "3. User memiliki hak akses untuk membuat database\n";
}
?> 