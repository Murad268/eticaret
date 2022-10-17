<?php

   try{
      $db = new PDO("mysql:host=localhost; dbname=megashoes; charset=utf8", "root", "");
   }catch(PDOException $error) {
      echo "baglanti hatasi";
      echo $error->getMessage();
      die();
   }
   $ayarlarSorgusu = $db->prepare("SELECT * FROM ayarlar LIMIT 1");
   $ayarlarSorgusu->execute();
   $ayarSayisi = $ayarlarSorgusu->rowCount();
   $ayarlar = $ayarlarSorgusu->fetch(PDO::FETCH_ASSOC);
   if($ayarSayisi > 0) {
      $ad = $ayarlar["siteAdi"];
      $title = $ayarlar["siteTitle"];
      $desc = $ayarlar["siteDesc"];
      $keywords = $ayarlar["siteKeywords"];
      $copyWriteMetni = $ayarlar["siteCopywriteMetni"];
      $logo = $ayarlar["siteLogosu"];
      $mail = $ayarlar["siteMailAdresi"];
      $mailPass = $ayarlar["siteEmailSifresi"];
      $hostAdresi = $ayarlar["host"];
      $siteAdresi = $ayarlar["siteAdresi"];
      $dolarKuru = $ayarlar["DolarKuru"];
      $euroKuru = $ayarlar["EuroKuru"];
      $kargoBaraji = $ayarlar["kargoBaraji"];
      $SosyalLinkFacebook = $ayarlar["SosyalLinkFacebook"];
      $SosyalLinkTwitter = $ayarlar["SosyalLinkTwitter"];
      $SosyalLinkInstagram = $ayarlar["SosyalLinkInstagram"];
      $SosyalLinkLinkedin = $ayarlar["SosyalLinkLinkedin"];
      $SosyalLinkYoutube = $ayarlar["SosyalLinkYoutube"];
      $SosyalLinkPrinterest = $ayarlar["SosyalLinkPrinterest"];
   } else {
      echo "site ayar sorgusu hatali";
      die();
   }




   $metinlerSorgusu = $db->prepare("SELECT * FROM sozlesmemetinleri LIMIT 1");
   $metinlerSorgusu->execute();
   $metinlerSayisi = $metinlerSorgusu->rowCount();
   $metinler = $metinlerSorgusu->fetch(PDO::FETCH_ASSOC);

   if($metinlerSayisi > 0) {
      $hakkimizdaMetni = $metinler["hakkimizdaMetni"];
      $UyelikSozlezmesiMetni = $metinler["UyelikSozlezmesiMetni"];
      $kullanimKosullariMetni = $metinler["kullanimKosullariMetni"];
      $mesafeliSatisSozlesmesiMetni = $metinler["mesafeliSatisSozlesmesiMetni"];
      $gizlilikSozlezlesmesiMetni = $metinler["gizlilikSozlezlesmesiMetni"];
      $teslimatMetni = $metinler["teslimatMetni"];
      $iptalIadeDeyisimMetni = $metinler["iptalIadeDeyisimMetni"];
   } else {
      echo "site ayar sorgusu hatali";
      die();
   }


  


   if(isset($_SESSION["userName"])) {
      $usersFetch = $db->prepare("SELECT * FROM users WHERE email = ?");
      $usersFetch->execute([$_SESSION["email"]]);
      $userCount = $usersFetch->rowCount();
      $users = $usersFetch->fetch(PDO::FETCH_ASSOC);
   
     if($userCount > 0) {
      $id = $users["id"];
      $userName = $users["full_name"];
      $email = $users["email"];
      $phone = $users["phone"];
      $sex = $users["sex"];
      $ip = $users["ip"];
      $password = $users["sifre"];
      $registrationDate = $users["regDate"];
      $code = $users["activationCode"];
     }
   }


   if(isset($_SESSION["admin"])) {
      $adminsetch = $db->prepare("SELECT * FROM admindadas WHERE 	adminAdi = ?");
      $adminsetch->execute([$_SESSION["admin"]]);
      $adminsCount = $adminsetch->rowCount();
      $admins = $adminsetch->fetch(PDO::FETCH_ASSOC);
   
     if($adminsCount > 0) {
      $admin_id = $admins["id"];
      $adminAdi = $admins["adminAdi"];
      $adminSifresi = $admins["adminSifresi"];
      $adminEmaili = $admins["adminEmaili"];
      $adminAdSoyad = $admins["adminAdSoyad"];
      $dminTelefon = $admins["adminTelefon"];
 
     } 
   }
?>