CREATE TABLE IF NOT EXISTS pendaftaran (
  id_pendaftaran INT AUTO_INCREMENT PRIMARY KEY,
  nama_lengkap VARCHAR(100) NOT NULL,
  nomor_telepon VARCHAR(20) NOT NULL,
  email VARCHAR(100),
  pilihan_lomba VARCHAR(50),
  tanggal_pendaftaran DATETIME
);
