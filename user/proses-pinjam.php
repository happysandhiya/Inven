<?php
include '../config.php';

if(isset($_GET['mode']) && !empty($_GET['mode']) && isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    // Ambil data permintaan dari database tbl_request
    $query_request = mysqli_query($connect, "SELECT * FROM tbl_request WHERE id='$id'");
    $data_request = mysqli_fetch_array($query_request);

    // Assign data permintaan ke variabel
    $nama_barang = $data_request['nama_barang'];
    $peminjam = $data_request['peminjam'];
    $level = $data_request['level'];
    $jml_barang = $data_request['jml_barang'];
    $tgl_pinjam = $data_request['tgl_pinjam'];
    $tgl_kembali = $data_request['tgl_kembali'];

    if($_GET['mode'] == "terima"){
        // Masukkan data permintaan ke tabel tbl_pinjam
        $insert_pinjam = mysqli_query($connect, "INSERT INTO tbl_pinjam (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali) VALUES ('$nama_barang', '$peminjam', '$level', '$jml_barang', '$tgl_pinjam', '$tgl_kembali')");

        if($insert_pinjam){
            // Hapus data permintaan dari tabel tbl_request
            $delete_request = mysqli_query($connect, "DELETE FROM tbl_request WHERE id='$id'");
            
            if($delete_request){
                echo "<script>alert('Barang berhasil dipinjam');</script>";
                echo "<script>window.history.back();</script>";
            } else {
                echo "Gagal menghapus data dari tabel tbl_request";
            }
        } else {
            echo "Gagal memasukkan data ke tabel tbl_pinjam";
        }
    } else if($_GET['mode'] == "tolak") {
        // Hapus data permintaan dari tabel tbl_request jika mode "tolak"
        $delete_request = mysqli_query($connect, "DELETE FROM tbl_request WHERE id='$id'");
        
        if($delete_request){
            echo "<script>alert('Permintaan barang telah ditolak');</script>";
            echo "<script>window.history.back();</script>";
        } else {
            echo "Gagal menghapus data dari tabel tbl_request";
        }
    }
}
?>
