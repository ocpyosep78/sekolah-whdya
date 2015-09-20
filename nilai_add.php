<?php
//include_once "library/inc.sesadmin.php";
include_once "library/inc.library.php";
include_once "library/inc.connection.php";
# TOMBOL SIMPAN DIKLIK
if(isset($_POST['btnSimpan'])){
	// Skrip untuk Validasi dan Simpan data
	# Baca Variabel Form
	$cmbSemester	= $_POST['cmbSemester'];
	$cmbKelas		= $_POST['cmbKelas'];
	$cmbPelajaran	= $_POST['cmbPelajaran'];
	$cmbGuru		= $_POST['cmbGuru'];
	$dataKelas 		= $_POST['dataKelas'];
	
	$query = "SELECT COUNT(*) FROM siswa, kelas_siswa 
			  WHERE siswa.kode_siswa = kelas_siswa.kode_siswa AND kelas_siswa.kode_kelas='$dataKelas'
			  ORDER BY nama_siswa";
	$arrJumlah = mysql_fetch_array(mysql_query($query, $koneksidb));
	$jumlah = $arrJumlah[0];
			
	
		# SIMPAN DATA KE DATABASE. Jika jumlah error $pesanError tidak ada, simpan datanya
		
		while($jumlah>0){
			
			$cmbSiswa		= $_POST['cmbSiswa('.$jumlah.')'];
			$txtTugas1		= $_POST['txtTugas1('.$jumlah.')'];		
			$txtTugas2		= $_POST['txtTugas2('.$jumlah.')'];
			$txtUH1		= $_POST['txtUH1('.$jumlah.')'];
			$txtUH2		= $_POST['txtUH2('.$jumlah.')'];		
			$txtNilaiUTS	= $_POST['txtNilaiUTS('.$jumlah.')'];
			$txtNilaiUAS	= $_POST['txtNilaiUAS('.$jumlah.')'];
			
			$txtKeterangan	= $_POST['txtKeterangan('.$jumlah.')'];
			
			# Validasi Nilai, jika sudah ada akan ditolak
			$sqlCek="SELECT * FROM nilai WHERE semester='$cmbSemester' 
											AND kode_pelajaran='$cmbPelajaran' 
											AND kode_kelas='$cmbKelas' 
											AND kode_siswa='$cmbSiswa' ";
			$qryCek=mysql_query($sqlCek, $koneksidb) or die ("Eror Query".mysql_error()); 
			if(mysql_num_rows($qryCek)>=1){
				$data=mysql_fetch_array($qryCek);
				$pesanError[] = "<b>DATA NILAI UNTUK SISWA ".$data['kode_siswa']." SUDAH DIMASUKAN</b>";
			}

			# JIKA ADA PESAN ERROR DARI VALIDASI
			if (isset($pesanError) AND count($pesanError)>=1 ){
				echo "<div class='mssgBox'>";
				echo "<img src='images/attention.png'> <br><hr>";
					$noPesan=0;
					foreach ($pesanError as $indeks=>$pesan_tampil) { 
					$noPesan++;
						echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
					} 
				echo "</div> <br>"; 
			}else{
				
			$rataRata =($txtTugas1+$txtTugas2+$txtUH1+$txtUH2+$txtNilaiUTS+$txtNilaiUAS)/6;
				$mySql	= "INSERT INTO nilai (semester,kode_pelajaran,kode_guru,kode_kelas, 
										  kode_siswa,nilai_tugas1,nilai_tugas2,nilai_uh1,
										  nilai_uh2,nilai_uts,nilai_uas,rata,keterangan) 
						VALUES ('$cmbSemester','$cmbPelajaran','$cmbGuru','$cmbKelas', 
								'$cmbSiswa','$txtTugas1','$txtTugas2','$txtUH1','$txtUH2',
								'$txtNilaiUTS','$txtNilaiUAS','$rataRata','$txtKeterangan')";
				$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query ".mysql_error());
			}
			
			$jumlah--;
		}
		
		/*if($jumlah==0){
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Nilai-Add'>";
		}
		exit;*/
}

# Membuat Nilai Data pada Variabel Form
$dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';
$dataPelajaran	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
$dataGuru		= isset($_POST['cmbGuru']) ? $_POST['cmbGuru'] : '';
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataSiswa 		= isset($_POST['cmbSiswa']) ? $_POST['cmbSiswa'] : '';
$dataTugas1 	= isset($_POST['txtTugas1']) ? $_POST['txtTugas1'] : '';
$dataTugas2 	= isset($_POST['txtTugas2']) ? $_POST['txtTugas2'] : '';
$dataUH1 	= isset($_POST['txtUH1']) ? $_POST['txtUH1'] : '';
$dataUH2	= isset($_POST['txtUH2']) ? $_POST['txtUH2'] : '';
$dataNilaiUTS 	= isset($_POST['txtNilaiUTS']) ? $_POST['txtNilaiUTS'] : '';
$dataNilaiUAS 	= isset($_POST['txtNilaiUAS']) ? $_POST['txtNilaiUAS'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self">
  <table  class="table-list" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="3" bgcolor="#F5F5F5"><h1><strong>MEMBUAT NILAI HASIL BELAJAR</strong></h1></td>
    </tr>
    <tr>
      <td width="27%" bgcolor="#CCCCCC"><strong>DATA PELAJARAN </strong></td>
      <td width="2%">&nbsp;</td>
      <td width="71%">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Semester</strong></td>
      <td><b>:</b></td>
      <td><select name="cmbSemester">
        <option value="KOSONG">....</option>
        <?php
		  $pilihan	= array("1" => "Ganjil", "2" => "Genap");
          foreach ($pilihan as $isi => $info ) {
            if ($dataSemester==$isi) {
                $cek=" selected";
            } else { $cek = ""; }
            echo "<option value='$isi' $cek> $isi - $info</option>";
          }
          ?>
      </select></td>
    </tr>
    <tr>
      <td><strong>Pelajaran</strong></td>
      <td><b>:</b></td>
      <td>
		<select name="cmbPelajaran">
		<option value="KOSONG">....</option>
		<?php
		$dataSql = "SELECT * FROM pelajaran ORDER BY kode_pelajaran";
		$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
		while ($dataRow = mysql_fetch_array($dataQry)) {
			if ($dataRow['kode_pelajaran'] == $dataPelajaran) {
				$cek = " selected";
			} else { $cek=""; }
			echo "<option value='$dataRow[kode_pelajaran]' $cek> $dataRow[nama_pelajaran]</option>";
		}
		?>
		</select></td>
    </tr>
    <tr>
      <td><b>Guru Pengajar </b></td>
      <td><b>:</b></td>
      <td>
	<select name="cmbGuru">
	<option value="KOSONG">....</option>
	<?php
	$dataSql = "SELECT * FROM guru ORDER BY kode_guru";
	$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kode_guru'] == $dataGuru) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kode_guru]' $cek> $dataRow[nama_guru]</option>";
	}
	?>
	</select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC"><strong>DATA  SISWA </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><b>Pilih Kelas </b></td>
      <td><b>:</b></td>
      <td>
	<select name="cmbKelas">
	<option value="KOSONG">....</option>
	<?php
	$dataSql = "SELECT * FROM kelas ORDER BY tahun_ajar";
	$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kode_kelas'] == $dataKelas) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kode_kelas]' $cek>$dataRow[kelas] | $dataRow[nama_kelas] ( $dataRow[tahun_ajar] )</option>";
	}
	?>
	</select>
    <input name="btnPilih" type="submit" value=" Pilih " /></td>
    </tr>
    <!--<tr>
      <td><b>Pilih Siswa </b></td>
      <td><b>:</b></td>
      <td>
	<select name="cmbSiswa">
	<option value="KOSONG">....</option>
	<?php
	/*$dataSql = "SELECT siswa.* FROM siswa, kelas_siswa 
			  WHERE siswa.kode_siswa = kelas_siswa.kode_siswa AND kelas_siswa.kode_kelas='$dataKelas'
			  ORDER BY nama_siswa";
	$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	while ($dataRow = mysql_fetch_array($dataQry)) {
		if ($dataRow['kode_siswa'] == $dataSiswa) {
			$cek = " selected";
		} else { $cek=""; }
		echo "<option value='$dataRow[kode_siswa]' $cek>$dataRow[nis] - $dataRow[nama_siswa]</option>";
	}*/
	?>
	</select></td>
    </tr>
    
    <tr>
      <td bgcolor="#CCCCCC"><strong>INPUT NILAI </strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Nilai Tugas 1 </strong></td>
      <td><b>:</b></td>
      <td><input name="txtTugas1" type="text" value="<?php echo $dataTugas1; ?>" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td><strong>Nilai Tugas 2 </strong></td>
      <td><b>:</b></td>
      <td><input name="txtTugas2" type="text" value="<?php echo $dataTugas2; ?>" size="10" maxlength="5" /></td>
    </tr>
     <tr>
      <td><strong>Nilai UH 1 </strong></td>
      <td><b>:</b></td>
      <td><input name="txtUH1" type="text" value="<?php echo $dataUH1; ?>" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td><strong>Nilai UH 2 </strong></td>
      <td><b>:</b></td>
      <td><input name="txtUH2" type="text" value="<?php echo $dataUH2; ?>" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td><strong>Nilai UTS (MID) </strong></td>
      <td><b>:</b></td>
      <td><input name="txtNilaiUTS" type="text" value="<?php echo $dataNilaiUTS; ?>" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td><strong>Nilai UAS </strong></td>
      <td><b>:</b></td>
      <td><input name="txtNilaiUAS" type="text" value="<?php echo $dataNilaiUAS; ?>" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td><strong>Keterangan</strong></td>
      <td><b>:</b></td>
      <td><input name="txtKeterangan" type="text" value="<?php echo $dataKeterangan; ?>" size="70" maxlength="100" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type="submit" name="btnSimpan" value=" SIMPAN NILAI " style="cursor:pointer;" /></td>
    </tr>-->
  </table>
  <?php
	$dataSql = "SELECT siswa.* FROM siswa, kelas_siswa 
			  WHERE siswa.kode_siswa = kelas_siswa.kode_siswa AND kelas_siswa.kode_kelas='$dataKelas'
			  ORDER BY nama_siswa";
	$dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
	?>
  <table class="table-list" width="90%" border="1" cellspacing="1" cellpadding="3">
	<tr>
		<th width="21%" bgcolor="#CCCCCC">Nama</th>
		<th width="11%" bgcolor="#CCCCCC">Nilai Tugas 1</th>
		<th width="11%" bgcolor="#CCCCCC">Nilai Tugas 2</th>
		<th width="11%" bgcolor="#CCCCCC">Nilai UH 1</th>
		<th width="11%" bgcolor="#CCCCCC">Nilai UH 2</th>
		<th width="13%" bgcolor="#CCCCCC">Nilai UTS</th>
		<th width="10%" bgcolor="#CCCCCC">Nilai UAS</th>
		<th width="25%" bgcolor="#CCCCCC">Keterangan</th>
	</tr>
	<?php 
	$no=1;
		while($dataRow = mysql_fetch_array($dataQry)){
		
	?>
	<tr>
		<td><?php echo $dataRow['nama_siswa']; ?>
			<input type="hidden" name="cmbSiswa(<?php echo $no;?>)" value="<?php echo $dataRow['kode_siswa']; ?>">
		</td>
		<td><input name="txtTugas1(<?php echo $no;?>)" type="text" required size="10" maxlength="5" /></td>
		<td><input name="txtTugas2(<?php echo $no;?>)" type="text" required size="10" maxlength="5" /></td>
		<td><input name="txtUH1(<?php echo $no;?>)" type="text" required size="10" maxlength="5" /></td>
		<td><input name="txtUH2(<?php echo $no;?>)" type="text" required size="10" maxlength="5" /></td>
		<td><input name="txtNilaiUTS(<?php echo $no;?>)" type="text" required size="10" maxlength="5" /></td>
		<td><input name="txtNilaiUAS(<?php echo $no;?>)" type="text" required size="10" maxlength="5" /></td>
		<td><textarea name="txtKeterangan(<?php echo $no;?>)" type="text" required rows="1" ></textarea>
			<input type="hidden" name="dataKelas" value="<?php echo $dataKelas; ?>">
		</td>
	</tr>
	<?php 
		$no++;
		}
	?>
  </table>
  <input type="submit" name="btnSimpan" value=" SIMPAN NILAI " style="cursor:pointer;" />
</form>
