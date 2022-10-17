<?php
   if(isset($_GET["id"])) {
      $gelenId = Guvenlik($_GET["id"]);
   } else {
      $gelenId = "";
   }
  
   if($gelenId != "") {
      if(!isset($_SESSION["userName"])) {
         $_SESSION["enterMess"] = "Əvvəlcə giriş etməlisiniz.";
         header("Location: user-enter");
      } else {
         $addFavoriteFetch = $db->prepare("DELETE FROM favoriler WHERE uyeId = $id AND urunId = $gelenId");
         $addFavoriteFetch->execute();
         $addFavoriteFetchCount = $addFavoriteFetch->rowCount();
         if($addFavoriteFetchCount>0) {
            $_SESSION["addFav"] = "Məhsul favorilerden silindi";
            unset($_SESSION["goodDetailsMess"]);
            header("Location: index.php?sayfaKodu=52&id=".$gelenId);
         } else {
            echo "error";
         }
      }
   } else {
      header("Location: index.php");
      exit();
   }
?>