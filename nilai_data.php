<?php
//include_once "library/inc.sesadmin.php";
include_once "library/inc.library.php";
include_once "library/inc.connection.php";
# Tahun Terpilih
$dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
$dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
$dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';

# Filter Data Nilai berdasarkan Combo yang dipilih
$filterSQL	= "";
if(isset($_POST['btnPilih1'])) {
    $filterSQL = " WHERE nilai.kode_kelas = '$dataKelas'";
}
elseif(isset($_POST['btnPilih2'])) {
    $filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_pelajaran = '$dataPelajaran'";
}
elseif(isset($_POST['btnPilih3'])) {
    $filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_pelajaran = '$dataPelajaran' AND nilai.semester = '$dataSemester'";
}
else {
    $filterSQL = "";
}
?>
<table  class="table-border" width="700" border="0" cellspacing="1" cellpadding="3">
    <tr>
        <td align="right"><h1 align="center"><strong>DATA NILAI</strong></h1></td>
    </tr>
    <tr>
        <td><form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1" target="_self" id="form1">
                <table class="table-list" width="500" border="0" cellspacing="1" cellpadding="3">
                    <tr>
                        <td colspan="3" bgcolor="#CCCCCC"><strong>FILTER DATA </strong></td>
                    </tr>
                    <tr>
                        <td width="110"><b>Pilih Kelas </b></td>
                        <td width="5"><b>:</b></td>
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
                            <input name="btnPilih1" type="submit" value=" Pilih " /></td>
                    </tr>
                    <tr>
                        <td><b>Pilih Pelajaran </b></td>
                        <td><b>:</b></td>
                        <td>
                            <select name="cmbPelajaran">
                                <option value="KOSONG">....</option>
                                <?php
                                $dataSql = "SELECT pelajaran.* FROM nilai, pelajaran
				WHERE nilai.kode_pelajaran = pelajaran.kode_pelajaran
				AND nilai.kode_kelas = '$dataKelas'
				GROUP BY nilai.kode_pelajaran ORDER BY nilai.kode_pelajaran";
                                $dataQry = mysql_query($dataSql, $koneksidb) or die ("Gagal Query".mysql_error());
                                while ($dataRow = mysql_fetch_array($dataQry)) {
                                    if ($dataRow['kode_pelajaran'] == $dataPelajaran) {
                                        $cek = " selected";
                                    } else { $cek=""; }
                                    echo "<option value='$dataRow[kode_pelajaran]' $cek> $dataRow[nama_pelajaran]</option>";
                                }
                                ?>
                            </select>
                            <input name="btnPilih2" type="submit" value=" Pilih " /></td>
                    </tr>
                    <tr>
                        <td><b>Pilih Semester </b></td>
                        <td><b>:</b></td>
                        <td>
                            <select name="cmbSemester">
                                <option value="KOSONG">....</option>
                                <?php
                                $pilihan	= array("1" => "Ganjil", "2" => "Genap");
                                foreach ($pilihan as $isi => $info ) {
                                    if ($isi == $dataSemester) {
                                        $cek=" selected";
                                    } else { $cek = ""; }
                                    echo "<option value='$isi' $cek> $isi - $info</option>";
                                }
                                ?>
                            </select>
                            <input name="btnPilih3" type="submit" value=" Pilih " /></td>
                    </tr>
                </table>
            </form>
        </td>
    </tr>
    <tr>
        <td><a href="?open=Nilai-Add" target="_self"><img src="images/btn_add_data.png" height="30" border="0" /></a></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><table  class="table-list" width="100%" border="1" cellspacing="1" cellpadding="3">
                <tr>
                    <th width="4%" bgcolor="#CCCCCC"><strong>No</strong></th>
                    <th width="8%" bgcolor="#CCCCCC"><strong>NIS</strong></th>
                    <th width="21%" bgcolor="#CCCCCC"><strong>Nama Siswa</strong></th>
                    <th width="10%" bgcolor="#CCCCCC"><strong>Semester</strong></th>
                    <th width="10%" bgcolor="#CCCCCC"><strong>Tugas 1</strong></th>
                    <th width="10%" bgcolor="#CCCCCC"><strong>Tugas 2</strong></th>
                    <!--<th width="8%" bgcolor="#CCCCCC"><strong>UH 1</strong></th>-->
                    <!--<th width="7%" bgcolor="#CCCCCC"><strong>UH 2</strong></th>-->
                    <th width="5%" bgcolor="#CCCCCC"><strong>UTS</strong></th>
                    <th width="5%" bgcolor="#CCCCCC"><strong>UAS</strong></th>
                    <th width="5%" bgcolor="#CCCCCC"><strong>Rata-rata</strong></th>
                    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
                </tr>
                <?php
                // Skrip menampilkan data Nilai
                $mySql = "SELECT nilai.*, pelajaran.nama_pelajaran, siswa.nama_siswa, siswa.nis FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				LEFT JOIN siswa ON nilai.kode_siswa = siswa.kode_siswa
				$filterSQL ORDER BY semester, kode_pelajaran ASC";
                $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
                $nomor  = 0;
                $data=array();
                while ($myData = mysql_fetch_array($myQry)) {
                    $Kode = $myData['id'];
                    $myData['avg'] = ($myData['nilai_tugas1']+$myData['nilai_tugas2']+$myData['nilai_uts']+$myData['nilai_uas'])/4;
                    array_push($data,$myData);
                }
                //sorting array
                function compare_average($a, $b)
                {
                    return strnatcmp($b['avg'],$a['avg']);
                }
                // sort alphabetically by name
                uasort($data, 'compare_average');
                //looping results
                foreach($data as $md):$nomor++;?>
                    <tr>
                        <td> <?php echo $nomor; ?> </td>
                        <td> <?php echo $md['nis']; ?> </td>
                        <td> <?php echo $md['nama_siswa']; ?> </td>
                        <td> <?php echo $md['semester']; ?> </td>
                        <td> <?php echo $md['nilai_tugas1']; ?> </td>
                        <td> <?php echo $md['nilai_tugas2']; ?> </td>
                        <td> <?php echo $md['nilai_uts']; ?> </td>
                        <td> <?php echo $md['nilai_uas']; ?> </td>
                        <td> <?php echo $md['avg']; ?> </td>
                        <td width="4%" align="center"><a href="?open=Nilai-Edit&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
                        <td width="8%" align="center"><a href="?open=Nilai-Delete&amp;Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA NILAI PELAJARAN INI ... ?')">Delete</a></td>
                    </tr>
                <?php endforeach;
                ?>
            </table></td>
    </tr>
</table>
