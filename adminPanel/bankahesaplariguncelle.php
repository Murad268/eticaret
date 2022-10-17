<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }
     if(isset($_GET["id"]) ) {
      $gelenId = $_GET["id"];
     } else {
         $gelenId = "";
     }
     if($gelenId == "") {
       
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=5");
     }

?>
<div class="siteayarlari">
   <div class="panel__header">
      BANKA HESAP AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=8&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
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

         $bankaSorgusu = $db->prepare("SELECT * FROM bankahesablarimiz  WHERE id = $gelenId");
         $bankaSorgusu->execute();
         $bankalarSayisi = $bankaSorgusu->rowCount();
         $bankalar = $bankaSorgusu->fetchAll(PDO::FETCH_ASSOC);
      
         if($metinlerSayisi > 0) {
            foreach($bankalar as $banka) {?>
                  <div class="siteayarlari__ayarlar">
                     <div>Banka Logosu:</div>
                        <div class="photo"><input name="banklogo" type="file"></div>
                        <div>Bankın Adı:</div>
                        <div><input name="bankname" value="<?=$banka["bankaAdı"]?>" type="text"></div>
                        <div>Bankın Şöbəsinin Adı:</div>
                        <div><input name="bankseccname" value="<?=$banka["ŞubeAdı"]?>" type="text"></div>
                        <div>Bankın Şöbe Kodu:</div>
                        <div><input name="bankseccode" value="<?=$banka["ŞubeKodu"]?>" type="text"></div>
                        <div>Bankanın Yerləşdiyi Şəhər:</div>
                        <div><input name="bankcity" value="<?=$banka["KonumŞehir"]?>" type="text"></div>
                        <div>Bankanın Yerləşdiyi Ölkə:</div>
                        <div><input name="bankcountry" value="<?=$banka["konumÜlke"]?>" type="text"></div>
                        <div>Hesabın Valyutası:</div>
                        <div><input name="bankcurrency" value="<?=$banka["paraBirimi"]?>" type="text"></div>
                        <div>Hesab Sahibi:</div>
                        <div><input name="bankuser" value="<?=$banka["hesabSahibi"]?>" type="text"></div>
                        <div>Hesab Nömrəsi:</div>
                        <div><input name="bankacccode" value="<?=$banka["hesabNumarası"]?>" type="text"></div>
                        <div>İBAN:</div>
                        <div><input name="bankiban" value="<?=$banka["ibanNumarası"]?>" type="text"></div>
                     </div>
            <?php
            }
         } else {
            echo "site banka sorgusu hatali";
            die();
         }
      ?>

      <button class="btn btn-success">Bank Hesab Bilgilərini Yenilə</button>
   </form>
</div>