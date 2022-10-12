<?php
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }
   $menuSilSorgusu = $db->prepare("DELETE FROM menuler WHERE id = $gelenId");
   $menuSilSorgusu->execute();
   $menuSilSorgusuCount = $menuSilSorgusu->rowCount();
   if($menuSilSorgusuCount > 0) {
      $urunlerMenusu = $db->prepare("SELECT * FROM goods WHERE menuId = ?");
      $urunlerMenusu->execute([$gelenId]);
      $urunlerinSayi = $urunlerMenusu->rowCount();
      if($urunlerinSayi>0) {
         $urunleriSifirla = $db->prepare("UPDATE goods SET durumu = 0 WHERE menuId = ?");
         $urunleriSifirla->execute([$gelenId]);
      }
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
   }
?>