<?php
if($_GET) {
	switch($_GET['open']){			
			
		# DATA PELAJARAN
		case 'Pelajaran-Data' :	
			if(!file_exists ("pelajaran_data.php")) die ("Sorry Empty Page!"); 
			include "pelajaran_data.php";	 break;		
		case 'Pelajaran-Add' :				
			if(!file_exists ("pelajaran_add.php")) die ("Sorry Empty Page!"); 
			include "pelajaran_add.php";	 break;		
		case 'Pelajaran-Edit' :				
			if(!file_exists ("pelajaran_edit.php")) die ("Sorry Empty Page!"); 
			include "pelajaran_edit.php"; break;	
		case 'Pelajaran-Delete' :				
			if(!file_exists ("pelajaran_delete.php")) die ("Sorry Empty Page!"); 
			include "pelajaran_delete.php"; break;	

		# DATA GURU
		case 'Guru-Data' :	
			if(!file_exists ("guru_data.php")) die ("Sorry Empty Page!"); 
			include "guru_data.php";	 break;		
		case 'Guru-Add' :				
			if(!file_exists ("guru_add.php")) die ("Sorry Empty Page!"); 
			include "guru_add.php";	 break;		
		case 'Guru-Edit' :				
			if(!file_exists ("guru_edit.php")) die ("Sorry Empty Page!"); 
			include "guru_edit.php"; break;	
		case 'Guru-Delete' :				
			if(!file_exists ("guru_delete.php")) die ("Sorry Empty Page!"); 
			include "guru_delete.php"; break;	

								
		# DATA SISWA
		case 'Siswa-Data' :				
			if(!file_exists ("siswa_data.php")) die ("Sorry Empty Page!"); 
			include "siswa_data.php";	 break;		
		case 'Siswa-Add' :				
			if(!file_exists ("siswa_add.php")) die ("Sorry Empty Page!"); 
			include "siswa_add.php";	 break;		
		case 'Siswa-Edit' :				
			if(!file_exists ("siswa_edit.php")) die ("Sorry Empty Page!"); 
			include "siswa_edit.php"; break;	
		case 'Siswa-Delete' :
			if(!file_exists ("siswa_delete.php")) die ("Sorry Empty Page!"); 
			include "siswa_delete.php"; break;		

		# DATA KELAS BELAJAR
		case 'Kelas-Data' :				
			if(!file_exists ("kelas_data.php")) die ("Sorry Empty Page!"); 
			include "kelas_data.php";	 break;		
		case 'Kelas-Add' :				
			if(!file_exists ("kelas_add.php")) die ("Sorry Empty Page!"); 
			include "kelas_add.php";	 break;		
		case 'Kelas-Edit' :				
			if(!file_exists ("kelas_edit.php")) die ("Sorry Empty Page!"); 
			include "kelas_edit.php"; break;	
		case 'Kelas-Delete' :
			if(!file_exists ("kelas_delete.php")) die ("Sorry Empty Page!"); 
			include "kelas_delete.php"; break;		

		# DATA NILAI PELAJARAN
		case 'Nilai-Data' :				
			if(!file_exists ("nilai_data.php")) die ("Sorry Empty Page!"); 
			include "nilai_data.php";	 break;		
		case 'Nilai-Add' :				
			if(!file_exists ("nilai_add.php")) die ("Sorry Empty Page!"); 
			include "nilai_add.php";	 break;		
		case 'Nilai-Edit' :				
			if(!file_exists ("nilai_edit.php")) die ("Sorry Empty Page!"); 
			include "nilai_edit.php";	 break;		
		case 'Nilai-Delete' :				
			if(!file_exists ("nilai_delete.php")) die ("Sorry Empty Page!"); 
			include "nilai_delete.php";	 break;		

		# MEMBUAT RAPORT
		case 'Membuat-Raport' :				
			if(!file_exists ("membuat_raport_siswa.php")) die ("Sorry Empty Page!"); 
			include "membuat_raport_siswa.php";	 break;			

		# MASTER DATA
		case 'Laporan' :	
			if(!file_exists ("menu_laporan.php")) die ("Sorry Empty Page!"); 
				include "menu_laporan.php";	break;						
		
			# INFORMASI DAN LAPORAN
			case 'Laporan-User' :				
				if(!file_exists ("laporan_user.php")) die ("Sorry Empty Page!"); 
				include "laporan_user.php"; break;			
			case 'Laporan-Pelajaran' :				
				if(!file_exists ("laporan_pelajaran.php")) die ("Sorry Empty Page!"); 
				include "laporan_pelajaran.php"; break;		
			case 'Laporan-Guru' :				
				if(!file_exists ("laporan_guru.php")) die ("Sorry Empty Page!"); 
				include "laporan_guru.php"; break;		
			case 'Laporan-Guru' :				
				if(!file_exists ("laporan_guru.php")) die ("Sorry Empty Page!"); 
				include "laporan_guru.php"; break;		
			case 'Laporan-Siswa' :				
				if(!file_exists ("laporan_siswa.php")) die ("Sorry Empty Page!"); 
				include "laporan_siswa.php"; break;		
			case 'Laporan-Kelas' :				
				if(!file_exists ("laporan_kelas.php")) die ("Sorry Empty Page!"); 
				include "laporan_kelas.php"; break;		
				
			case 'Laporan-Nilai-Raport' :				
				if(!file_exists ("membuat_nilai_raport.php")) die ("Sorry Empty Page!"); 
				include "membuat_nilai_raport.php"; break;		
	
		default:
			if(!file_exists ("main.php")) die ("Empty Main Page!"); 
			include "main.php";						
		break;
	}
}
else {
	if(!file_exists ("main.php")) die ("Sorry Empty Page!"); 
			include "main.php";
}
?>