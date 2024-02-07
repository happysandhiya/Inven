<?php
    session_start();
    include 'config.php';

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query_username = mysqli_query($connect, "SELECT * FROM user WHERE username = '$username'");
        if($query_username){
            $data = mysqli_fetch_array($query_username);
            if($data){
                if($password == $data['password']){
                    echo $_SESSION['username'] = $data['username'];
                    echo $_SESSION['name'] = $data['nama'];
                    // header('location: admin/index.php');
                    // exit();
                } if($data['level'] == 'admin') {
                    // $_SESSION['username'] = $data['username'];
                    // $_SESSION['name'] = $data['nama'];
                    header('location: admin/index.php');
                    // exit();
                } if($data['level'] == 'user') {
                    // $_SESSION['username'] = $data['username'];
                    // $_SESSION['name'] = $data['nama'];
                    header('location: user/index.php');
                    // exit();
                } 
                else {
                    echo "<script>alert('Password Salah atau belum diisi');</script>";
                    echo "<script>window.history.back();</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Username tidak terdaftar');</script>";
                exit();
            }
        } else {
            echo "<script>alert('Terjadi kesalahan dalam proses login');</script>";
            exit();
        }
    }
?>
