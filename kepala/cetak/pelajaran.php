<?php
session_start();
//include_once "../library/inc.sesadmin.php";
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<html>
<head>
<title> :: Laporan Data Pelajaran | Sistem Informasi Akademik Sekolah</title>
<link href="../styles/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> LAPORAN DATA PELAJARAN </h2>
<table class="table-list" width="700" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td width="31" align="center" bgcolor="#F5F5F5"><b>No</b></td>
    <td width="66" bgcolor="#F5F5F5"><b>Kode</b></td>
    <td width="376" bgcolor="#F5F5F5"><b>Nama Pelajaran </b></td>
    <td width="206" bgcolor="#F5F5F5"><b>Keterangan</b></td>
  </tr>
  <?php
	$mySql = "SELECT * FROM pelajaran ORDER BY kode_pelajaran ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myData['kode_pelajaran']; ?></td>
    <td><?php echo $myData['nama_pelajaran']; ?></td>
    <td><?php echo $myData['keterangan']; ?></td>
  </tr>
  <?php } ?>
</table>
<img src="../images/btn_print.png" width="20" onClick="javascript:window.print()" />
</body>
</html>