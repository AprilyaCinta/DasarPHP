<?php
$tahun = date ("Y");
$kabisat = ($tahun%4 == 0) ? "KABISAT" : "BUKAN
KABISAT";
echo "TAHUN <b>$tahun</b> $kabisat";
?>