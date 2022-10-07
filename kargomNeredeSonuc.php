

<?php
   if(isset($_POST["kargoKodu"])) {
      $gelenKargoKodu = sayiliIcerikleriFiltrele(Guvenlik($_POST["kargoKodu"]));
   } else {
      $gelenKargoKodu = "";
   }

   if($gelenKargoKodu !== "") {
      header("Location: https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=".$gelenKargoKodu);
      exit();
   } else {
      header("Location: index.php?sayfaKodu=14");
      exit();
   }
?>