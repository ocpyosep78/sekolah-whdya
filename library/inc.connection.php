<?php
# Konek ke Web Server Lokal
$myHost	= "yus.dev";
$myUser	= "root";
$myPass	= "rahasia";
$myDbs	= "helper_sekolah";

# Konek ke Web Server Lokal
$koneksidb	= mysql_connect($myHost, $myUser, $myPass) or die ("Koneksi ke MySQL tidak berhasil ".mysql_error());

# Memilih database pd MySQL Server
mysql_select_db($myDbs, $koneksidb) or die ("Database <>$myDbs</> tidak ditemukan ! ".mysql_error());
?>