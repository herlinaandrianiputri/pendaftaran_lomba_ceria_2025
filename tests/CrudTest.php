<?php

use PHPUnit\Framework\TestCase;

class CrudTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // HOST WAJIB "mysql" untuk GitHub Actions
        $this->conn = new mysqli("mysql", "root", "root", "db_pendaftaran_lomba");

        if ($this->conn->connect_errno) {
            die("MySQL Connection Error: " . $this->conn->connect_error);
        }
    }

    public function testTambah()
    {
        $nama   = "Herlina Andriani";
        $telp   = "0895622203301";
        $email  = "herlinaandrianiputri@gmail.com";
        $lomba  = "Nyanyi";

        $stmt = $this->conn->prepare(
            "INSERT INTO pendaftaran (nama_lengkap, nomor_telepon, email, pilihan_lomba)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $nama, $telp, $email, $lomba);

        $hasil = $stmt->execute();

        $this->assertTrue($hasil);
    }

    public function testRead()
    {
        $ambil = $this->conn->query("SELECT * FROM pendaftaran");
        $this->assertGreaterThan(0, $ambil->num_rows);
    }

    public function testUpdate()
    {
        $this->conn->query(
            "UPDATE pendaftaran 
             SET nama_lengkap='Herlina A. Update'
             ORDER BY id_pendaftaran DESC LIMIT 1"
        );

        $cek = $this->conn->query(
            "SELECT nama_lengkap 
             FROM pendaftaran 
             ORDER BY id_pendaftaran DESC LIMIT 1"
        );

        $row = $cek->fetch_assoc();

        $this->assertEquals("Herlina A. Update", $row['nama_lengkap']);
    }

    public function testDelete()
    {
        $this->conn->query(
            "DELETE FROM pendaftaran 
             ORDER BY id_pendaftaran DESC LIMIT 1"
        );

        $hasil = $this->conn->query("SELECT * FROM pendaftaran");
        $this->assertNotNull($hasil);
    }
}
