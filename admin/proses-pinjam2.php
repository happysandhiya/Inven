<?php
include '../config.php';

if(isset($_GET['mode']) && !empty($_GET['mode']) && isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    // Ambil data dari database tbl_pinjam
    $query_pinjam = mysqli_query($connect, "SELECT * FROM tbl_pinjam WHERE id='$id'");
    $data_pinjam = mysqli_fetch_array($query_pinjam);

    // Pastikan data ditemukan
    if($data_pinjam){
        $nama_barang = $data_pinjam['nama_barang'];
        $peminjam = $data_pinjam['peminjam'];
        $level = $data_pinjam['level'];
        $jml_barang = $data_pinjam['jml_barang'];
        $tgl_pinjam = $data_pinjam['tgl_pinjam'];
        $tgl_kembali = $data_pinjam['tgl_kembali'];

        if($_GET['mode'] == "terima"){
            // Masukkan data ke tabel tbl_req_kembali
            $insert_req_kembali = mysqli_query($connect, "INSERT INTO tbl_req_kembali (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali) VALUES ('$nama_barang', '$peminjam', '$level', '$jml_barang', '$tgl_pinjam', '$tgl_kembali')");

            if($insert_req_kembali){
                // Hapus data dari tabel tbl_pinjam
                $delete_pinjam = mysqli_query($connect, "DELETE FROM tbl_pinjam WHERE id='$id'");
                
                if($delete_pinjam){
                    echo "<script>alert('Barang berhasil diajukan kepada pengembalian');</script>";
                    echo "<script>window.history.back();</script>";
                } else {
                    echo "Gagal menghapus data dari tabel tbl_pinjam";
                }
            } else {
                echo "Gagal memasukkan data ke tabel tbl_req_kembali";
            }
        } else if($_GET['mode'] == "tolak") {
            echo "<script>alert('Permintaan barang telah ditolak');</script>";
            echo "<script>window.history.back();</script>";
        }
    } else {
        echo "Data tidak ditemukan";
    }
}
?>
