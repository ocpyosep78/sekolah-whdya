<?php
//include_once "library/inc.sesadmin.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<table width="700" border="0" cellpadding="2" cellspacing="0" class="table-border">
  <tr>
    <td align="right"><h1 align="center"><b>DATA USER </b></h1></td>
  </tr>
  <tr>
    <td><a href="?open=User-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="30" bgcolor="#F5F5F5"><strong>No</strong></td>
        <td width="70" bgcolor="#F5F5F5"><strong>Kode</strong></td>
        <td width="324" bgcolor="#F5F5F5"><strong>Nama User</strong></td>
        <td width="151" bgcolor="#F5F5F5"><strong>Username</strong></td>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><b>Tools</b><b></b></td>
        </tr>
    <?php
	$mySql 	= "SELECT * FROM user ORDER BY kode_user ASC";
	$myQry 	= mysql_query($mySql, $koneksidb)  or die ("Query  salah : ".mysql_error());
	$nomor  = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
		$nomor++;
		$Kode = $myData['kode_user'];
		
		// gradasi warna
		if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
      <tr bgcolor="<?php echo $warna; ?>">
        <td><?php echo $nomor; ?></td>
        <td><?php echo $myData['kode_user']; ?></td>
        <td><?php echo $myData['nama_user']; ?></td>
        <td><?php echo $myData['username']; ?></td>
        <td width="45" align="center"><a href="?open=User-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
        <td width="45" align="center"><a href="?open=User-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA USER INI ... ?')">Delete</a></td>
      </tr>
      <?php } ?>
    </table>	</td>
  </tr>
</table>

