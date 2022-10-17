<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
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

   
   


   if(($bankname == "") or ($bankseccname == "") or ($bankseccode == "") or ($bankcity == "") or ($bankcountry == "") or ($bankcurrency == "") or ($bankuser == "") or ($bankacccode == "") or ($bankiban == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=9");
      exit();
   } else {
         if(($_FILES["banklogo"]["tmp_name"]) and ($_FILES["banklogo"]["name"]) and ($_FILES["banklogo"]["type"]) and ($_FILES["banklogo"]["error"] == 0) and ($_FILES["banklogo"]["size"] > 0)) {
            $extention = explode("/", $_FILES["banklogo"]["type"])[1];
            $name = $_FILES["banklogo"]["name"].rand();
            $allName = $name.".".$extention;
            move_uploaded_file($_FILES["banklogo"]["tmp_name"], "../assets/images/".$allName);
            unset($_SESSION["logomess"]);
         } else {
            $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
         }
      $bankhesablariniSorgula = $db->prepare("INSERT INTO bankahesablarimiz (bankaAdı, KonumŞehir, konumÜlke, ŞubeAdı, ŞubeKodu, paraBirimi, hesabSahibi, hesabNumarası, ibanNumarası, bankLogo) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $bankhesablariniSorgula->execute([$bankname, $bankcity, $bankcountry, $bankseccname, $bankseccode, $bankcurrency, $bankuser, $bankacccode, $bankiban, $allName]);
   }
   $bankhesablariniSorgulaSayi = $bankhesablariniSorgula->rowCount();
   if($bankhesablariniSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=5");
      exit();
   } else {
      $_SESSION["adminmess"] = "Məlumatların yazılması zamanı xəta.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=9");
      exit();
   }
?>