<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }
   if(isset($_GET["id"]) ) {
      $gelenId = $_GET["id"];
     } else {
         $gelenId = "";
     }
     if($gelenId == "") {
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=7&id=$gelenId");
     }
   if(isset($_POST["bankname"])) {
      $bankname = $_POST["bankname"];
   } else {
      $bankname = "";
   }

   if(isset($_POST["bankseccname"])) {
      $bankseccname = $_POST["bankseccname"];
   } else {
      $bankseccname = "";
   }

   if(isset($_POST["bankseccode"])) {
      $bankseccode = $_POST["bankseccode"];
   } else {
      $bankseccode = "";
   }
 
   if(isset($_POST["bankcity"])) {
      $bankcity = $_POST["bankcity"];
   } else {
      $bankcity = "";
   }
  
   if(isset($_POST["bankcountry"])) {
      $bankcountry = $_POST["bankcountry"];
   } else {
      $bankcountry = "";
   }

   if(isset($_POST["bankcurrency"])) {
      $bankcurrency = $_POST["bankcurrency"];
   } else {
      $bankcurrency = "";
   }

   if(isset($_POST["bankuser"])) {
      $bankuser = $_POST["bankuser"];
   } else {
      $bankuser = "";
   }

   if(isset($_POST["bankacccode"])) {
      $bankacccode = $_POST["bankacccode"];
   } else {
      $bankacccode = "";
   }

   if(isset($_POST["bankiban"])) {
      $bankiban = $_POST["bankiban"];
   } else {
      $bankiban = "";
   }

   $extention = explode("/", $_FILES["banklogo"]["type"])[1];
   $name = $_FILES["banklogo"]["name"].rand();
   $allName = $name.".".$extention;
   

 

   

   if(($bankname == "") or ($bankseccname == "") or ($bankseccode == "") or ($bankcity == "") or ($bankcountry == "") or ($bankcurrency == "") or ($bankuser == "") or ($bankacccode == "") or ($bankiban == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=7&id=$gelenId");
      exit();
   } else {
      $bankhesablariniSorgula = $db->prepare("UPDATE bankahesablarimiz SET bankaAdı = ?, KonumŞehir = ?, konumÜlke  = ?, ŞubeAdı = ?, ŞubeKodu = ?, paraBirimi = ?, hesabSahibi = ?, hesabNumarası = ?, ibanNumarası = ? WHERE id = $gelenId");
      $bankhesablariniSorgula->execute([$bankname, $bankcity, $bankcountry, $bankseccname, $bankseccode, $bankcurrency, $bankuser, $bankacccode, $bankiban]);
      if(!empty($_FILES["banklogo"]["error"] !== 4)) {
         if(($_FILES["banklogo"]["tmp_name"]) and ($_FILES["banklogo"]["name"]) and ($_FILES["banklogo"]["type"]) and ($_FILES["banklogo"]["error"] == 0) and ($_FILES["banklogo"]["size"] > 0)) {
            move_uploaded_file($_FILES["banklogo"]["tmp_name"], "../assets/images/".$allName);
            $bankaLogoSorgula = $db->prepare("UPDATE bankahesablarimiz SET bankLogo=? WHERE id = ?");
            $bankaLogoSorgula->execute([$allName, $gelenId]);
            $_SESSION["logomess"] = "Yalnızca şəkil yeniləndi";
         } else {
            $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
         }
      } else {
         unset($_SESSION["logomess"]);
         $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
      }
   }
   $bankhesablariniSorgulaSayi = $bankhesablariniSorgula->rowCount();
   if($bankhesablariniSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      unset($_SESSION["logomess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=5");
      exit();
   } else {
      $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=7&id=$gelenId");
      exit();
   }
?>