<!DOCTYPE html>
<html>
<head>
<meta charset="uth-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Daftar Siswa</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
        function Add(){
            //set input action menjadi insert
            document.getElementById('action').value="insert";
            // kosongkan inputan form-nya
            document.getElementById("nisn").value="";
            document.getElementById("nama").value="";
            document.getElementById("alamat").value="";
        }
        function Edit(index){
            //set input action menjadi update
            document.getElementById('action').value="update";

            //set form berdasarkan data tabel yang dipilih
            var table=document.getElementById("table_siswa");
            // tapung data dari tabel
            var nisn = table.rows[index].cells[0].innerHTML;
            var nama = table.rows[index].cells[1].innerHTML;
            var alamat = table.rows[index].cells[2].innerHTML;

            //keluarkan pada form
            document.getElementById("nisn").value = nisn;
            document.getElementById("nama").value = nama;
            document.getElementById("alamat").value = alamat;

        }

        </script>
        </head>
<body>
    <div class="container">
    <div class="card col-sm-12">
    <div class="header">
    <h4>Daftar Siswa</h4>
    </div>
    <div class="body">
    <?php
    //membuat koneksi untuk ke databaSE
    $koneksi=mysqli_connect("localhost","root","","crud");
    //localohost = host name
    //root = username utuk akses database
    //" = password untuk akses database
    //crud = nama databasenya
    $sql="select * from siswa";
    $result=mysqli_query($koneksi,$sql);
    //digunakan untuk eksekusi sintak sql
    $count=mysqli_num_rows($result)
    //digunakan untuk menampilkan jumlah data
?>
<?php if($count == 0): ?>
<!-- jika data dari database kosong, maka akan muncul 
pesan informasi -->
<div class=" alert alert-info">
    Data Belum Tersedia
</div>
<?php else: ?>
<!-- Jika datanya ada maka akan ditampilkan pada tabel -->
<table class="table" id="table_siswa">
<thead>
    <th>NISN</th>
    <th>Nama</th>
    <th>Alamat</th>
    <th>Opsi</th>
</tr>
</thead>
<tbody>
    <?php foreach ($result as $hasil): ?>
    <tr>
        <td><?php echo $hasil["nisn"]; ?></td>
        <td><?php echo $hasil["nama"]; ?></td>
        <td><?php echo $hasil["alamat"]; ?></td>
        <td>
            <button type="button" class="btn btn-info"
            data-toggle="modal" data-target="#modal"
            onclick="Edit(this.parentElement.parentElement.rowIndex);">
            Edit 


<a href="db.php?hapus=siswa&nisn=<?php echo $hasil["nisn"];?>"
onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
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

    <!-- membuat modal atau pop up -->
    <div class="modal fade" id="modal">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form action="db.php" method="post">
    <div class="modal-header">
    <h4>Form Siswa</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="action" id="action">
    <!-- untuk menyimpan aksi yang akan dilakukan entah itu insert atau update -->
    NISN
    <input type="text" name="nisn" id="nisn" class="form-control">
    Nama
    <input type="text" name="nama" id="nama" class="form-control">
    Alamat
    <input type="text" name="alamat" id="alamat" class="form-control">
    </div>
    <div class="modal-footer">
    <button type="submit" class="btn btn-success">
    Simpan
    </button>
    </div>

    </form>
    </div>
    </div>
    </div>
</body>
</html>