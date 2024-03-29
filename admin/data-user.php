<?php
    session_start();
?>
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Peminjaman Barang Sekolah</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
        
<?php include 'sidebar.php'; ?>

<div id="right-panel" class="right-panel">
    <?php include 'header.php'; ?>
    
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Data User 
                        <a href="data-user.php" class="btn btn-info btn-sm">
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
                        <li><a href="#">User</a></li>
                        <li class="active">Data User</li>
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
                            <strong class="card-title">Data User</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Jabatan/Kelas</th>
                                    <th>Opsi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include '../config.php';
                                        if(isset($_GET['opsi']) && $_GET['opsi'] == 'hapus' && isset($_GET['id'])) {
                                            $id = $_GET['id'];
                                            $delete_query = mysqli_query($connect, "DELETE FROM user WHERE id='$id'");
                                            if($delete_query) {
                                                echo '<script>window.location.href="data-user.php";</script>';
                                            } else {
                                                echo '<script>alert("Gagal menghapus user.");</script>';
                                            }
                                        }
                                        $query = mysqli_query($connect, "SELECT * FROM user ORDER BY id");
                                        while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $data['nama'];?></td>
                                            <td><?php echo $data['username'];?></td>
                                            <td><?php echo $data['level'];?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="?opsi=hapus&id=<?php echo $data['id'];?>">
                                                    <i class="fa fa-times"></i>
                                                    Hapus
                                                </a>
                                                <button class="btn btn-info btn-sm"> 
                                                    <i class="fa fa-pencil"></i>
                                                    Edit
                                                </button>
                                            </td>
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
        </div><!-- .animated -->
    </div><!-- .content -->
</div><!-- /#right-panel -->

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
        $('#bootstrap-data-table-export').DataTable();
    });
</script>

</body>
</html>
