<?php
session_start();
mysql_connect("localhost","root","") or die("Nggak bisa koneksi");
mysql_select_db("sekolahdb");//sesuaikan dengan nama database anda

$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];

if($op=="in"){
$cek = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$password'");
if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
$c = mysql_fetch_array($cek);
$_SESSION['username'] = $c['username'];
$_SESSION['level'] = $c['level'];
if($c['level']=="admin"){
header("location:index.php");
}else if($c['level']=="kepala"){
header("location:kepala/in.php");
}else if($c['level']=="kepala"){
header("location:kepala/home.php");
}
}else{
die("password salah <a href=\"javascript:history.back()\">kembali>");
}
}else if($op=="out"){
unset($_SESSION['username']);
unset($_SESSION['level']);
header("location:../login.php");
}
?>