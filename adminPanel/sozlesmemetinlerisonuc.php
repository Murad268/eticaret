<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_POST["hakkimizdaMetni"])) {
      $hakkimizdaMetni = $_POST["hakkimizdaMetni"];
   } else {
      $hakkimizdaMetni = "";
   }

   if(isset($_POST["uyelikSozlezmesiMetni"])) {
      $uyelikSozlezmesiMetni = $_POST["uyelikSozlezmesiMetni"];
   } else {
      $uyelikSozlezmesiMetni = "";
   }

   if(isset($_POST["kullanimKosullariMetni"])) {
      $kullanimKosullariMetni = $_POST["kullanimKosullariMetni"];
   } else {
      $kullanimKosullariMetni = "";
   }

   if(isset($_POST["gizlilikSozlezlesmesiMetni"])) {
      $gizlilikSozlezlesmesiMetni = $_POST["gizlilikSozlezlesmesiMetni"];
   } else {
      $gizlilikSozlezlesmesiMetni = "";
   }

   if(isset($_POST["mesafeliSatisSozlesmesiMetni"])) {
      $mesafeliSatisSozlesmesiMetni = $_POST["mesafeliSatisSozlesmesiMetni"];
   } else {
      $mesafeliSatisSozlesmesiMetni = "";
   }

   if(isset($_POST["teslimatMetni"])) {
      $teslimatMetni = $_POST["teslimatMetni"];
   } else {
      $teslimatMetni = "";
   }

   if(isset($_POST["iptalIadeDeyisimMetni"])) {
      $iptalIadeDeyisimMetni = $_POST["iptalIadeDeyisimMetni"];
   } else {
      $iptalIadeDeyisimMetni = "";
   }
   
   if(($hakkimizdaMetni == "") or ($uyelikSozlezmesiMetni == "") or ($kullanimKosullariMetni == "") or ($gizlilikSozlezlesmesiMetni == "") or ($mesafeliSatisSozlesmesiMetni == "") or ($teslimatMetni == "") or ($iptalIadeDeyisimMetni == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=3");
      exit();
   } else {
      $sozlesmeMetinleriniDeyis = $db->prepare("UPDATE sozlesmemetinleri set hakkimizdaMetni = ?, UyelikSozlezmesiMetni = ?, kullanimKosullariMetni = ?, mesafeliSatisSozlesmesiMetni = ?, gizlilikSozlezlesmesiMetni = ?, teslimatMetni = ?, iptalIadeDeyisimMetni = ?");
      $sozlesmeMetinleriniDeyis->execute([$hakkimizdaMetni, $uyelikSozlezmesiMetni, $kullanimKosullariMetni, $mesafeliSatisSozlesmesiMetni, $gizlilikSozlezlesmesiMetni, $teslimatMetni, $iptalIadeDeyisimMetni]);
      $DeyisilmisSozlesmeMetinlerininSayi = $sozlesmeMetinleriniDeyis->rowCount();
      if($DeyisilmisSozlesmeMetinlerininSayi > 0) {
         unset($_SESSION["adminmess"]);
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=3");
         exit();
      } else {
         $_SESSION["adminmess"] = "Heç bir məlumat dəyişdirilmədi";
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=3");
         exit();
      }
   } 
?>