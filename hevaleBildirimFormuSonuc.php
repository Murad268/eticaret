<?php
   if(isset($_POST["full_name"])) {
      $gelenNameSurname = Guvenlik($_POST["full_name"]);
   } else {
      $gelenNameSurname = "";
   }
   if(isset($_POST["email"])) {
      $email = Guvenlik($_POST["email"]);
   } else {
      $email = "";
   }
   if(isset($_POST["phone"])) {
      $phone = Guvenlik($_POST["phone"]);
   } else {
      $phone = "";
   }
   if(isset($_POST["text"])) {
      $text = Guvenlik($_POST["text"]);
   } else {
      $text = "";
   }
   if(isset($_POST["bank"])) {
      $bank = Guvenlik($_POST["bank"]);
   } else {
      $bank = "";
   }

   if(($gelenNameSurname !== "") and ($email !== "") and ($phone !== "") and ($bank !== null)) {
      $havaleKaydet = $db->prepare("INSERT INTO havalebildirimleri (adSoyad, emailAdresi, telefonNumarası, bankaİd, acıklama, islemTarihi, durum) values (? , ?, ?, ?, ?, ?, ? )");
      $havaleKaydet->execute([$gelenNameSurname, $email, $phone, $bank, $text, $unix, 0]);
      $haveleKaydetKontrol = $havaleKaydet->rowCount();
      if($haveleKaydetKontrol > 0) {
         header("Location: hevaletamam");
         exit();
      } else {
         header("Location: hevalehata");
         exit();
      }
   } else {
      header("Location: hevaleeksik");
      exit();
   }
?>