CREATE DATABASE IF NOT EXISTS rental_ps;
USE rental_ps;

-- Tabel User untuk Login & Registrasi
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Tabel Konsol PS
CREATE TABLE IF NOT EXISTS konsol (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_konsol VARCHAR(100) NOT NULL,
    tipe VARCHAR(50) NOT NULL,
    harga_sewa INT NOT NULL,
    status VARCHAR(20) NOT NULL,
    gambar VARCHAR(255) NOT NULL
);

-- Tabel Pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nik VARCHAR(50) NOT NULL,
    nama VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL
);

-- Data PS 
INSERT INTO konsol (nama_konsol, tipe, harga_sewa, status, gambar) VALUES
('PlayStation 2 - Room A', 'PS2 Slim', 5000, 'Tersedia', 'ps2_slim.jpg.jfif'),
('PlayStation 2 - Room B', 'PS2 Fat', 5000, 'Tersedia', 'ps2_fat.jpg.jfif'),
('PlayStation 3 - Room A', 'PS3 Slim', 10000, 'Disewa', 'ps3_slim.jpg.jfif'),
('PlayStation 3 - Room B', 'PS3 Super Slim', 10000, 'Tersedia', 'ps3_super_slim.jpg.jfif'),
('PlayStation 4 - Room A', 'PS4 Slim', 15000, 'Tersedia', 'ps4_slim.jpg.jfif'),
('PlayStation 4 - Room B', 'PS4 Fat', 15000, 'Disewa', 'ps4_fat.jpg.jfif'),
('PlayStation 4 Pro - Room A', 'PS4 Pro 4K', 20000, 'Tersedia', 'ps4_pro.jpg.jfif'),
('PlayStation 5 - Room A', 'PS5 Digital Edition', 25000, 'Tersedia', 'ps5_digital.jpg.jfif'),
('PlayStation 5 - Room B', 'PS5 Disc Edition', 30000, 'Disewa', 'ps5_disc.jpg.jfif');