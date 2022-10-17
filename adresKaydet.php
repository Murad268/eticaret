<?php
 
   if(isset($_POST["full_name"])) {
      $gelenIsimSoIsim = Guvenlik($_POST["full_name"]);
   } else {
      $gelenIsimSoIsim = "";
   }

   if(isset($_POST["adres"])) {
      $gelenAdres = Guvenlik($_POST["adres"]);
   } else {
      $gelenAdres = "";
   }

   if(isset($_POST["ilce"])) {
      $gelenIlce = Guvenlik($_POST["ilce"]);
   } else {
      $gelenIlce = "";
   }

   if(isset($_POST["city"])) {
      $gelenSehir = Guvenlik($_POST["city"]);
   } else {
      $gelenSehir = "";
   }

   if(isset($_POST["phone"])) {
      $GelenTelefon = Guvenlik($_POST["phone"]);
   } else {
      $GelenTelefon = "";
   }

   if(($gelenIsimSoIsim !== "") or ($gelenAdres !== "") or ($gelenSehir !== "") or ($GelenTelefon !== "")or ($gelenIlce !== "")) {
      $addFetch = $db->prepare("INSERT INTO adresler (adSoyad, adres, ilce, sehir, telefonNumarasi, userId ) values (?, ?, ?, ?, ?, ?)");
      $addFetch->execute([$gelenIsimSoIsim, $gelenAdres, $gelenIlce, $gelenSehir, $GelenTelefon, $id]);
      $addCount = $addFetch->rowCount();
      if($addCount>0) {
         $_SESSION["alert"] = "Yeni adres əlavə edildi.";
         header("Location: ./adresler");
      }
   } else {
      $_SESSION["alert"] = "Məlumatlardan biri və ya hamısı boş göndərildiyi üçün, yeni adres əlavə olunmadı";
      header("Location: ./adresler");
   }
?>