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
   $favorilerdenSil = $db->prepare("DELETE FROM favoriler WHERE urunİd = ?");
   $favorilerdenSil->execute([$gelenId]);
   $urunlerSorgusu = $db->prepare("SELECT * FROM goods WHERE id = $gelenId");
   $urunlerSorgusu->execute();
   $urunler = $urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
  
   $menuUrunSayiAzalt = $db->prepare("UPDATE menuler SET urunSayisi=urunSayisi-1 WHERE id = ?");
   $menuUrunSayiAzalt->execute([$urunler[0]["menuId"]]);
   $menuUrunSayiAzaltCount = $menuUrunSayiAzalt->rowCount();

   header("Location: index.php?index.php?sayfaKoduDis=0&sayfaKoduIc=47");
   exit();
   
?>