<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      BANKA HESAP AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=10" method="post" enctype="multipart/form-data">
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
         <div>Banka Logosu:</div>
            <div class="photo"><input name="banklogo" type="file"></div>
            <div>Bankın Adı:</div>
            <div><input name="bankname" type="text"></div>
            <div>Bankın Şöbəsinin Adı:</div>
            <div><input name="bankseccname" type="text"></div>
            <div>Bankın Şöbe Kodu:</div>
            <div><input name="bankseccode"" type="text"></div>
            <div>Bankanın Yerləşdiyi Şəhər:</div>
            <div><input name="bankcity"  type="text"></div>
            <div>Bankanın Yerləşdiyi Ölkə:</div>
            <div><input name="bankcountry"  type="text"></div>
            <div>Hesabın Valyutası:</div>
            <div><input name="bankcurrency" type="text"></div>
            <div>Hesab Sahibi:</div>
            <div><input name="bankuser" type="text"></div>
            <div>Hesab Nömrəsi:</div>
            <div><input name="bankacccode" type="text"></div>
            <div>İBAN:</div>
            <div><input name="bankiban"  type="text"></div>
         </div>
      <button class="btn btn-success">Bank Hesab Bilgisi əlavə elə</button>
   </form>
</div>