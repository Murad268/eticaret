<?php
   if(isset($_POST["odenecektutar"])) {
      $odenecektutar = $_POST["odenecektutar"];
   } else {
      header("Location: index.php");
   }
   if(isset($_POST["toplam"])) {
      $toplam = $_POST["toplam"];
   } else {
      header("Location: index.php");
   }
   if(isset($_POST["kargo"])) {
      $kargo = $_POST["kargo"];
   } else {
      header("Location: index.php");
   }
   if(isset($_POST["say"])) {
      $say = $_POST["say"];
   } else {
      header("Location: index.php");
   }
   if(isset($_POST["adres"]) && isset($_POST["kargoId"])) {
      $adres = $_POST["adres"];
      $kargoId = $_POST["kargoId"];
   
      $fetch = $db->prepare("UPDATE sepet SET kargoId = ?, adresId = ? WHERE uyeId = $id");
      $fetch->execute([$kargoId, $adres]);
    
   } else {
      header("Location: index.php");
   }
?>
<form action="index.php?sayfaKodu=62" method="post">
   <div class="cartWrapper">
      <div class="cartWrapper__details">
         <h5 class="cartWrapper__title">Alışveriş Sepeti</h5>
         <div class="cartWrapper__subtitle">Ödeme Türü Seçimini Aşağıdan Belirtebilirsin.</div>
         <hr>
   
         <div class="cartKargoWrapper">
            <h5 class="cartWrapper__details__adress__title">Ödeme Türü Seçimi</h5>
            <div class="turWrapper">
               <div class="kart">
                  <img src="assets/images/KrediKarti92x75.png" alt="">
                  <label for="var1"></label>
                  <input value="kredi kartı" checked type="radio" name="var" id="var1">
               </div>
               <div class="bank">
                  <img src="assets/images/Banka80x75.png" alt="">
                  <label for="var2"></label>
                  <input value="bankahevalesi" type="radio" name="var" id="var2">
               </div>
            </div>
            <div class="kart__content content">
               <h5 class="cartWrapper__details__adress__title">Kredi Kartı ile Ödeme</h5> 
               Ödeme işleminizde aşağıdakı tüm kredi kartı markaları ile veya diğer markalar ile veya ATM(Bankamatik) kartı ile işlem yapabilirsiniz.
               <div class="kart__content__wrapper">
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/AxessCard46x12.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/BonusCard41x12.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/CardFinans78x12.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/MaximumCard46x12.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/WorldCard48x12.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/ParafCard19x12.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/OdemeSecimiDigerKartlar.png" alt="">
                  </div>
                  <div class="kart__content__wrapper__item">
                     <img src="assets/images/OdemeSecimiATMKarti.png" alt="">
                  </div>
               </div>
               <h5 class="cartWrapper__details__adress__title">Taksit Seçimi</h5>
               Lütfen ödeme işleminde uygulanmasını istediğiniz taksit sayısını seçiniz.
               <div class="kart__content__wrapper__taksitler">
                  <div class="kart__content__wrapper__taksit">
                     <input checked value="0" type="radio" name="taksit" id="tak1"> <label for="tak1">Tek Çekim</label> <div class="taksitOdeme">1 x <?=fiyatBitimlerndir($toplam)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="2" type="radio" name="taksit" id="tak2"> <label for="tak2">2 Taksit</label> <div class="taksitOdeme">2 x <?=fiyatBitimlerndir($toplam/2)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="3" type="radio" name="taksit" id="tak3"> <label for="tak3">3 Taksit</label> <div class="taksitOdeme">3 x <?=fiyatBitimlerndir($toplam/3)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="4" type="radio" name="taksit" id="tak4"> <label for="tak4">4 Taksit</label> <div class="taksitOdeme">4 x <?=fiyatBitimlerndir($toplam/4)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="5" type="radio" name="taksit" id="tak5"> <label for="tak5">5 Taksit</label> <div class="taksitOdeme">5 x <?=fiyatBitimlerndir($toplam/5)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="6" type="radio" name="taksit" id="tak6"> <label for="tak6">6 Taksit</label> <div class="taksitOdeme">6 x <?=fiyatBitimlerndir($toplam/6)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="7"  type="radio" name="taksit" id="tak7"> <label for="tak7">7 Taksit</label> <div class="taksitOdeme">7 x <?=fiyatBitimlerndir($toplam/7)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="8"  type="radio" name="taksit" id="tak8"> <label for="tak8">8 Taksit</label> <div class="taksitOdeme">8 x <?=fiyatBitimlerndir($toplam/8)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
                  <div class="kart__content__wrapper__taksit">
                     <input value="9" type="radio" name="taksit" id="tak9"> <label for="tak9">9 Taksit</label> <div class="taksitOdeme">9 x <?=fiyatBitimlerndir($toplam/9)?> TL</div><div class="tamOdeme"><?=$toplam?> TL</div>
                  </div>
               </div>
            </div>
         
            <div class="bank__content content">
               <h5 class="cartWrapper__details__adress__title">Ödeme Türü Seçimi</h5>
               Banka hevalesi / ETF ile ürün satın alabilmek için, öncelikle alışveriş sepeti tutarını "Banka Hesaplarımız" sayfasında bulunan hehangi bir hesapa ödeme yaptıktan sonra "Hevale Bildirim Formu" aracılığı ile lütfen tarafımıza bilgi veriniz. "Ödeme Yap" butonuna tıkladığınız anda sipariş sisteme kayıt edilecektir.
            </div>
         </div>
      </div>
      <div class="cartWrapper__order">
         <h5 class="cartWrapper__order__title">Sipariş Özeti</h5>
         <div class="cartWrapper__order__subtitle">Toplam <strong style="color: red"><?=$say?></strong> Adet Ürün</div>
         <hr>
         <div>Ödenecek Tutar(KDV Dahil)</div>
         <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($odenecektutar)?>  TL</div>
         <div>Ürünler Toplam Tutarı(KDV Dahil)</div>
         <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($toplam)?> TL</div>
         <div>Kargo Tutarı(KDV Dahil)</div>
         
         <?php
            if($kargo>$kargoBaraji) {?>
               <div class="cartWrapper__order__price">0 TL</div>
            <?php
            } else {?>
               <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($kargo)?> TL</div>
            <?php
            }
         ?>
      
         <button class="btn cartWrapper__order__btn"><span>ÖDEME YAP</a>
      </div>
   </div>
</form>