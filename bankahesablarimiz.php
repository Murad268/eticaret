

<div class="banks__wrapper">
   <?php
      $fetchBanks = $db->prepare("SELECT * FROM bankahesablarimiz");
      $fetchBanks->execute();
      $banksCount = $fetchBanks->rowCount();
      $bankalar = $fetchBanks->fetchAll(PDO::FETCH_ASSOC);
      if($banksCount > 0) {
         foreach($bankalar as $bank) {?>
            <div class="bank__item">
               <div class="bank__item__logo"> 
                  <img src="assets/images/<?=$bank["bankLogo"]?>" alt="">
               </div>
                  <div class="bank__item__body">
                     <div class="body__title">Banka adı </div>
                     <div class="body__desc"><span>:</span> <?=$bank["bankaAdı"]?></div>
                     <div class="body__space"></div>
                     <div class="body__space"></div>
                     <div class="body__title">Konum </div>
                     <div class="body__desc"><span>:</span> <?=$bank["KonumŞehir"]?> / <?=$bank["konumÜlke"]?></div>
                     <div class="body__space"></div>
                     <div class="body__space"></div>
                     <div class="body__title">Şube </div>
                     <div class="body__desc"><span>:</span> <?=$bank["ŞubeAdı"]?> / <?=$bank["ŞubeKodu"]?></div>
                     <div class="body__space"></div>
                     <div class="body__space"></div>
                     <div class="body__title">Birim </div>
                     <div class="body__desc"><span>:</span> <?=$bank["paraBirimi"]?></div>
                     <div class="body__space"></div>
                     <div class="body__space"></div>
                     <div class="body__title">Hesap Adı </div>
                     <div class="body__desc"><span>:</span> <?=$bank["hesabSahibi"]?></div>
                     <div class="body__space"></div>
                     <div class="body__space"></div>
                     <div class="body__title">Hesap No </div>
                     <div class="body__desc"><span>:</span> <?=$bank["hesabNumarası"]?></div>
                     <div class="body__space"></div>
                     <div class="body__space"></div>
                     <div class="body__title">IBAN No </div>
                     <div class="body__desc"><span>:</span> <?=iban($bank["ibanNumarası"])?></div>
                  </div>
               
            </div>
      <?php }
      }
   ?>


  

   

 
   
</div>
