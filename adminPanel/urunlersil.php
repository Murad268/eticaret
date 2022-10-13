<?php
   if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=47");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }

   $urunleriSorgula = $db->prepare("UPDATE goods SET durumu = 0 WHERE id = ?");
   $urunleriSorgula->execute([$gelenId]);
   $sepetSorgusu = $db->prepare("DELETE FROM sepet WHERE urunId = ?");
   $sepetSorgusu->execute([$gelenId]);
   $variantSorgusu = $db->prepare("DELETE FROM urunvariantlari WHERE urunİd = ?");
   $variantSorgusu->execute([$gelenId]);
   $yorumlariSorgula = $db->prepare("DELETE FROM yorumlar WHERE urunId = ?");
   $yorumlariSorgula->execute([$gelenId]);
   $urunlerSorgusu = $db->prepare("SELECT * FROM goods WHERE id = $gelenId");
   $urunlerSorgusu->execute();
   $urunler = $urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
   
   $menuUrunSayiAzalt = $db->prepare("UPDATE menuler SET urunSayisi=urunSayisi-1 WHERE id = ?");
   $menuUrunSayiAzalt->execute([$urunler[0]["menuId"]]);
   $menuUrunSayiAzaltCount = $menuUrunSayiAzalt->rowCount();

   header("Location: index.php?index.php?sayfaKoduDis=0&sayfaKoduIc=47");
   exit();
   // $uyeleriSorgula = $db->prepare("SELECT * FROM users WHERE id = $gelenId");
   // $uyeleriSorgula->execute();
   // $uyelerinSayi = $uyeleriSorgula->rowCount();
   // $uyeler = $uyeleriSorgula->fetch(PDO::FETCH_ASSOC);
   // $yorumlariSorgula = $db->prepare("UPDATE yorumlar SET uyeDurumu=1 WHERE uyeId = $gelenId");
   // $yorumlariSorgula->execute();
   // $sepetiSorgula = $db->prepare("DELETE FROM sepet WHERE uyeId = $gelenId");
   // $sepetiSorgula->execute();
   // $uyeSil = $db->prepare("UPDATE users SET SilinmeDurumu=1 WHERE id = $gelenId") ;
   // $uyeSil->execute();
   
   // header("Location: index.php?index.php?sayfaKoduDis=0&sayfaKoduIc=41");
   // exit();
?>