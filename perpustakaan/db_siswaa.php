<?php

$koneksi=mysqli_connect("localhost","root","","perpustakaan");





if(isset($_POST["action"])){
    $nisn=$_POST["nisn"];
    $nama=$_POST["nama"];
    $alamat=$_POST["alamat"];
    $kontak=$_POST["kontak"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $action=$_POST["action"];

    if($action =="insert"){
        //kita tampung deskripsi gambarnya
        $path = pathinfo($_FILES["image"]["name"]);
        //ambil ekstensi gambar
        $extensi = $path["extension"];
        //rangkap nama file yang akan disimpan
        $filename =$nisn."-".rand(1,1000).".".$extensi;

        //rand () -> untuk mengambil nilai random antara 1-1000
        //exp : 123-809.jpg

        //simpan file gambar
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_siswa/$filename");

        $sql = "insert into siswa values('$nisn','$nama','$alamat','$kontak','$username','$password','$filename')";
    }else if($action == "update"){
        //ambil data dari database
        $sql ="select * from siswa where nisn='$nisn'";
        $result = mysqli_query($koneksi,$sql);
        $hasil = mysqli_fetch_array($result);
        //untuk mengonversi menjadi array
        if(isset($_FILES["image"])){
            if(file_exists("img_siswa/" .$hasil["image"])){
                //jika file nya tersedia
                unlink("img_siswa/".$hasil["iamge"]);
                //untuk menghapus file
            }
            $path = pathinfo($_FILES["image"]["name"]);
            //ambil ekstensi gambarnya
            $extensi = $path["extension"];
            //rangkap nama file yang akan disimpan
            $filename =$nisn."-".rand(1,1000).".".$extensi;

            //rand () -> untuk mengambil nilai random antara 1-1000
            //exp : 123-809.jpg

            //simpan file gambar
            move_uploaded_file($_FILES["image"]["tmp_name"],"img_siswa/$filename");
            $sql-"update siswa set nama='$nama,alamat='$alamat',kontak='$kontak','$username','$password','$filename' where nisn='$nisn'";
        }else{
            $sql-"update siswa set nama='$nama,alamat='$alamat',kontak='$kontak','$username','$password','$filename' where nisn='$nisn'";
        }
            
    }

    mysqli_query($koneksi,$sql);

    header("location:template.php?page=siswaa");
}

if(isset($_GET["hapus"])){

    $nisn = $_GET["nisn"];
    //ambil data dari database
    $sql ="delete from siswa where nisn='$nisn'";
    //eksekusi query
    $result = mysqli_query($koneksi,$sql);
    //konverensi ke array
    $hasil=mysqli_fetch_array($result);
    if(file_exists("img_siswa/" .$hasil["image"])){
        unlink("img_siswa/" .$hasil["image"]);
        //menghapus file
    }
    $sql="delete from siswa where nisn='$nisn'";
    mysqli_query($koneksi,$sql);
    header("location:template.php?page=siswaa");
}