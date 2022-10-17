<?php
   if(isset($_POST["full_name"])) {
      $gelenAdSoyad = Guvenlik($_POST["full_name"]);
   } else {
      $gelenAdSoyad = "";
   }

   if(isset($_POST["adres"])) {
      $gelenAdres= Guvenlik($_POST["adres"]);
   } else {
      $gelenAdres = "";
   }

   if(isset($_POST["ilce"])) {
      $gelenIlce= Guvenlik($_POST["ilce"]);
   } else {
      $gelenIlce = "";
   }

   if(isset($_POST["city"])) {
      $gelenCity= Guvenlik($_POST["city"]);
   } else {
      $gelenCity = "";
   }


   if(isset($_POST["phone"])) {
      $gelenPhone= Guvenlik($_POST["phone"]);
   } else {
      $gelenPhone = "";
   }



   if(($gelenAdSoyad !== "") or ($gelenAdres !== "") or ($gelenCity !== "") or ($gelenPhone !== "") or ($gelenIlce !== "")) {
    
      $selectFetch = $db->prepare("SELECT * FROM adresler WHERE id=?");
      $selectFetch->execute([$_GET["id"]]);
      $selectCount = $selectFetch->rowCount();
      $select = $selectFetch->fetch(PDO::FETCH_ASSOC);
      if(($gelenAdSoyad == $select["adSoyad"]) and ($gelenAdres == $select["adres"]) and ($gelenIlce == $select["ilce"]) and ($gelenCity == $select["sehir"]) and ($gelenPhone == $select["telefonNumarasi"])){
         $_SESSION["alert"] = "Heç bir məlumat dəyişdirilmədi.";
         header("Location: ../adresler");
       
      
      } else {
         $addFetch = $db->prepare("UPDATE adresler SET adSoyad=?, adres=?, ilce=?, sehir=?, telefonNumarasi=? WHERE id = ?");
         $addFetch->execute([$gelenAdSoyad, $gelenAdres, $gelenIlce, $gelenCity, $gelenPhone, (int)$_GET["id"]]);
         $addCount = $addFetch->rowCount();
         if($addCount>0) {
            $_SESSION["alert"] = "Adres yeniləndi.";
            header("Location: ../adresler");
         }
        
      }


     
   } else {
      $_SESSION["alert"] = "Məlumatlardan biri və ya hamısı boş göndərildiyi üçün, adres yenilənmədi";
      header("Location: ../adresler");
   }
?>