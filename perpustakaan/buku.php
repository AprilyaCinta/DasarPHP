<!DOCTYPE html>
<html>
<head>
<meta charset="uth-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> Buku </title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">
function Add(){
    //set input action menjadi insert
    document.getElementById('action').value="insert";
    //kosongkan inputan form-nya
    
    document.getElementById("judul").value="";
    document.getElementById("penulis").value="";
    document.getElementById("genre").value="";
    document.getElementById("kode_buku").value="";
}
function Edit(index){
    //set input menjadi update
    document.getElementById('action').value="update";

    var table=document.getElementById("table_buku");


    var judul     = table.rows[index].cells[1].innerHTML;
    var penulis   = table.rows[index].cells[2].innerHTML;
    var genre     = table.rows[index].cells[3].innerHTML;
    var kode_buku = table.rows[index].cells[0].innerHTML;

    document.getElementById("judul").value = judul;
    document.getElementById("penulis").value = penulis;
    document.getElementById("genre").value = genre;
    document.getElementById("kode_buku").value = kode_buku;
    
}
</script>
</head>
<body>
<div class="container">
<div class="card col-sm-12">
<div class="header">
<h4>Buku</h4>
</div>
<div class="body">
<?php

$koneksi=mysqli_connect("localhost","root","","perpustakaan");




$sql="select * from buku";
$result=mysqli_query($koneksi,$sql);

$count=mysqli_num_rows($result);

?>
<?php if($count == 0): ?>


<div class="alert alert-info">
Data Belum Tersedia
</div>
<?php else: ?>

<table class="table" id="table_buku">
<thead>
<th>Judul</th>
<th>Penulis</th>
<th>Genre</th>
<th>Kode Buku</th>
<th>Stok</th>
<th>Image</th>
<th>Option</th>
</tr>
</thead>
<tbody>
<?php foreach ($result as $hasil): ?>
<tr>
<td><?php echo $hasil["kode_buku"]; ?> </td>
<td><?php echo $hasil["judul"]; ?> </td>
<td><?php echo $hasil["penulis"]; ?> </td>
<td><?php echo $hasil["stok"]; ?> </td>
<td>
<img src="<?php echo "img_book/" .$hasil["image"];?>"
class="img" width="100">
<button type="button" class="btn btn-info"
data-toggle="modal" data-target="#modal"
onclick="Edit(this.parentElement.parentElement.rowIndex);">
Edit


<a href="db_buku.php?hapus=buku&kode_buku=<?php echo $hasil["kode_buku"];?>"
onclick="return confirm('Apakah Anda Yakin ingin menghapus data ini?')">
<button type="button" class="btn btn-danger">
Hapus
</button>
</a>

</button>
</td>
</tr>

<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
</div>
<div class="footer">
<button type="button" class="btn btn-success"
data-toggle="modal" data-target="#modal" onclick="Add()">
Tambah
</button>
</div>

</div>
</div>


<div class="modal fade" id="modal">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<form action="db_buku.php" method="post" enctype="multipart/form-data">
<div class="modal-header">
<h4>BUKU</h4>
</div>
<div class="modal-body">
<input type="hidden" name="action" id="action">

JUDUL
<input type="text" name="judul" id="judul" class="form-control">
PENULIS
<input type="text" name="penulis" id="penulis" class="form-control">
GENRE
<input type="text" name="genre" id="genre" class="form-control">
KODE BUKU
<input type="text" name="kode_buku" id="kode_buku" class="form-control">
STOK
<input type="text" name="stok" id="stok" class="form-control">
IMAGE
<input type="file" name="image" id="image" class="form-control">

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success">
Simpan
</button>
</div>

</form>
</div>
</div>
<div>


</body>
</html>
