<?php
$day = date("D");
switch ($day){
    case 'Sun' : $day = "Minggu"; break;
    case 'Mon' : $day = "Senin"; break;
    case 'Tue' : $day = "Selasa"; break;
    case 'Wed' : $day = "Rabu"; break;
    case 'Thu' : $day = "Kamis"; break;
    case 'Fri' : $day = "Jum`at"; break;
    case 'Sat' : $day = "Sabtu"; break;
    default    : $day = "Kiamat";
}
echo "Sekarang hari <b>$day</b>";
?>
