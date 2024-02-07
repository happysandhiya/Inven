<?php
    session_start();
    include '../config.php';

    // Menghapus data barang jika parameter 'opsi' dan 'id' diterima melalui GET
    if(isset($_GET['opsi']) && $_GET['opsi'] == 'hapus' && isset($_GET['id'])){
        $id = $_GET['id']; 
        $query_delete = mysqli_query($connect, "DELETE FROM tbl_barang WHERE id='$id'");
        if($query_delete){
            echo "<script>alert('Berhasil Dihapus');</script>";
            echo "<script>window.location='data-barang.php';</script>";
        }else{
            echo "Gagal hapus ke database;";
        } 
    }
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Peminjaman Barang Sekolah</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include CSS files -->
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/scss/style.css">

    <!-- Include Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="assets/js/lib/data-table/dataTables.bootstrap.min.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/buttons.bootstrap.min.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/jszip.min.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/pdfmake.min.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/vfs_fonts.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/buttons.html5.min.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/buttons.print.min.js">
    <link rel="stylesheet" href="assets/js/lib/data-table/buttons.colVis.min.js">
</head>
<body>
        
    <!-- Include sidebar.php -->
    <?php include 'sidebar.php'; ?>

    <div id="right-panel" class="right-panel">

        <!-- Include header.php -->
        <?php include 'header.php'; ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Data Barang 
                            <a href="data-barang.php" class="btn btn-info btn-sm">
                                <i class="fa fa-refresh"></i>
                                Refresh
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Barang</a></li>
                            <li class="active">Data Barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table</strong>
                                <a href="tambah-barang.php" class="btn btn-success btn-sm" style="margin-left: 20px;">
                                    <i class="fa fa-plus"></i>
                                    Tambah Barang
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Gambar</th>
                                            <th>Stok</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = mysqli_query($connect, "SELECT * FROM tbl_barang ORDER BY id ASC");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td><?php echo $data['nama_barang'];?></td>
                                            <td><img src="../assets/img/uploads/<?php echo $data['gambar_barang'];?>" style="width:270px;"></td>
                                            <td style="text-align: center;"><?php echo $data['stok_barang'];?></td>
                                            <td class="text-white">
                                                <a class="btn btn-danger btn-sm" href="?opsi=hapus&id=<?php echo $data['id'];?>">
                                                    <i class="fa fa-times"></i>
                                                    Hapus
                                                </a>
                                                <a class="btn btn-info btn-sm" href="edit-barang.php?id=<?php echo $data['id'];?>">
                                                    <i class="fa fa-pencil"></i>
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                            $no++;
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

    </div><!-- /#right-panel -->

    <!-- Include JavaScript files -->
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table').DataTable();
        } );
    </script>
</body>
</html>
