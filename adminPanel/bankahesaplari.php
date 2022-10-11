<div class="bankahesaplari">
   <?php
      $banklariSorgula = $db->prepare("SELECT * FROM bankahesablarımız");
      $banklariSorgula->execute();
      $banklariSorgulaCount = $banklariSorgula->rowCount();
      $bankalar = $banklariSorgula->fetchAll(PDO::FETCH_ASSOC);
      if($banklariSorgulaCount > 0) {
         foreach($bankalar as $banka) {?>
            <div class="bankahesaplari__item">
               <div class="bankahesaplari__item__left">
                  <div class="left__image">
                     <img src="../assets/images/<?=$banka["bankLogo"]?>" alt="">
                  </div>
                  <div class="bankahesaplari__item__left__controlls">
                     <a href=""><span><img src="../assets/images/Sil20x20.png" alt="">Sil</span></a>
                     <a href=""><span><img src="../assets/images/Guncelleme20x20.png" alt="">Güncelle</span></a>
                  </div>
               </div>
               <div class="bankahesaplari__item__right">
                  <div class="bankahesaplari__item__right__top">
                     <div class="bankahesaplari__item__right__top__left"><span>Banka Adı </span><span>:&nbsp;&nbsp;&nbsp;<?=$banka["bankaAdı"]?>"</span></div>
                     <div class="bankahesaplari__item__right__top__right"><span>Hesap Sahibi </span><span>:&nbsp;&nbsp;&nbsp;	<?=$banka["hesabSahibi"]?></span></div>
                  </div>
                  <div class="bankahesaplari__item__right__bottom">
                     <span>Şube ve Konum Bilgileri</span>
                     <span>:&nbsp;&nbsp;&nbsp;<?=$banka["ŞubeAdı"]?>(<?=$banka["ŞubeKodu"]?>) - <?=$banka["KonumŞehir"]?> / <?=$banka["konumÜlke"]?></span>
                  </div>
                  <div class="bankahesaplari__item__right__footer">
                     <span>Hesap Bilgileri </span>
                     <span>:&nbsp;&nbsp;&nbsp;<?=$banka["paraBirimi"]?> / <?=$banka["hesabNumarası"]?> / <?=$banka["ibanNumarası"]?></span>
                  </div>
               </div>
            </div>
         <?php
         }
      }
   ?>

</div>