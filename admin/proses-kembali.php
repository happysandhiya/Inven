<?php
include '../config.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    // Ambil data permintaan kembali dari database
    $query_req_kembali = mysqli_query($connect, "SELECT * FROM tbl_req_kembali WHERE id='$id'");
    $data_req_kembali = mysqli_fetch_array($query_req_kembali);

    // Assign data permintaan kembali ke variabel
    $nama_barang = $data_req_kembali['nama_barang'];
    $peminjam = $data_req_kembali['peminjam'];
    $level = $data_req_kembali['level'];
    $jml_barang = $data_req_kembali['jml_barang'];
    $tgl_pinjam = $data_req_kembali['tgl_pinjam'];
    $tgl_kembali = $data_req_kembali['tgl_kembali'];

    // Masukkan data permintaan kembali ke tabel transaksi
    $insert_transaksi = mysqli_query($connect, "INSERT INTO tbl_transaksi (nama_barang, peminjam, level, jml_barang, tgl_pinjam, tgl_kembali) VALUES ('$nama_barang', '$peminjam', '$level', '$jml_barang', '$tgl_pinjam', '$tgl_kembali')");

    if($insert_transaksi){
        // Hapus data permintaan kembali dari tabel req_kembali
        $delete_req_kembali = mysqli_query($connect, "DELETE FROM tbl_req_kembali WHERE id='$id'");
        
        if($delete_req_kembali){
            echo "<script>alert('Barang telah berhasil dikembalikan');</script>";
            echo "<script>window.location.href='permintaan-kembali.php';</script>";
        } else {
            echo "Gagal menghapus data dari tabel req_kembali";
        }
    } else {
        echo "Gagal memasukkan data ke tabel transaksi";
    }
}
?>
