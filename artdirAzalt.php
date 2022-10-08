<?php
   require_once("ayarlar/ayar.php");
   require_once("ayarlar/functions.php");
   if($_GET["islem"] == "artdir") {
      $gelenId = $_GET["id"];
      $addCount = $db->prepare("UPDATE sepet SET urunAdedi=urunAdedi+1 WHERE id = $gelenId");
      $addCount->execute();
      $addCountCount = $addCount->rowCount();
      if($addCountCount>0) {
         header("Location: index.php?sayfaKodu=56"); 
      } 
   }
   if($_GET["islem"] == "azalt") {
      $gelenId = $_GET["id"];
      $addCount = $db->prepare("UPDATE sepet SET urunAdedi=urunAdedi-1 WHERE id = $gelenId");
      $addCount->execute();
      $addCountCount = $addCount->rowCount();
      if($addCountCount>0) {
         header("Location: index.php?sayfaKodu=56"); 
      } 
   }
?>