<?php
//membuat koneksi untuk ke databaSE
$KONEKSI=mysqli_connect("localhost","root","","crud");
//localohost = host name
//root = username utuk akses database
//" = password untuk akses database
//crud = nama databasenya

if(isset($_POST["action"])){
    //kita tampung data yang dikirim
    $nisn=$_POST["nisn"];
    $nama=$_POST["nama"];
    $alamat=$_POST["alamat"];
    $action=$_POST["action"];

    if($action =="insert"){
        // jika actionnya insert
        $sql = "insert into siswa values('$nisn','$nama','$alamat')";
    }else if($action == "update"){
        //jika actionnya "update'
        $sql =" update siswa set nama='$nama',alamat='$alamat' where nisn='$nisn'";
    }
    //eksekusi sql-nya
    mysqli_query($KONEKSI,$sql);
    //direct ke halaman siswa
    header("location:siswa.php");

}

if(isset($_GET["hapus"])){
    // jika yang dikirim adalah variabel GET hapus
    $nisn = $_GET["nisn"];
    $sql = "delete from siswa where nisn='$nisn'";
    mysqli_query($KONEKSI,$sql);
    header("location:siswa.php");
}
?>