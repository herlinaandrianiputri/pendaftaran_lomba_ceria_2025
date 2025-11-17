<?php
$host = "localhost";
$user = "root"; // username MySQL kalian
$pass = "";     // password MySQL kalian
$db   = "db_pendaftaran_lomba"; // nama database kalian

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>