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
      $siparisleriAra = $db->prepare("SELECT * FROM siparisler WHERE sifarisNumarasi = $gelenId");
      $siparisleriAra->execute();
      $aranmisSiparisler = $siparisleriAra->fetchAll(PDO::FETCH_ASSOC);
      $arama = $siparisleriAra->rowCount();
    

      if($arama<0) {
         $_SESSION["bankDel"] = "Xəta";
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55&sepet=$gelenId");
         exit();
      } else {
         foreach($aranmisSiparisler as $siparisler) {
          
            $goodsFetch = $db->prepare("UPDATE goods SET toplamSatisSyisi=toplamSatisSyisi + ? WHERE id = ?");
            $goodsFetch->execute([1, $siparisler["urunİd"]]);
            $goodsCount = $goodsFetch->rowCount();
            if($goodsCount<0) {
               $_SESSION["bankDel"] = "Xəta";
               header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55&sepet=$gelenId");
               exit();
            } else {
               $variantSorgusu = $db->prepare("UPDATE urunvariantlari SET stokAdedi=stokAdedi-? WHERE urunİd = ? AND variantAdi=?");
               $variantSorgusu->execute([$siparisler["toplamUrunAdedi"], $siparisler["urunİd"], $siparisler["variantSecimi"]]);
               $variantNeticeleri = $variantSorgusu->rowCount();
        
               if($variantNeticeleri<0) {
                  $_SESSION["bankDel"] = "Xəta";
                  header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55&sepet=$gelenId");
                  exit();
               } else {
                  unset($_SESSION["bankDel"]);
                  $siparisiGuncelle = $db->prepare("UPDATE siparisler SET onayDurumu = ?, kargoDurumu = ?, kargoGonderiKodu = ? WHERE sifarisNumarasi = ?");
                  $siparisiGuncelle->execute([1, 1, $kod, $gelenId]);
                  $siparisCount = $siparisiGuncelle->rowCount();
                  if($siparisCount > 0) {
                     unset($_SESSION["bankDel"]);
                     header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55");
                     exit();
                  } else {
                     $_SESSION["bankDel"] = "Xəta";
                     header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=55&sepet=$gelenId");
                     exit();
                  }
               }
            }
         }
      }
   
  

   }
?>