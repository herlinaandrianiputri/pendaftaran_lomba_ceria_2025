<?php
include 'koneksi.php';

// jika ada pencarian
$cari = "";
if (isset($_GET['cari'])) {
    $cari = $_GET['cari'];
}

// query data
$sql = "SELECT * FROM pendaftaran";
if ($cari != "") {
    $sql .= " WHERE nama_lengkap LIKE '%$cari%'";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Lomba Ceria 2025</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
            color: #333;
        }
        img.lomba {
            display: block;
            margin: 15px auto;
            max-width: 50%;
            border-radius: 8px;
        }
        p.deskripsi {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
        }
        .hadiah {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }
        .hadiah .item {
            width: 26%;
            min-height: 150px;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            color: #fff; /* teks putih */
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
        }
        /* overlay transparan supaya teks terbaca */
        .hadiah .item::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 0;
        }
        .hadiah .item > * {
            position: relative;
            z-index: 1;
        }
        .hadiah .item h3 {
            margin: 5px 0;
            color: #FFD700;
            text-shadow: 0 2px 4px rgba(0,0,0,0.6);
        }
        .hadiah .item p {
            margin: 0;
            font-weight: bold;
            text-shadow: 0 1px 3px rgba(0,0,0,0.6);
        }
        /* background gambar tiap juara */
        .juara1 {
            background-image: url('imeg/juara11.jpg'); /* ganti sesuai file kamu */
        }
        .juara2 {
            background-image: url('imeg/juara2.jpg'); /* ganti sesuai file kamu */
        }
        .juara3 {
            background-image: url('imeg/juara3.jpg'); /* ganti sesuai file kamu */
        }
        .button {
            display: inline-block;
            padding: 8px 15px;
            background: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin: 5px 0;
        }
        .button:hover {background: #45a049;}
        .search-box {
            text-align: center;
            margin-bottom: 15px;
        }
        .search-box input[type=text] {
            padding: 8px;
            width: 50%;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .search-box button {
            padding: 8px 15px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-box button:hover {background: #45a049;}
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {background-color: #f2f2f2;}
        .icon-btn {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            margin: 0 2px;
        }
        .edit-btn {background-color: #2196F3;}
        .edit-btn:hover {background-color: #1976D2;}
        .delete-btn {background-color: #f44336;}
        .delete-btn:hover {background-color: #d32f2f;}
        .msg-green {color: green; text-align: center;}
        .msg-red {color: red; text-align: center;}

        @media (max-width: 760px) {
          .hadiah .item {
            width: 100%;
          }
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Foto lomba -->
    <img src="imeg/ChatGPT Image 21 Sep 2025, 16.44.26.png" alt="Foto Lomba" class="lomba">

<p class="deskripsi">
    Ayo ikuti <b>Lomba Ceria 2025</b>, ajang kreatif paling seru di tahun ini!  
    Kami mengundang seluruh pelajar dan masyarakat untuk berpartisipasi dalam dua kategori favorit yaitu 
    <b>Nyanyi</b> dan <b>Melukis</b>.  
    Tunjukkan bakat terbaikmu, asah kemampuan dan percaya dirimu di depan banyak orang.  
    Lomba ini tidak hanya memberi kesempatan untuk tampil dan berkarya, tetapi juga menjadi pengalaman baru 
    yang berkesan, memperluas jaringan pertemanan, serta mendapatkan ilmu dari para juri berpengalaman.  
    Raih <b>hadiah menarik, piala bergengsi, serta sertifikat penghargaan</b> untuk para pemenang, 
    dan e-sertifikat eksklusif untuk semua peserta.  
    Jangan lewatkan kesempatan emas ini untuk menjadi bagian dari <b>Lomba Ceria 2025</b>!
</p>

    <!-- Bagian hadiah -->
    <div class="hadiah">
        <div class="item juara1">
            <h3>Juara 1</h3>
            <p><b>Uang Tunai Rp 1.000.000</b><br>Piala Emas & Sertifikat</p>
        </div>
        <div class="item juara2">
            <h3>Juara 2</h3>
            <p><b>Uang Tunai Rp 750.000</b><br>Piala Perak & Sertifikat</p>
        </div>
        <div class="item juara3">
            <h3>Juara 3</h3>
            <p><b>Uang Tunai Rp 500.000</b><br>Piala Perunggu & Sertifikat</p>
        </div>
    </div>
    <p class="deskripsi"><b>Silakan lakukan pendaftaran di bawah ini!</b></p>

    <?php if (isset($_GET['msg'])): ?>
        <p class="msg-green"><?php echo htmlspecialchars($_GET['msg']); ?></p>
        <script>
            if (window.history.replaceState) {
                const cleanUrl = window.location.href.split('?')[0];
                window.history.replaceState({}, document.title, cleanUrl);
            }
        </script>
    <?php endif; ?>

    <?php
    if ($cari != "") {
        if ($result->num_rows > 0) {
            echo "<p class='msg-green'>Kontak ditemukan.</p>";
        } else {
            echo "<p class='msg-red'>Kontak tidak ditemukan.</p>";
        }
    }
    ?>

    <div style="text-align:center;">
        <a href="tambah.php" class="button"><i class="fa fa-plus"></i> Tambah Kontak Baru</a>
    </div>

    <div class="search-box">
        <form method="get" style="display:inline;">
            <input type="text" name="cari" placeholder="Cari Nama" value="<?php echo htmlspecialchars($cari); ?>">
            <button type="submit"><i class="fa fa-search"></i> Cari</button>
        </form>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nomor Telepon</th>
            <th>Email</th>
            <th>Pilihan Lomba</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$no++."</td>
                    <td>".$row['nama_lengkap']."</td>
                    <td>".$row['nomor_telepon']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['pilihan_lomba']."</td>
                    <td>
                        <a href='edit.php?id=".$row['id_pendaftaran']."' class='icon-btn edit-btn' title='Edit'>
                            <i class='fa fa-pen'></i>
                        </a>
                        <a href='hapus.php?id=".$row['id_pendaftaran']."' class='icon-btn delete-btn' title='Hapus' onclick=\"return confirm('Apakah Anda yakin ingin menghapus kontak ini?');\">
                            <i class='fa fa-trash'></i>
                        </a>
                    </td>
                </tr>";
            }
        } else {
            if ($cari == "") {
                echo "<tr><td colspan='6'>Daftar kontak masih kosong. Silakan tambah kontak baru.</td></tr>";
            } else {
                echo "<tr><td colspan='6'>Kontak tidak ditemukan.</td></tr>";
            }
        }
        ?>
    </table>

    <?php if ($cari != ""): ?>
        <div style="text-align:center; margin-top:15px;">
            <a href="index.php" class="button"><i class="fa fa-home"></i> Kembali ke Halaman Utama</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
