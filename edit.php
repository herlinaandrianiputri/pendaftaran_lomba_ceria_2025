<?php
include 'koneksi.php';

// Ambil ID peserta dari URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$id = (int)$_GET['id'];

// Ambil data peserta dari DB
$data = $conn->query("SELECT * FROM pendaftaran WHERE id_pendaftaran=$id")->fetch_assoc();
if (!$data) {
    echo "Data peserta tidak ditemukan.";
    exit;
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama  = trim($_POST['nama_lengkap']);
    $telp  = trim($_POST['nomor_telepon']);
    $email = trim($_POST['email']);
    $lomba = trim($_POST['pilihan_lomba']);

    // Validasi sesuai SRS/test case
    if (empty($nama)) {
        $error = "Nama Lengkap tidak boleh kosong";
    } elseif (empty($telp)) {
        $error = "Nomor Telepon tidak boleh kosong";
    } elseif (!preg_match("/^[0-9]+$/", $telp)) {
        $error = "Nomor Telepon hanya boleh angka";
    } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format Email tidak valid";
    } else {
        // update database
        $stmt = $conn->prepare("UPDATE pendaftaran 
                                SET nama_lengkap=?, nomor_telepon=?, email=?, pilihan_lomba=? 
                                WHERE id_pendaftaran=?");
        $stmt->bind_param("ssssi", $nama, $telp, $email, $lomba, $id);
        $stmt->execute();

        // redirect ke index.php dengan pesan sukses
        header("Location: index.php?msg=Kontak+berhasil+diperbarui");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Kontak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type=text], select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            display: block;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #4CAF50;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        .msg-error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Kontak</h2>

    <?php 
    if ($error != "") {
        echo "<p class='msg-error'>$error</p>"; 
    }
    ?>

    <form method="post">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" 
               value="<?php echo isset($_POST['nama_lengkap'])?htmlspecialchars($_POST['nama_lengkap']):htmlspecialchars($data['nama_lengkap']); ?>">

        <label>Nomor Telepon:</label>
        <input type="text" name="nomor_telepon" 
               value="<?php echo isset($_POST['nomor_telepon'])?htmlspecialchars($_POST['nomor_telepon']):htmlspecialchars($data['nomor_telepon']); ?>">

        <label>Email (opsional):</label>
        <input type="text" name="email" 
               value="<?php echo isset($_POST['email'])?htmlspecialchars($_POST['email']):htmlspecialchars($data['email']); ?>">

        <label>Pilihan Lomba:</label>
        <select name="pilihan_lomba">
            <option value="Nyanyi" <?php 
                $val = isset($_POST['pilihan_lomba'])?$_POST['pilihan_lomba']:$data['pilihan_lomba'];
                if($val=="Nyanyi") echo "selected"; ?>>Nyanyi</option>
            <option value="Melukis" <?php if($val=="Melukis") echo "selected"; ?>>Melukis</option>
        </select>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="index.php" class="back-link">Kembali ke Daftar Kontak</a>
</div>
</body>
</html>
