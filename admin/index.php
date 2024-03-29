<?php
session_start();
include '../config.php';
if (!isset($_SESSION['username'])) {
    header("location: ../index.php");
}
// Ambil data barang paling banyak dipinjam dari tabel tbl_transaksi
$query_barang_terbanyak = mysqli_query($connect, "SELECT nama_barang, SUM(jml_barang) AS total_barang FROM tbl_transaksi GROUP BY nama_barang ORDER BY total_barang DESC LIMIT 1");
$data_barang_terbanyak = mysqli_fetch_assoc($query_barang_terbanyak);
$barang_terbanyak = $data_barang_terbanyak ? $data_barang_terbanyak['nama_barang'] : "Data tidak tersedia";

// Ambil data user paling banyak meminjam dari tabel tbl_transaksi
$query_user_pinjam = mysqli_query($connect, "SELECT peminjam, SUM(jml_barang) AS total_pinjam FROM tbl_transaksi GROUP BY peminjam ORDER BY total_pinjam DESC LIMIT 1");
$data_user_pinjam = mysqli_fetch_assoc($query_user_pinjam);

if ($data_user_pinjam) {
    $user_terbanyak = $data_user_pinjam['peminjam'];
    $total_pinjam_user_terbanyak = $data_user_pinjam['total_pinjam'];
} else {
    $user_terbanyak = "Data tidak tersedia";
    $total_pinjam_user_terbanyak = 0;
}
?>
<!doctype html>

<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Peminjaman Inventarisasi Seni</title>
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
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>

<?php
include 'sidebar.php';
?>

<!-- Left Panel -->

<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <?php include 'header.php'; ?>

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-1">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">
                            <?php
                            $query_user = mysqli_query($connect, "SELECT COUNT(*) AS total_user FROM user");
                            $total_user = mysqli_fetch_array($query_user);
                            echo $total_user['total_user'];
                            ?>
                        </span>
                    </h4>
                    <p class="text-light">Jumlah Admin </p>
                    <a href="data-user.php" class="btn btn-success btn-sm">Lihat</a>
                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart1"></canvas>
                    </div>

                </div>

            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-2">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">
                            <?php
                            $query_barang = mysqli_query($connect, "SELECT SUM(stok_barang) AS stok FROM tbl_barang");
                            $total_barang = mysqli_fetch_array($query_barang);
                            echo $total_barang['stok'];
                            ?>
                        </span>
                    </h4>
                    <p class="text-light">Barang Tersedia</p>
                    <a href="data-barang.php" class="btn btn-success btn-sm">Lihat</a>
                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart2"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-3">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">
                            <?php
                            $query_request = mysqli_query($connect, "SELECT COUNT(*) AS total_req_pinjam FROM tbl_request");
                            $total_request = mysqli_fetch_array($query_request);
                            echo $total_request['total_req_pinjam'];
                            ?>
                        </span>
                    </h4>
                    <p class="text-light">Request Peminjaman</p>
                    <a href="permintaan.php" class="btn btn-success btn-sm">Lihat</a>

                </div>

                <div class="chart-wrapper px-0" style="height:70px;" height="70">
                    <canvas id="widgetChart3"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-4">
                <div class="card-body pb-0">
                    <h4 class="mb-0">
                        <span class="count">
                            <?php
                            $query_barang_pinjam = mysqli_query($connect, "SELECT SUM(jml_barang) AS jml_barnag FROM tbl_pinjam");
                            $total_barang_pinjam = mysqli_fetch_array($query_barang_pinjam);
                            echo $total_barang_pinjam['jml_barnag'];
                            ?>
                        </span>
                    </h4>
                    <p class="text-light">Barang Dipinjam</p>
                    <a href="barang-dipinjam.php" class="btn btn-success btn-sm">Lihat</a>

                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-5">
                <div class="card-body pb-0">
                    <h4 class="mb-0">Barang Paling Banyak Dipinjam</h4>
                    <p class="text-light"> <?php echo $barang_terbanyak; ?></p>
                    <a href="barang-kembali.php" class="btn btn-success btn-sm">Detail</a>
                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart4"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card text-dark bg-flat-color-7">
                <div class="card-body pb-0">
                    <h4 class="mb-0">Peminjaman terbanyak </h4>
                    <!-- <h4 class="mb-0"><?php echo $total_pinjam_user_terbanyak; ?></h4> -->
                    <p class="text-dark">Peminjaman oleh <?php echo $user_terbanyak; ?></p>
                    <a href="barang-kembali.php" class="btn btn-success btn-sm">Detail</a>
                    <div class="chart-wrapper px-3" style="height:70px;" height="70">
                        <canvas id="widgetChart5"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- .content -->
</div><!-- /#right-panel -->

<!-- Right Panel -->

<script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>


<script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
<script src="assets/js/dashboard.js"></script>
<script src="assets/js/widgets.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
<script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
<script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
<script>
    var ctx = document.getElementById("widgetChart4").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Peminjaman Bulanan',
                data: <?php echo json_encode($values); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>

</body>
</html>
