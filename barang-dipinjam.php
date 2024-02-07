<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Barang Dipinjam</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/css/font-awesome.min.css">
    <!-- Add your custom stylesheets here -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Scripts -->
    <script src="admin/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="admin/assets/js/vendor/bootstrap.min.js"></script>
    <!-- Add your custom scripts here -->
    <script src="assets/js/main.js"></script>
</head>
<body>
    <?php include 'admin/sidebar.php'; ?>
    <?php include 'admin/header.php'; ?>

    <div id="right-panel" class="right-panel">
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Barang Dipinjam</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <!-- Table header -->
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'config.php';
                                        $query = mysqli_query($connect, "SELECT * FROM tbl_pinjam ORDER BY id DESC");
                                        if($query && mysqli_num_rows($query) > 0){
                                            while ($data=mysqli_fetch_array($query)) {
                                                $id = $data['id'];
                                                $nama_barang = $data['nama_barang'];
                                                $peminjam = $data['peminjam'];
                                                $level = $data['level'];
                                                $jml_barang = $data['jml_barang'];
                                                $tgl_pinjam = $data['tgl_pinjam'];
                                                $tgl_kembali = $data['tgl_kembali'];
                                        ?>
                                        <tr>
                                            <!-- Table rows -->
                                            <td>
                                                <a class="btn btn-success btn-sm" href="proses-pinjam2.php?mode=terima&id=<?php echo $id;?>">
                                                    <i class="fa fa-check"></i> Sudah Kembali
                                                </a>
                                            </td>
                                        </tr>
                                        <?php   
                                            }
                                        }else{
                                        ?>      
                                        <tr>
                                            <td colspan="7">Data Kosong</td>
                                        </tr>                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript" src="tambahan/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="tambahan/bootstrap-4.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
