<?php
function do_login($username, $password){
    //cek kondisi jika usename dan password salah
    if($username !="admin" || $password !="admin"){
        header("location:index.php?error=wrong");
    }

    //cek kondisi jika password benar
    if($username == "admin" && $_POST["password"] == "admin"){
        $_SESSION["user"] = $username;
        $_SESSION["pass"] = $password;

        header("location:beranda.php");
    }
}
function check_login(){
    //cek kondisi login session
    if(!isset($_SESSION["user"])){
        header("location:index.php");
    }
}