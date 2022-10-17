<?php
   if(!isset($id)) {
      header("Location: user-enter");
      $_SESSION["message"] = "Əvvəlcə daxil olmalısınız";
   }
?>
<form action="index.php?sayfaKodu=61" method="post">
   <div class="cartWrapper">
      <div class="cartWrapper__details">
         <h5 class="cartWrapper__title">Alışveriş Sepeti</h5>
         <div class="cartWrapper__subtitle">Adres ve Kargo Seçimini Aşağıdan Belirtebilirsin.</div>
         <hr>
         <div class="cartWrapper__details__adress">
            <h5 class="cartWrapper__details__adress__title">Adres Seçimi</h5>
            <?php
               $fetchAdresses = $db->prepare("SELECT * from adresler WHERE userId = $id");
               $fetchAdresses->execute();
               $fetchAdressesCount = $fetchAdresses->rowCount();
               $adress = $fetchAdresses->fetchAll(PDO::FETCH_ASSOC);
               $sebetSorgusu = $db->prepare("SELECT SUM(urunAdedi) AS toplamUrunler FROM sepet WHERE uyeId  = $id");
               $sebetSorgusu->execute();
               $sebet = $sebetSorgusu->fetch(PDO::FETCH_ASSOC);
      
               if($fetchAdressesCount>0) {
         
               foreach($adress as $key => $adr) {?>
                  <div style="margin-top: 15px"><input value="<?=$adr["id"]?>" checked type="radio" name="adres" id="<?=$key?>"> <label style="cursor: pointer" for="<?=$key?>"><?=$adr["adSoyad"]?> - <?=$adr["adres"]?> <?=$adr["ilce"]?>/<?=$adr["sehir"]?> - <?=$adr["telefonNumarasi"]?></label></div>
                  <hr>
               <?php
                  }
               }
            ?>
            
         </div>
         <div class="cartKargoWrapper">
            <h5 class="cartWrapper__details__adress__title">Kargo Firması Seçimi</h5>
            <div class="cartKargoWrapper__items">
               <?php
                  $kargoSorgusu = $db->prepare("SELECT * FROM kargo");
                  $kargoSorgusu->execute();
                  $kargoSorgusuKayiti = $kargoSorgusu->rowCount();
                  $kargolar = $kargoSorgusu->fetchAll(PDO::FETCH_ASSOC);
                  if($kargoSorgusuKayiti>0) {
                     foreach($kargolar as $key => $kargo) {?>
                        <div  div class="cartKargoWrapper__item">
                              <img src="assets/images/<?=$kargo["logo"]?>" alt="">
                              <label for="kargo<?=$key?>"></label>
                              <input <?=$key==0?"checked":null?> type="radio" value="<?=$kargo["id"]?>" name="kargoId" id="kargo<?=$key?>" name="kargo" id="">
                        </div>
                     <?php
                     }
                  }
               ?>
            
            </div>
         </div>
      </div>
      <div class="cartWrapper__order">
         <h5 class="cartWrapper__order__title">Sipariş Özeti</h5>
         <div class="cartWrapper__order__subtitle">Toplam <strong style="color: red"><?=$sebet["toplamUrunler"]?></strong> Adet Ürün</div>
         <hr>
         <div>Ödenecek Tutar(KDV Dahil)</div>
         <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($_POST["fiyat"]+$_POST["kargo"])?>  TL</div>
         <div>Ürünler Toplam Tutarı(KDV Dahil)</div>
         <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($_POST["fiyat"])?> TL</div>
         <div>Kargo Tutarı(KDV Dahil)</div>
         <input type="hidden" name="odenecektutar" value="<?=$_POST["fiyat"]+$_POST["kargo"]?>">
         <input type="hidden" name="toplam" value="<?=$_POST["fiyat"]?>">
         <input type="hidden" name="kargo" value="<?=$_POST["kargo"]?>">
         <input type="hidden" name="say" value="<?=$sebet["toplamUrunler"]?>">
         <?php
            if($kargoBaraji<$_POST["kargo"]) {?>
               <div class="cartWrapper__order__price">0 TL</div>
            <?php
            } else {?>
               <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($_POST["kargo"])?> TL</div>
            <?php
            }
         ?>
         <button class="btn cartWrapper__order__btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>DEVAM ET</span></и>
      </div>
   </div>
</form>