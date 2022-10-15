<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_GET["sepet"])) {
      $gelenId = $_GET["sepet"];
   } else {
      $gelenId = "";
   }

   if(isset($_POST["kod"])) {
      $kod = $_POST["kod"];
   } else {
      $kod = "";
   }



   if(($gelenId == "") or ($kod == "")) {
      $_SESSION["bankDel"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55&sepet=$gelenId");
      exit();
   } else {
      unset($_SESSION["bankDel"]);
      $siparisiGuncelle = $db->prepare("UPDATE siparisler SET onayDurumu = ?, kargoDurumu = ?, kargoGonderiKodu = ? WHERE sifarisNumarasi = ?");
      $siparisiGuncelle->execute([1, 1, $kod, $gelenId]);
      $siparisCount = $siparisiGuncelle->rowCount();
      if($siparisCount > 0) {
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55");
      } else {
         $_SESSION["bankDel"] = "Xəta";
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55&sepet=$gelenId");
         exit();
      }

   }
?>