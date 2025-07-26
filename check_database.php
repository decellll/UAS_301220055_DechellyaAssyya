<?php
/**
 * Script untuk mengecek dan setup database aplikasi kost
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
    
    // Cek apakah database ada
    $stmt = $pdo->query("SHOW DATABASES LIKE '$database'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Database '$database' ditemukan\n";
        
        // Pilih database
        $pdo->exec("USE `$database`");
        
        // Cek tabel-tabel yang diperlukan
        $required_tables = [
            'tb_penghuni',
            'tb_kamar', 
            'tb_barang',
            'tb_kmr_penghuni',
            'tb_brng_bawaan',
            'tb_tagihan',
            'tb_bayar'
        ];
        
        $existing_tables = [];
        $stmt = $pdo->query("SHOW TABLES");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $existing_tables[] = $row[0];
        }
        
        echo "\n=== CEK TABEL ===\n";
        $missing_tables = [];
        foreach ($required_tables as $table) {
            if (in_array($table, $existing_tables)) {
                echo "✓ Tabel $table ada\n";
            } else {
                echo "✗ Tabel $table TIDAK ADA\n";
                $missing_tables[] = $table;
            }
        }
        
        if (!empty($missing_tables)) {
            echo "\n=== MEMBUAT TABEL YANG HILANG ===\n";
            
            // Baca file SQL
            $sql_file = 'application/sql/kost_database.sql';
            if (file_exists($sql_file)) {
                $sql = file_get_contents($sql_file);
                
                // Eksekusi query SQL
                $pdo->exec($sql);
                echo "✓ Struktur database berhasil dibuat\n";
            } else {
                echo "✗ File SQL tidak ditemukan: $sql_file\n";
            }
        } else {
            echo "\n✓ Semua tabel sudah ada!\n";
        }
        
        echo "\n=== INFORMASI ===\n";
        echo "Database: $database\n";
        echo "Host: $host\n";
        echo "Username: $username\n";
        echo "\nAplikasi siap digunakan!\n";
        echo "Akses: http://localhost/app_kost/\n";
        
    } else {
        echo "✗ Database '$database' tidak ditemukan\n";
        echo "Membuat database baru...\n";
        
        // Buat database
        $pdo->exec("CREATE DATABASE `$database`");
        echo "✓ Database '$database' berhasil dibuat\n";
        
        // Pilih database
        $pdo->exec("USE `$database`");
        
        // Baca dan eksekusi file SQL
        $sql_file = 'application/sql/kost_database.sql';
        if (file_exists($sql_file)) {
            $sql = file_get_contents($sql_file);
            $pdo->exec($sql);
            echo "✓ Struktur database berhasil dibuat\n";
        }
    }
    
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "\nPastikan:\n";
    echo "1. MySQL/MariaDB sudah berjalan\n";
    echo "2. Username dan password database benar\n";
    echo "3. User memiliki hak akses untuk membuat database\n";
}
?> 