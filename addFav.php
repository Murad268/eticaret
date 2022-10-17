<?php
   if(isset($_GET["id"])) {
      $gelenId = Guvenlik($_GET["id"]);
   } else {
      $gelenId = "";
   }
   $urunuSorgula = $db->prepare("SELECT * FROM goods WHERE id = $gelenId LIMIT 1");
   $urunuSorgula->execute();
   $urun = $urunuSorgula->fetch(PDO::FETCH_ASSOC);

   $urunAdi = $urun["urun_adi"];
   if($urun["urunTuru"] == "erkek") {
      $backLink = "kishi-ayakkabisi";
   } else if($urun["urunTuru"] == "kadin") {
      $backLink = "qadin-ayakkabisi";
   } if($urun["urunTuru"] == "cocuk") {
      $backLink = "ushaq-ayakkabisi";
   }

   if($gelenId != "") {
      if(!isset($_SESSION["userName"])) {
         $_SESSION["enterMess"] = "Əvvəlcə giriş etməlisiniz.";
         header("Location: user-enter");
      } else {
         $addFavoriteFetch = $db->prepare("INSERT INTO favoriler (urunId, uyeId ) values ($gelenId, $id)");
         $addFavoriteFetch->execute();
         $addFavoriteFetchCount = $addFavoriteFetch->rowCount();
         if($addFavoriteFetchCount>0) {
            $_SESSION["addFav"] = "Məhsul sevimlilərə əlavə edildi";
            unset($_SESSION["goodDetailsMess"]);
            header("Location: $backLink/$urunAdi/$gelenId");
         }
      }
   } else {
      header("Location: index.php");
      exit();
   }
?>