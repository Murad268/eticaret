<?php
   session_start(); ob_start();
   require_once("../ayarlar/ayar.php");
   require_once("../ayarlar/functions.php");
   require_once("../ayarlar/adminInside.php");
   require_once("../ayarlar/adminOutside.php");
   if(isset($_REQUEST["sayfaKoduDis"])) {
      $sayfaKoduDis = Guvenlik($_REQUEST["sayfaKoduDis"]);
   } else {
      $sayfaKoduDis = 0;
   }


   if(isset($_REQUEST["sayfaKoduIc"])) {
      $sayfaKoduIc = Guvenlik($_REQUEST["sayfaKoduIc"]);
   } else {
      $sayfaKoduIc = 0;
   }



   if(isset($_REQUEST["sayfalama"])) {
      $sayfalama = sayiliIcerikleriFiltrele($_REQUEST["sayfalama"]);
   } else {
      $sayfalama = 1;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta http-equiv="Content-Language" content="tr">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta charset="UTF-8">
   <meta name="Robots" content="noindex, nofollow, noarchive">
   <meta name="googlebot" content="noindex, nofollow, noarchive">
   <link rel="shortcut icon" href="../assets/images/Favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <link rel="stylesheet" href="..//ayarlar/admin.css">
   <title><?=$title?></title>

</head>
<body>
   <div class="adminMain">
      <?php
         if(empty($_SESSION["admin"])) {
            if(($sayfaKoduDis == 0) or ($sayfaKoduDis == "") or (!$sayfaKoduDis)) {
               include($outside[1]);
            } else {
               include($outside[$sayfaKoduDis]);
            }
         } else {
            if(($sayfaKoduDis == 0) or ($sayfaKoduDis == "") or (!$sayfaKoduDis)) {
               include($outside[0]);
            } else {
               include($outside[$sayfaKoduDis]);
            }
         }
      ?>
   </div>
   <script type="text/javascript" src="../ayarlar/function.js" language="javascript"></script>
   <script type="text/javascript" src="../freamworks/jquery/jquery-3.6.1.min.js" language="javascript"></script>
</body>

</html>
<?php 
   $db = null;
   ob_flush();
?>