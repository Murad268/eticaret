<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_POST["siteName"])) {
      $siteName = $_POST["siteName"];
   } else {
      $siteName = "";
   }


   if(isset($_POST["siteTitle"])) {
      $siteTitle = $_POST["siteTitle"];
   } else {
      $siteTitle = "";
   }


   if(isset($_POST["siteDesc"])) {
      $siteDesc = $_POST["siteDesc"];
   } else {
      $siteDesc = "";
   }



   if(isset($_POST["siteKeywords"])) {
      $siteKeywords = $_POST["siteKeywords"];
   } else {
      $siteKeywords = "";
   }


   if(isset($_POST["siteCopyright"])) {
      $siteCopyright = $_POST["siteCopyright"];
   } else {
      $siteCopyright = "";
   }


   if(isset($_POST["siteAdres"])) {
      $siteAdres = $_POST["siteAdres"];
   } else {
      $siteAdres = "";
   }


   if(isset($_POST["siteEmail"])) {
      $siteEmail = $_POST["siteEmail"];
   } else {
      $siteEmail = "";
   }

   if(isset($_POST["siteMailPass"])) {
      $siteMailPass = $_POST["siteMailPass"];
   } else {
      $siteMailPass = "";
   }
   

   if(isset($_POST["siteHostAdres"])) {
      $siteHostAdres = $_POST["siteHostAdres"];
   } else {
      $siteHostAdres = "";
   }


   if(isset($_POST["siteFacebook"])) {
      $siteFacebook = $_POST["siteFacebook"];
   } else {
      $siteFacebook = "";
   }


   if(isset($_POST["siteLinkedin"])) {
      $siteLinkedin = $_POST["siteLinkedin"];
   } else {
      $siteLinkedin = "";
   }


   if(isset($_POST["siteInstagram"])) {
      $siteInstagram = $_POST["siteInstagram"];
   } else {
      $siteInstagram = "";
   }
   if(isset($_POST["siteTwitter"])) {
      $siteTwitter = $_POST["siteTwitter"];
   } else {
      $siteTwitter = "";
   }
   if(isset($_POST["sitePrinterest"])) {
      $sitePrinterest = $_POST["sitePrinterest"];
   } else {
      $sitePrinterest = "";
   }


   if(isset($_POST["siteYotube"])) {
      $siteYotube = $_POST["siteYotube"];
   } else {
      $siteYotube = "";
   }

   if(isset($_POST["siteDollar"])) {
      $siteDollar = $_POST["siteDollar"];
   } else {
      $siteDollar = "";
   }


   if(isset($_POST["siteEuro"])) {
      $siteEuro = $_POST["siteEuro"];
   } else {
      $siteEuro = "";
   }


   if(isset($_POST["siteKargoMax"])) {
      $siteKargoMax = $_POST["siteKargoMax"];
   } else {
      $siteKargoMax = "";
   }

 

  

   if(!empty($_FILES["logo"]["error"] !== 4)) {
      if(($_FILES["logo"]["tmp_name"]) and ($_FILES["logo"]["name"]) and ($_FILES["logo"]["type"]) and ($_FILES["logo"]["error"] == 0) and ($_FILES["logo"]["size"] > 0)) {
         move_uploaded_file($_FILES["logo"]["tmp_name"], "../assets/images/logo.png");
         unset($_SESSION["logomess"]);
      } else {
         $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
      }
   } else {
      unset($_SESSION["logomess"]);
   }
   if(($siteName == "") or ($siteTitle == "") or ($siteDesc == "") or ($siteKeywords == "") or ($siteCopyright == "") or ($siteAdres == "") or ($siteEmail == "") or ($siteMailPass == "") or ($siteHostAdres == "") or ($siteFacebook == "") or ($siteLinkedin == "") or ($siteInstagram == "") or ($sitePrinterest == "") or ($siteYotube == "") or ($siteDollar == "") or ($siteEuro == "") or ($siteKargoMax == "") or ($siteTwitter == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=1");
      exit();
   } else {
      $ayarlariSorgula = $db->prepare("UPDATE ayarlar SET siteAdi = ?, siteTitle = ?, siteDesc  = ?, siteKeywords = ?, siteCopywriteMetni = ?, siteMailAdresi = ?, siteEmailSifresi = ?, host = ?, siteAdresi = ?, DolarKuru = ?, EuroKuru = ?, kargoBaraji = ?, SosyalLinkFacebook = ?, SosyalLinkTwitter = ?, SosyalLinkInstagram = ?, SosyalLinkLinkedin = ?, SosyalLinkYoutube = ?, SosyalLinkPrinterest = ?");
      $ayarlariSorgula->execute([$siteName, $siteTitle, $siteDesc, $siteKeywords, $siteCopyright, $siteEmail, $siteMailPass, $siteHostAdres, $siteAdres,  $siteDollar, $siteEuro, $siteKargoMax, $siteFacebook, $siteTwitter, $siteInstagram, $siteLinkedin, $siteYotube, $sitePrinterest]);
   }
   $deyisenAyarSayi = $ayarlariSorgula->rowCount();
   if($deyisenAyarSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=1");
      exit();
   } else {
      $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=1");
      exit();
   }
?>