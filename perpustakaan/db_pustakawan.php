<?php

$koneksi=mysqli_connect("localhost","root","","perpustakaan");






if(isset($_POST["action"])){

    $nama=$_POST["nama"];
    $kontak=$_POST["kontak"];
    $nip=$_POST["nip"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $action=$_POST["action"];

    if($action =="insert"){

        $path = pathinfo($_FILES["image"]["name"]);

        $extensi = $path["extension"];

        $filename = $nip.".".rand(1,1000).".".$extensi;


        move_uploaded_file($_FILES["image"]["tmp_name"],"img_pustakawan/$filename");


        $sql = "insert into pustakawan values('$nama','$kontak','$nip','$username','$password','$filename')";
    }else if($action == "update"){
        $sql ="select * from pustakawan where nip='$nip'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);

        if(isset($_FILES["image"])){
            if(file_exists("img_pustakawan/" .$hasil["image"])){
                unlink("img_pustakawan/" .$hasil["image"]);
            }
            $path = pathinfo($_FILES["image"]["name"]);

            $extensi = $path["extension"];

            $filename = $nip.".".rand(1,1000).".".$extensi;
            move_uploaded_file($_FILES["image"]["tmp_name"],"img_pustakawan/$filename");
            
            $sql ="update pustakawan set nama='$nama',kontak='$kontak',username='$username',password='$password',image='$filename' where nip='$nip'";

        }else{
            $sql ="update pustakawan set nama='$nama',kontak='$kontak',username='$username',password='$password'  where nip='$nip'";
        }

    }

    mysqli_query($koneksi,$sql);
    // echo $sql;
    header("location:template.php?page=pustakawan");
}

if(isset($_GET["hapus"])){
    $nip = $_GET["nip"];

    $sql= "select *from pustakawan where nip='$nip'";

    $result = mysqli_query($koneksi,$sql);

    $hasil=mysqli_fetch_array($result);
    if(file_exists("img_pustakawan/" .$hasil["image"])){
        unlink("img_pustakawan/" .$hasil["image"]);
    }
    

    $nip = $_GET["nip"];
    $sql ="delete from pustakawan where nip='$nip'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=pustakawan");
}