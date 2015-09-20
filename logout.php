<?php
session_start();
session_destroy();
echo "<script> document.write('Kamu sudah keluar dari halaman member!'); window.location='login.php'</script>";
?>