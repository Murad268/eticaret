<?php



   if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=45");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }


   $yorumuSil = $db->prepare("DELETE FROM yorumlar WHERE id = $gelenId");
   $yorumuSil->execute();
   $silinenYorumlar = $yorumuSil->rowCount();
   

  
 
    if($silinenYorumlar>0) {
      $yenidenYorumlariSorgula = $db->prepare("SELECT * FROM yorumlar WHERE id = $gelenId");
      $yenidenYorumlariSorgula->execute();
      $urunleriSorgula = $db->prepare("UPDATE goods SET yorumSayisi = yorumSayisi-1, toplamYorumPuani = toplamYorumPuani-? WHERE id=?");
      $yorumlar = $yenidenYorumlariSorgula->fetch(PDO::FETCH_ASSOC);
      $puan = $yorumlar["puan"];
      $urunId = $yorumlar["urunId"];
      $urunleriSorgula->execute([(int)$puan, $urunId]);
      $_SESSION["bankDel"] = "Silindi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=45");
      exit();
    } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=45");
       exit();
    }


?>