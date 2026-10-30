CREATE DATABASE IF NOT EXISTS db_tugas_akhir;
USE db_tugas_akhir;

CREATE TABLE IF NOT EXISTS topik (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode VARCHAR(20) NOT NULL UNIQUE,
  nama VARCHAR(255) NOT NULL,
  rumpun VARCHAR(100) NOT NULL,
  kata_kunci TEXT,
  deskripsi TEXT
);

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(255) NOT NULL,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('dosen', 'mahasiswa') NOT NULL
);

CREATE TABLE IF NOT EXISTS topik_pengajuan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT NOT NULL,
  nama_topik VARCHAR(255) NOT NULL,
  rumpun VARCHAR(100) NOT NULL,
  kata_kunci TEXT,
  deskripsi TEXT,
  status ENUM('pending', 'diterima', 'ditolak') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (mahasiswa_id) REFERENCES users(id)
);

INSERT INTO topik (kode, nama, rumpun, kata_kunci, deskripsi) VALUES
('TP-001', 'Sistem Rekomendasi Topik Skripsi', 'Sistem Informasi', 'rekomendasi, minat', 'Membantu mahasiswa memilih topik sesuai minat.'),
('TP-002', 'Klasifikasi Sentimen Akademik', 'Kecerdasan Buatan', 'NLP, sentimen', 'Menganalisis opini mahasiswa terhadap layanan akademik.'),
('TP-003', 'Dashboard Progres Tugas Akhir', 'Data Science', 'dashboard, visualisasi', 'Menampilkan progres bimbingan dan sidang.'),
('TP-004', 'Keamanan Dokumen Skripsi', 'Jaringan & Keamanan', 'enkripsi, akses', 'Melindungi file proposal dan naskah skripsi.'),
('TP-005', 'Sistem Informasi Alumni', 'Sistem Informasi', 'alumni, database', 'Menyimpan data alumni dan tracer study secara terintegrasi.'),
('TP-006', 'Deteksi Plagiarisme Dokumen', 'Kecerdasan Buatan', 'plagiarisme, NLP', 'Mendeteksi kesamaan teks antar dokumen skripsi dan proposal.'),
('TP-007', 'Analisis Kinerja Mahasiswa', 'Data Science', 'analisis, prediksi', 'Menganalisis performa akademik mahasiswa berdasarkan data nilai.'),
('TP-008', 'Monitoring Keamanan Jaringan Kampus', 'Jaringan & Keamanan', 'monitoring, firewall', 'Menganalisis lalu lintas jaringan untuk mendeteksi ancaman.'),
('TP-009', 'Sistem Penjadwalan Bimbingan', 'Rekayasa Perangkat Lunak', 'jadwal, otomatisasi', 'Mengatur jadwal bimbingan mahasiswa dan dosen secara otomatis.'),
('TP-010', 'Chatbot Bantuan Akademik', 'Kecerdasan Buatan', 'chatbot, layanan', 'Memberikan jawaban otomatis terkait prosedur akademik dan administrasi.');

INSERT INTO users (nama, username, password, role) VALUES
('Dosen Satu', 'dosen1', '123456', 'dosen'),
('Mahasiswa Satu', 'mahasiswa1', '123456', 'mahasiswa'),
('Mahasiswa Dua', 'mahasiswa2', '123456', 'mahasiswa');
