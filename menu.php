<?php

//session_start();
//cek apakah user sudah login
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

//cek level user
if($_SESSION['level']!="admin"){
die("Anda bukan a");//jika bukan user jangan lanjut
} {
?>
	<ul>
	<li><a href='?open' title='Halaman Utama'>Home</a></li>
	
	<li><a href='?open=Pelajaran-Data' title='Pelajaran' target="_self"> Data Pelajaran</a></li>
	<li><a href='?open=Guru-Data' title='Guru'> Data Guru</a></li>
	<li><a href='?open=Siswa-Data' title='Siswa'> Data Siswa</a></li>
	<li><a href='?open=Kelas-Data' title='Kelas'> Data Kelas</a></li>
	<li><a href='?open=Nilai-Data' title='Nilai'> Nilai Kelas</a></li>
	<li><a href='?open=Laporan' title='Laporan'> Laporan</a></li>
	<li><a href='logout.php' title='Logout (Exit)'>Logout</a></li>
	</ul>
<?php
}
{ ?>
	<ul>
	<li><a href='Login.php' title='Login System'>Login</a></li>	
	</ul>
<?php 
}
?>