<?php
session_start();

if(!isset($_SESSION['username'])){
  header('location:login.php');
}

//cek level user
if($_SESSION['level']!="admin"){
  die("Anda bukan a");//jika bukan user jangan lanjut
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title> :: Sistem Informasi Pengolahan Data Nilai SDN GLAGAH</title>
  <link href="styles/style_admin.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="plugins/tigra_calendar/tcal.css" />
  <script type="text/javascript" src="plugins/tigra_calendar/tcal.js"></script>
  <script type="text/javascript">
    function MM_swapImgRestore() { //v3.0
      var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
    }
    function MM_preloadImages() { //v3.0
      var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
        var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
          if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
    }

    function MM_findObj(n, d) { //v4.01
      var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
        d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
      if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
      for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
      if(!x && d.getElementById) x=d.getElementById(n); return x;
    }

    function MM_swapImage() { //v3.0
      var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
        if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
    }
  </script>
</head>
<div id="wrap">
  <body onLoad="MM_preloadImages('images/gbr2.png')">
  <table width="150%" height="500" class="table-main">
    <tr>
      <td height="90" colspan="2"><a href="?open">
          <div id="header"><img src="images/l.png" border="0"></div>
        </a>
      </td>
    </tr>
    <tr valign="top">
      <td width="15%" bgcolor="#66FFFF"  style="border-right:5px solid #DDDDDD;"><div style="margin:5px; padding:5px;"><?php include "menu.php"; ?></div></td>
      <td width="50%" height="500"><div style="margin:3px; padding:3px;"><?php include "open_file.php";?></div></td>
    </tr>
  </table>
  </body>
</div>
</html>
