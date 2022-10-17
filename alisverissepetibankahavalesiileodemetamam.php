<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
?>
<div class="sonucWrapper">
   <img src="assets/images/Tamam.png" alt="">
   <div class="sonucWrapperTitle"><b>TEBRİKLER. Siparişiniz Alındı.</b></div>
   <div class="sonucWrapperDesc">
		İlgili birim ödemeniz kontrol ettikten sonra ürün / ürünleriniz kargoya teslim edilecektir. <br>
      Ana sayfaya dönmek için lütfen buraya <a href="index.php"><b>tıklayınız.</b></a>
   </div>
</div>