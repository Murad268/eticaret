<div class="mainMenu">
   <div class="mainMenu__wrapper">
      <div class="mainMenu__banner">
         <?php
            $bannerSorgusu = $db->prepare("SELECT * FROM bannerler WHERE bannerAlani = 'anasayfa' ORDER BY gosterimSayisi ASC ");
            $bannerSorgusu->execute();
            $bannerSorgusuCount = $bannerSorgusu->rowCount();
            $banner = $bannerSorgusu->fetch(PDO::FETCH_ASSOC);
            
         ?>
         <img src="assets/images/Banner Örnekleri/<?=DonusumleriGeriDondur($banner["bannerResmi"])?>" alt="">
         <?php
            $goruntulemeArtir = $db->prepare("UPDATE bannerler SET gosterimSayisi=gosterimSayisi+1 WHERE id = ?");
            $goruntulemeArtir->execute([$banner["id"]]);
         ?>
      </div>
      <div class="mainMenu__title">Ən Son Məhsullar</div>
      <div class="mainMenu__goods__wrapper">
         <?php
            $goodsFetch = $db->prepare("SELECT * FROM goods WHERE durumu=1 ORDER BY id DESC LIMIT 5");
            $goodsFetch->execute();
            $goodsCount = $goodsFetch->rowCount();
            $goods = $goodsFetch->fetchAll(PDO::FETCH_ASSOC);
         
            if($goodsCount>0) {
               foreach($goods as $key => $mal) {
                  if($mal["urunTuru"] == "erkek") {
                     $link = "kishi-ayakkabisi";
                  } else if($mal["urunTuru"] = "kadin") {
                     $link = "qadin-ayakkabisi";
                  } else if($mal["urunTuru"] = "cocuk") {
                     $link = "ushaq-ayakkabisi";
                  }
            
                  switch($$goods[$key]["urunTuru"]) {
                     case "erkek":
                        $klasor = "Erkek";
                        $type  = "Erkek Ayakkabısı";
                        break;
                     case "kadin":
                        $klasor = "Kadin";
                        $type  = "Kadın Ayakkabısı";
                        break;
                     default:
                        $klasor = "Cocuk";
                        $type  = "Çocuk Ayakkabısı";
                        break;
                  }
                  if($mal["yorumSayisi"] == 0) {
                     $puanImg = "assets/images/YildizCizgiliBos.png";
                  } else {
                     if(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 1) {
                        $puanImg = "assets/images/YildizBirDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 2) {
                        $puanImg = "assets/images/YildizIkiDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 3) {
                        $puanImg = "assets/images/YildizUcDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) == 4) {
                        $puanImg = "assets/images/YildizDortDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) == 5) {
                        $puanImg = "assets/images/YildizBesDolu.png";
                     }
                  }
                  switch($mal["para_birimi"]) {
                     case "USD":
                        $fiyat = ($mal["urun_fiyati"] * $dolarKuru) + (($mal["urun_fiyati"] * $dolarKuru) * $mal["KDVOrani"] / 100);
                        break;
                     case "EUR":
                        $fiyat = ($mal["urun_fiyati"] * $euroKuru) + (($mal["urun_fiyati"] * $euroKuru) * $mal["KDVOrani"] / 100);
                        break;
                     default:
                        $fiyat = ($mal["urun_fiyati"]) + ($mal["urun_fiyati"] * $mal["KDVOrani"] / 100);
                        break;
                  }
            
                  ?>

                  <div class="mainMenu__goods__wrapper__item">
                     <div class="mainMenu__goods__wrapper__item__img">
                        <a href="<?=$link?>/<?=donusumleriGeriDondur($mal["urun_adi"])?>/<?=donusumleriGeriDondur($mal["id"])?>"><img style="height: 250px;" src="assets/images/UrunResimleri/<?=$klasor?>/<?=DonusumleriGeriDondur($mal["urun_resmi_bir"])?>" alt=""></a>
                     </div>
                     <div style="color: orange; font-weight: 900; font-size: 16px" class="mainMenu__goods__wrapper__item__type"><?=$type?></div>
                     <div class="mainMenu__goods__wrapper__item__name"><?=DonusumleriGeriDondur($mal["urun_adi"])?></div>
                     <div class="mainMenu__goods__wrapper__item__stars">
                        <img src="<?=$puanImg?>" alt="">
                     </div>
                     <div class="mainMenu__goods__wrapper__item__price"><?=DonusumleriGeriDondur($fiyat)?> TL</div>
                  </div>
               <?php
               }
            }
         ?>
     
      </div>
      <div class="mainMenu__title">Ən Populyar Məhsullar</div>
      <div class="mainMenu__goods__wrapper">
         <?php
            $goodsFetch = $db->prepare("SELECT * FROM goods WHERE durumu=1 ORDER BY goruntulenmeSayisi DESC LIMIT 5");
            $goodsFetch->execute();
            $goodsCount = $goodsFetch->rowCount();
            $goods = $goodsFetch->fetchAll(PDO::FETCH_ASSOC);
         
            if($goodsCount>0) {
               foreach($goods as $key => $mal) {
               
                  if($mal["urunTuru"] == "erkek") {
                     $link = "kishi-ayakkabisi";
                  } else if($mal["urunTuru"] = "kadin") {
                     $link = "qadin-ayakkabisi";
                  } else if($mal["urunTuru"] = "cocuk") {
                     $link = "ushaq-ayakkabisi";
                  }
                  switch($goods[$key]["urunTuru"]) {
                     
                     case "erkek":
                        $klasor = "Erkek";
                        $type  = "Erkek Ayakkabısı";
                        break;
                     case "kadin":
                        $klasor = "Kadin";
                        $type  = "Kadın Ayakkabısı";
                        break;
                     default:
                        $klasor = "Cocuk";
                        $type  = "Çocuk Ayakkabısı";
                        break;
                  }
                  if($mal["yorumSayisi"] == 0) {
                     $puanImg = "assets/images/YildizCizgiliBos.png";
                  } else {
                     if(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 1) {
                        $puanImg = "assets/images/YildizBirDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 2) {
                        $puanImg = "assets/images/YildizIkiDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 3) {
                        $puanImg = "assets/images/YildizUcDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) == 4) {
                        $puanImg = "assets/images/YildizDortDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) == 5) {
                        $puanImg = "assets/images/YildizBesDolu.png";
                     }
                  }
                  switch($mal["para_birimi"]) {
                     case "USD":
                        $fiyat = ($mal["urun_fiyati"] * $dolarKuru) + (($mal["urun_fiyati"] * $dolarKuru) * $mal["KDVOrani"] / 100);
                        break;
                     case "EUR":
                        $fiyat = ($mal["urun_fiyati"] * $euroKuru) + (($mal["urun_fiyati"] * $euroKuru) * $mal["KDVOrani"] / 100);
                        break;
                     default:
                        $fiyat = ($mal["urun_fiyati"]) + ($mal["urun_fiyati"] * $mal["KDVOrani"] / 100);
                        break;
                  }
                  
                  ?>

                  <div class="mainMenu__goods__wrapper__item">
                     <div class="mainMenu__goods__wrapper__item__img">
                        <a href="<?=$link?>/<?=donusumleriGeriDondur($mal["urun_adi"])?>/<?=donusumleriGeriDondur($mal["id"])?>"><img style="height: 250px;" src="assets/images/UrunResimleri/<?=$klasor?>/<?=$mal["urun_resmi_bir"]?>" alt=""></a>
                     </div>
                     <div style="color: orange; font-weight: 900; font-size: 16px" class="mainMenu__goods__wrapper__item__type"><?=DonusumleriGeriDondur($type)?></div>
                     <div class="mainMenu__goods__wrapper__item__name"><?=DonusumleriGeriDondur($mal["urun_adi"])?></div>
                     <div class="mainMenu__goods__wrapper__item__stars">
                        <img src="<?=$puanImg?>" alt="">
                     </div>
                     <div class="mainMenu__goods__wrapper__item__price"><?=DonusumleriGeriDondur($fiyat)?> TL</div>
                  </div>
               <?php
               }
            }
         ?>
     
      </div>

      <div class="mainMenu__title">Ən çox satılan məhsullar</div>
      <div class="mainMenu__goods__wrapper">
         <?php
            $goodsFetch = $db->prepare("SELECT * FROM goods WHERE durumu=1 ORDER BY toplamSatisSyisi DESC LIMIT 5");
            $goodsFetch->execute();
            $goodsCount = $goodsFetch->rowCount();
            $goods = $goodsFetch->fetchAll(PDO::FETCH_ASSOC);
          
            if($goodsCount>0) {
               foreach($goods as $key => $mal) {
                  if($goods[$key]["urunTuru"] == "erkek") {
                     $link = "kishi-ayakkabisi";
                  } else if($mal["urunTuru"] = "kadin") {
                     $link = "qadin-ayakkabisi";
                  } else if($mal["urunTuru"] = "cocuk") {
                     $link = "ushaq-ayakkabisi";
                  }
                  switch($mal["urunTuru"]) {
                     case "erkek":
                        $klasor = "Erkek";
                        $type  = "Erkek Ayakkabısı";
                        break;
                     case "kadin":
                        $klasor = "Kadin";
                        $type  = "Kadın Ayakkabısı";
                        break;
                     default:
                        $klasor = "Cocuk";
                        $type  = "Çocuk Ayakkabısı";
                        break;
                  }
                  if($mal["yorumSayisi"] == 0) {
                     $puanImg = "assets/images/YildizCizgiliBos.png";
                  } else {
                     if(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 1) {
                        $puanImg = "assets/images/YildizBirDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 2) {
                        $puanImg = "assets/images/YildizIkiDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) <= 3) {
                        $puanImg = "assets/images/YildizUcDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) == 4) {
                        $puanImg = "assets/images/YildizDortDolu.png";
                     } elseif(($mal["toplamYorumPuani"] / $mal["yorumSayisi"]) == 5) {
                        $puanImg = "assets/images/YildizBesDolu.png";
                     }
                  }
                  switch($mal["para_birimi"]) {
                     case "USD":
                        $fiyat = ($mal["urun_fiyati"] * $dolarKuru) + (($mal["urun_fiyati"] * $dolarKuru) * $mal["KDVOrani"] / 100);
                        break;
                     case "EUR":
                        $fiyat = ($mal["urun_fiyati"] * $euroKuru) + (($mal["urun_fiyati"] * $euroKuru) * $mal["KDVOrani"] / 100);
                        break;
                     default:
                        $fiyat = ($mal["urun_fiyati"]) + ($mal["urun_fiyati"] * $mal["KDVOrani"] / 100);
                        break;
                  }
                  
                  ?>

                  <div class="mainMenu__goods__wrapper__item">
                     <div class="mainMenu__goods__wrapper__item__img">
                        <a href="<?=$link?>/<?=donusumleriGeriDondur($mal["urun_adi"])?>/<?=donusumleriGeriDondur($mal["id"])?> "><img style="height: 250px;" src="assets/images/UrunResimleri/<?=$klasor?>/<?=DonusumleriGeriDondur($mal["urun_resmi_bir"])?>" alt=""></a>
                     </div>
                     <div style="color: orange; font-weight: 900; font-size: 16px" class="mainMenu__goods__wrapper__item__type"><?=$type?></div>
                     <div class="mainMenu__goods__wrapper__item__name"><?=DonusumleriGeriDondur($mal["urun_adi"])?></div>
                     <div class="mainMenu__goods__wrapper__item__stars">
                        <img src="<?=$puanImg?>" alt="">
                     </div>
                     <div class="mainMenu__goods__wrapper__item__price"><?=DonusumleriGeriDondur($fiyat)?> TL</div>
                  </div>
               <?php
               }
            }
         ?>
     
      </div>
   </div>
   <div class="mainMenu__footer">
      <div class="mainMenu__footer__item">
         <img src="assets/images/HizliTeslimat.png" alt="">
         <div class="mainMenu__footer__item__title">Bugün Teslimat</div>
         <div class="mainMenu__footer__item__desc">
            Saat 14:00!a kadar verdiğiniz siparişler aynı gün kapınızda.
         </div>
      </div>

      <div class="mainMenu__footer__item">
         <img src="assets/images/GuvenliAlisveris.png" alt="">
         <div class="mainMenu__footer__item__title">Tek Tıkla Güvenli Alışveriş</div>
         <div class="mainMenu__footer__item__desc">
            Ödeme ve adres bilgilerinizi kaydedin, güvenli alışveriş yapın.
         </div>
      </div>

      <div class="mainMenu__footer__item">
         <img src="assets/images/MobilErisim.png" alt="">
         <div class="mainMenu__footer__item__title">Mobil Erişim</div>
         <div class="mainMenu__footer__item__desc">
            Dilediğiniz her cihazdan sitemize erişebilir ve alışveriş yapabilirsiniz.
         </div>
      </div>

      
      <div class="mainMenu__footer__item">
         <img src="assets/images/MobilErisim.png" alt="">
         <div class="mainMenu__footer__item__title">Kolay İade</div>
         <div class="mainMenu__footer__item__desc">
            Aldığınız herhangi bir ürünü 14 gün içerisinde kolaylıkla iade edebilirsiniz.
         </div>
      </div>
   </div>
</div>
