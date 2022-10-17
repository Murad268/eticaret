<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }
?>
<div class="siteayarlari">
   <div class="panel__header">
      Sayt Parametrləri
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=2" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
         if(isset($_SESSION["logomess"])) {
            $mess = $_SESSION["logomess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
      ?>
      <div class="siteayarlari__ayarlar">
         <div>Site Adı:</div>
         <div><input name="siteName" value="<?=$ad?>" type="text"></div>
         <div>Site Title:</div>
         <div><input name="siteTitle" value="<?=$title?>" type="text"></div>
         <div>Site Description:</div>
         <div><input name="siteDesc" value="<?=$desc?>" type="text"></div>
         <div>Site Keywords:</div>
         <div><input name="siteKeywords" value="<?=$keywords?>" type="text"></div>
         <div>Site Copyright Metni:</div>
         <div><input name="siteCopyright" value="<?=$copyWriteMetni?>" type="text"></div>
         <div>Site Logosu:</div>
         <div class="photo"><input name="logo" type="file"></div>
         <div>Site Linki:</div>
         <div><input name="siteAdres" value="<?=$siteAdresi?>" type="text"></div>
         <div>Site Email Adresi:</div>
         <div><input name="siteEmail" value="<?=$mail?>" type="text"></div>
         <div>Site Email Şifresi:</div>
         <div><input name="siteMailPass" value="<?=$mailPass?>" type="text"></div>
         <div>Site Email Host Adresi:</div>
         <div><input name="siteHostAdres" value="<?=$hostAdresi?>" type="text"></div>
         <div>Facebook Linki:</div>
         <div><input name="siteFacebook" value="<?=$SosyalLinkFacebook?>" type="text"></div>
         <div>Twitter Linki:</div>
         <div><input name="siteTwitter" value="<?=$SosyalLinkTwitter?>" type="text"></div>
         <div>Linkedin Linki:</div>
         <div><input name="siteLinkedin" value="<?=$SosyalLinkLinkedin?>" type="text"></div>
         <div>İnstagram Linki:</div>
         <div><input name="siteInstagram" value="<?=$SosyalLinkInstagram?>" type="text"></div>
         <div>Printerest Linki:</div>
         <div><input name="sitePrinterest" value="<?=$SosyalLinkPrinterest?>" type="text"></div>
         <div>YouTube Linki:</div>
         <div><input name="siteYotube" value="<?=$SosyalLinkYoutube?>" type="text"></div>
         <div>Dolar Kuru:</div>
         <div><input name="siteDollar" value="<?=$dolarKuru?>" type="text"></div>
         <div>Euro Kuru:</div>
         <div><input name="siteEuro" value="<?=$euroKuru?>" type="text"></div>
         <div>Ücretsiz Kargo Barajı:</div>
         <div><input name="siteKargoMax" value="<?=$kargoBaraji?>" type="text"></div>
      </div>
      <button class="btn btn-success">Ayarları Kaydet</button>
   </form>
</div>