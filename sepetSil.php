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
         header("Location: index.php?sayfaKodu=56");
      } else {
         $_SESSION["message"] = "Sepetden ürün silme zamanı hata oluştu. Bir az sonra yeniden deneyin";
         header("Location: index.php?sayfaKodu=56");
      }
   } else {
      header("Location: index.php");
      exit();
   }
   unset($_SESSION["message"]);
?>