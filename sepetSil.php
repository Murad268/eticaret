<?php
   if(isset($_GET["id"])) {
      $gelenSepetId = $_GET["id"];
   } else {
      $gelenSepetId = "";
   }

   if($gelenSepetId !== "") {
      $deleteCartFetch = $db->prepare("DELETE FROM sepet WHERE id = $gelenSepetId");
      $deleteCartFetch->execute();
      $deleteCartFetchCount = $deleteCartFetch->rowCount();
      if($deleteCartFetchCount>0) {     
         header("Location: sepet");
      } else {
         $_SESSION["cartDell"] = "Sepetden ürün silme zamanı hata oluştu. Bir az sonra yeniden deneyin";
         header("Location: sepet");
      }
   } else {
      header("Location: index.php");
      exit();
   }
   unset($_SESSION["cartDell"]);
?>