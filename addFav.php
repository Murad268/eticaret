<?php
   if(isset($_GET["id"])) {
      $gelenId = Guvenlik($_GET["id"]);
   } else {
      $gelenId = "";
   }
  
   if($gelenId != "") {
      if(!isset($_SESSION["userName"])) {
         $_SESSION["message"] = "Əvvəlcə giriş etməlisiniz.";
         header("Location: user-enter");
      } else {
         $addFavoriteFetch = $db->prepare("INSERT INTO favoriler (urunId, uyeId ) values ($gelenId, $id)");
         $addFavoriteFetch->execute();
         $addFavoriteFetchCount = $addFavoriteFetch->rowCount();
         if($addFavoriteFetchCount>0) {
            $_SESSION["message"] = "Məhsul favorilere əlavə edildi";
            header("Location: index.php?sayfaKodu=52&id=".$gelenId);
         }
      }
   } else {
      header("Location: index.php");
      exit();
   }
?>