<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php?sayfaKodu=25");
   }
?>
<div class="cartWrapper">
   <div class="cartWrapper__details">
      <h5 class="cartWrapper__title">Alışveriş Sepeti</h5>
      <div class="cartWrapper__subtitle">Alışveriş Sepetine Eklemiş Olduğunuz Ürünler Aşağıdadır</div>
      <hr>
   
      <div class="cartWrapper__details__items">
         <?php
            $fetchCart = $db->prepare("SELECT * FROM sepet WHERE uyeId = $id");
            $fetchCart->execute();
            $fetchCartCount = $fetchCart->rowCount();
            $CartItems = $fetchCart->fetchAll(PDO::FETCH_ASSOC);
            $toplamUrunAdedi = 0;
            $toplamKDVLiFiyat = 0;
            $toplamKargoUcreti = 0;
            $i=0;
            if($fetchCartCount>0) {
           
               foreach($CartItems as $CartItem) {
                  $i++;
                  $toplamUrunAdedi+=$CartItem["urunAdedi"];
                  
                  $fetchGoods = $db->prepare("SELECT * FROM goods WHERE id = ? LIMIT 1");
                  $fetchGoods->execute([$CartItem["urunId"]]);
                  $goods = $fetchGoods->fetch(PDO::FETCH_ASSOC);
            
                  $variantGoods = $db->prepare("SELECT * FROM urunvariantlari WHERE id = ? LIMIT 1");
                  $variantGoods->execute([$CartItem["variantId"]]);
                  $variants = $variantGoods->fetch(PDO::FETCH_ASSOC);
                  if($goods["para_birimi"] == "USD") {
                     $urunFiyatiHesabla = ($goods["urun_fiyati"] * $dolarKuru) * $CartItem["urunAdedi"];
                  }elseif($goods["para_birimi"] == "EUR"){
                     $urunFiyatiHesabla = ($goods["urun_fiyati"] * $euroKuru) * $CartItem["urunAdedi"];
                  }else {
                     $urunFiyatiHesabla = $goods["urun_fiyati"] * $CartItem["urunAdedi"];
                  }

                  $kdvliFiyat = $urunFiyatiHesabla+($urunFiyatiHesabla/100*$goods["KDVOrani"]);
                  $toplamKargoUcreti += ($goods["kargoUcreti"]*$CartItem["urunAdedi"]);
                  $toplamKDVLiFiyat+=$kdvliFiyat;
                  if($goods["urunTuru"] == "erkek") {
                     $klasor = "Erkek";
                  } elseif($goods["urunTuru"] == "kadin") {
                     $klasor = "Kadin";
                  } else {
                     $klasor = "Cocuk";
                  }
                  ?>
               <div class="cartWrapper__details__item">
                  <div class="cartWrapper__details__item__sector">
                     <img src="assets/images/UrunResimleri/<?=$klasor?>/<?=$goods["urun_resmi_bir"]?>" alt="">
                  </div>
                  <div class="cartWrapper__details__item__sector">
                     <a href="index.php?sayfaKodu=57&id=<?=$CartItem["id"]?>"><img src="assets/images/SilDaireli20x20.png" alt=""></a>
                  </div>
                  <div class="cartWrapper__details__item__sector">
                     <div class="cartWrapper__details__item__sector1"><?=DonusumleriGeriDondur($goods["urun_adi"])?></div>
                     <div class="cartWrapper__details__item__sector2"><?=$goods["variantBasligi"]?>: <?=$variants["variantAdi"]?></div>
                  </div>
                  <div class="cartWrapper__details__item__sector">
                     <form class="cartWrapper__details__item__sector__form" action="">
                        <?php
                           if(!$CartItem["urunAdedi"]<1) {?>
                              <a href="index.php?sayfaKodu=58&islem=azalt&id=<?=$CartItem["id"]?>"><img src="assets/images/AzaltDaireli20x20.png" alt=""></a>
                           <?php
                           }
                        ?>
                        <input disabled type="text" name="count" value="<?=$CartItem["urunAdedi"]?>">
                        <?php
                      
                           if($CartItem["urunAdedi"]<$variants["stokAdedi"]) {?>
                              <a href="index.php?sayfaKodu=58&islem=artdir&id=<?=$CartItem["id"]?>"><img class="artdir" src="assets/images/ArttirDaireli20x20.png" alt=""></a>
                           <?php
                           }
                        ?>
                        
                     </form>
                  </div>
                  <div class="cartWrapper__details__item__sector">
                     <div class="cartWrapper__details__item__sector3"><?=$kdvliFiyat?> TL</div>
                     <div class="cartWrapper__details__item__secto4"><?=$urunFiyatiHesabla?> TL</div>
                  </div>
                  </div>
              <?php
               }
            } else {
               echo "Hazırda səbətinizdə mal yoxdur";
            }
         ?>
  
      </div>
   </div>
   <div class="cartWrapper__order">
     <form action="index.php?sayfaKodu=59" method="post">
     <h5 class="cartWrapper__order__title">Sipariş Özeti</h5>
         <div class="cartWrapper__order__subtitle">Toplam <strong style="color: red; font-size: 16px"><?=$toplamUrunAdedi?></strong> Adet Ürün</div>
         <input type="hidden" name="fiyat" value="<?=$toplamKDVLiFiyat?>">
         <input type="hidden" name="kargo" value="<?=$toplamKargoUcreti?>">
         <hr>
         <div>Ödenecek Tutar(KDV Dahil)</div>
         <div class="cartWrapper__order__price"><?=fiyatBitimlerndir($toplamKDVLiFiyat)?> TL</div>
         <button class="btn cartWrapper__order__btn"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>DEVAM ET</span></button>
     </form>
   </div>
</div>