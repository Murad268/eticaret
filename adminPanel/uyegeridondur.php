<?php
   if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=41");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }

   $uyeleriSorgula = $db->prepare("SELECT * FROM users WHERE id = $gelenId");
   $uyeleriSorgula->execute();
   $uyelerinSayi = $uyeleriSorgula->rowCount();
   $uyeler = $uyeleriSorgula->fetch(PDO::FETCH_ASSOC);
   $yorumlariSorgula = $db->prepare("UPDATE yorumlar SET uyeDurumu=0 WHERE uyeId = $gelenId");
   $yorumlariSorgula->execute();
   $uyeSil = $db->prepare("UPDATE users SET SilinmeDurumu=0 WHERE id = $gelenId") ;
   $uyeSil->execute();
   
   header("Location: index.php?index.php?sayfaKoduDis=0&sayfaKoduIc=43");
   exit();
?>