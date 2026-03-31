CREATE DATABASE pendaftaran;
USE pendaftaran;

CREATE TABLE kuota (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_gelombang VARCHAR(50),
    maksimal INT,
    waktu_buka DATETIME,
    waktu_tutup DATETIME
);

INSERT INTO kuota (nama_gelombang, maksimal, waktu_buka, waktu_tutup) VALUES
('Gelombang 1', 5, '2026-04-01 08:00:00', '2026-04-01 23:59:59'),
('Gelombang 2', 5, '2026-04-01 08:00:00', '2026-04-01 23:59:59');

CREATE TABLE peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    kuota_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);