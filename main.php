

<?php
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

//cek level user
if($_SESSION['level']!="admin"){
die("Anda bukan admin");//jika bukan user jangan lanjut
}
 {
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo " <img src='images/pic1.jpg' width='570' height='365'/> ";
	
	exit;
}


?>