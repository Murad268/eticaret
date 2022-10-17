<?php
   if(isset($_GET["id"])) {
      $gelenId = $_GET["id"];
   } else {
      $gelenId = "";
   }

   if($gelenId !== "") {
      unset($_SESSION["favorite"]);
      $deleteFavori = $db->prepare("DELETE FROM favoriler WHERE id = ? AND uyeId = ?");
      $deleteFavori->execute([$gelenId, $id]);
      $deletedCount = $deleteFavori->rowCount();
      if($deletedCount > 0) {
       
         header("Location: index.php?sayfaKodu=37");
      }
   } else {
      $_SESSION["favorite"] = "Error. Boş id.";
      header("Location: index.php?sayfaKodu=37");
   }
?>