<?php
//include_once "library/inc.sesadmin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";


# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris	= 50;
$hal 	= isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql= "SELECT * FROM guru";
$pageQry= mysql_query($pageSql, $koneksidb) or die ("error paging: ".mysql_error());
$jumlah	= mysql_num_rows($pageQry);
$maks	= ceil($jumlah/$baris);
$mulai	= $baris * ($hal-1); 
?>
<table width="700" border="0" cellpadding="2" cellspacing="0" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1 align="center"><b>DATA GURU </b></h1></td>
  </tr>
  <tr>
    <td colspan="2"><a href="?open=Guru-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="25" height="23" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="60" bgcolor="#F5F5F5"><strong>Kode</strong></td>
        <td width="97" bgcolor="#F5F5F5"><strong>NIP</strong></td>
        <td width="317" bgcolor="#F5F5F5"><strong>Nama Guru </strong></td>
        <td width="71" bgcolor="#F5F5F5"><strong>Kelamin</strong></td>
        <td width="71" bgcolor="#F5F5F5"><strong>Tugas Di SD GLAGAH</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong><strong></strong></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM guru ORDER BY kode_guru ASC LIMIT $mulai, $baris";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = $mulai; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_guru'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_guru']; ?></td>
        <td><?php echo $myData['nip']; ?></td>
        <td><?php echo $myData['nama_guru']; ?></td>
        <td><?php echo $myData['kelamin']; ?></td>
        <td><?php echo $myData['tugas']; ?></td>
        <td width="45" align="center"><a href="?open=Guru-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a> </td>
        <td width="45" align="center"><a href="?open=Guru-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data"  onclick="return confirm('YAKIN AKAN MENGHAPUS DATA GURU INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr class="selKecil">
    <td height="22" bgcolor="#F5F5F5"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
    <td align="right" bgcolor="#F5F5F5"><b>Halaman ke :</b>
      <?php
	for ($h = 1; $h <= $maks; $h++) {
		echo " <a href='?open=Guru-Data&hal=$h'>$h</a> ";
	}
	?></td>
  </tr>
</table>
