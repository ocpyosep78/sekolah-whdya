<?php
//include_once "library/inc.sesadmin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php"; 
?>
<table width="800" border="0" cellpadding="2" cellspacing="0" class="table-border">
  <tr>
    <td colspan="2" align="right"><h1 align="center"><b>DATA PELAJARAN </b></h1></td>
  </tr>
  <tr>
    <td colspan="2"><a href="?open=Pelajaran-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2" bgcolor="#FFFF99">
      <tr>
        <td width="25" align="center" bgcolor="#33FFFF"><strong>No</strong></td>
        <td width="60"bgcolor="#33FFFF"><strong>Kode</strong></td>
        <td width="437" bgcolor="#33FFFF"><strong>Nama Pelajaran </strong></td>
        <td width="143" bgcolor="#33FFFF"><strong>Keterangan</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b></td>
      </tr>
      <?php
	$mySql = "SELECT * FROM pelajaran ORDER BY kode_pelajaran ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query pelajaran salah : ".mysql_error());
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_pelajaran'];
		
		// Gradasi warna baris
		if($nomor%2==1) { $warna="#FFFF99"; } else {$warna="#FFFF99";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td align="center"><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_pelajaran']; ?></td>
        <td><?php echo $myData['nama_pelajaran']; ?></td>
        <td><?php echo $myData['keterangan']; ?></td>
        <td width="50" align="center"><a href="?open=Pelajaran-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="50" align="center"><a href="?open=Pelajaran-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA PELAJARAN INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>
