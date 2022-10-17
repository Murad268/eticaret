<?php
  
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   if(isset($_GET["id"])) {
      $gelenId = Guvenlik($_GET["id"]);
   } else {
      $gelenId =  "";
   }

   $deleteAdresFetch = $db->prepare("DELETE FROM adresler WHERE id = ?");
   $deleteAdresFetch->execute([(int)$gelenId]);
   $deletedCount = $deleteAdresFetch->rowCount();
   if($gelenId !== "") {
      if($deletedCount>0) {
         $_SESSION["alert"] = "Adres silindi";
         header("Location: ../adresler");
      } else {
         session_destroy();
         $_SESSION["alert"] = "Gözlənilməz bir xəta baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";
         header("Location: ../adresler");
      }
   } else {
      $_SESSION["alert"] = "Gözlənilməz bir xəta baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";
      header("Location: ../adresler");
   }
?>