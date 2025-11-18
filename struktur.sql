CREATE TABLE peserta (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_lengkap VARCHAR(100),
  email VARCHAR(100),
  nomor_telepon VARCHAR(20),
  pilihan_lomba VARCHAR(50),
  tanggal_pendaftaran DATETIME
);
