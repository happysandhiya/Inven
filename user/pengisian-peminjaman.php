<?php
    session_start();
    include '../config.php'; // Sesuaikan dengan lokasi file config.php Anda

    // Query untuk mengambil data barang dari database
    $query_barang = mysqli_query($connect, "SELECT * FROM tbl_barang ORDER BY nama_barang ASC");
    
    // Proses form ketika tombol submit ditekan
    if(isset($_POST['submit'])) {
        $nama_barang = $_POST['nama_barang'];
        $peminjam = $_POST['peminjam'];
        $level = $_POST['level'];
        $jml_barang = $_POST['jml_barang'];
        $tgl_pinjam = $_POST['tgl_pinjam'];
        $tgl_kembali = $_POST['tgl_kembali'];
        
        // Query untuk memasukkan data peminjaman ke tabel tbl_request
        $query_insert = "INSERT INTO tbl_request (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali) VALUES ('$nama_barang', '$peminjam', '$level', '$jml_barang', '$tgl_pinjam', '$tgl_kembali')";
        
        // Eksekusi query
        if(mysqli_query($connect, $query_insert)) {
            echo '<script>alert("Peminjaman berhasil ditambahkan.");window.location.href="permintaan.php";</script>';
        } else {
            echo '<script>alert("Peminjaman gagal ditambahkan.");window.location.href="pengisian-peminjaman.php";</script>';
        }
    }
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form Peminjaman Inventarisasi Seni</title>
    <meta name="description" content="Form Peminjaman Barang Sekolah">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php include 'header.php'; ?>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Form Peminjaman Inventarisasi Seni</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang:</label>
                                        <select id="nama_barang" name="nama_barang" class="form-control" required>
                                            <option value="">Pilih Barang</option>
                                            <?php
                                                // Menampilkan pilihan nama barang dari database
                                                while ($barang = mysqli_fetch_array($query_barang)) {
                                                    echo "<option value='".$barang['nama_barang']."'>".$barang['nama_barang']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="peminjam">Nama Peminjam:</label>
                                        <input type="text" id="peminjam" name="peminjam" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="level">Jabatan/Kelas:</label>
                                        <input type="text" id="level" name="level" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="jml_barang">Jumlah Barang:</label>
                                        <input type="number" id="jml_barang" name="jml_barang" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_pinjam">Tanggal Pinjam:</label>
                                        <input type="date" id="tgl_pinjam" name="tgl_pinjam" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_kembali">Tanggal Kembali:</label>
                                        <input type="date" id="tgl_kembali" name="tgl_kembali" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
