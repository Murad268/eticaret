<?php
   if(isset($_REQUEST["menuId"])) {
      $menuId = sayiliIcerikleriFiltrele(Guvenlik($_REQUEST["menuId"]));
      $menuKosulu = " AND menuId = '$menuId'";
      $sayfalamaKosulu = "&menuId=$menuId";
   } else {
      $menuId = "";
      $menuKosulu = "";
      $sayfalamaKosulu = "";
   }



   if(isset($_REQUEST["arama"])) {
      $gelenAramaIceriyi = guvenlik($_REQUEST["arama"]);
      $aramaKosulu = " AND urun_adi LIKE '%$gelenAramaIceriyi%'";
      $sayfalamaKosulu .= "&arama=$gelenAramaIceriyi";
   } else {
      $aramaKosulu = "";  
      $sayfalamaKosulu .= "";
   }



   $sayfalamaIcinButonSayisi = 2;
   $sayfaBasinaGosterilecek = 10;
   $toplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM goods WHERE durumu = 1 AND urunTuru = 'cocuk'  $menuKosulu $aramaKosulu ORDER BY id DESC");
   $toplamKayitSayisiSorgusu->execute();
   $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
   $sayfalamayBaslayacaqKayotSayisi = ($sayfalama*$sayfaBasinaGosterilecek) - $sayfaBasinaGosterilecek;
   $bulunanSafyaSayisi = ceil($toplamKayitSayisi/$sayfaBasinaGosterilecek);


   $menuCountFetch = $db->prepare("SELECT SUM(urunSayisi) AS menununToplamUrunu FROM menuler WHERE urunTuru = 'cocuk'");
   $menuCountFetch->execute();
   $menuCount = $menuCountFetch->fetch(PDO::FETCH_ASSOC);
 
?>
<div class="manWrapper">
   <div class="manWrapper__menu">
      <h5 class="manWrapper__menu_title">MENÜLER</h5>
      <div class="manWrapper__menu__items">
         <div class="manWrapper__menu__item"><a style="color: <?=$menuId==""?"orange":"black"?>" href="ushaq-ayakkabilari">Tüm Ürünler (<?=$menuCount["menununToplamUrunu"]?>)</a></div>
         <?php
            $manFetch = $db->prepare("SELECT * FROM menuler WHERE urunTuru = 'cocuk'");
            $manFetch->execute();
            $manFetchCount = $manFetch->rowCount();
            $manGoods = $manFetch->fetchAll(PDO::FETCH_ASSOC);
            if($manFetchCount > 0) {
               foreach($manGoods as $man) {
                  $toMenuFetch = $db->prepare("SELECT COUNT(*) AS urunSayi FROM goods WHERE menuId = ? AND durumu = 1");
                  $toMenuFetch->execute([$man["id"]]);
                  $toMenu = $toMenuFetch->fetch(PDO::FETCH_ASSOC);
                  $urunSayinizDeyis=$db->prepare("UPDATE menuler SET urunSayisi = ? WHERE id=?");
                  $urunSayinizDeyis->execute([$toMenu["urunSayi"], $man["id"]])?>
                    <div class="manWrapper__menu__item"><a style="color: <?=$menuId==$man["id"]?"orange":"black"?>" href="ushaq-ayakkabilari/<?=$man["id"]?>"><?=$man["menuAdi"]?>  (<?=$toMenu["urunSayi"]?>)</a></div>
              <?php
               }
        
            }
         ?>
      </div>
     
      <div class="manWrapperBanner">
         <h5 class="manWrapperReklamlar">Reklamlar</h5>
         <div class="manWrapperBanner__area">
            <?php
               $fetchBanner = $db->prepare("SELECT * FROM bannerler WHERE	bannerAlani = 'menuAlti' ORDER BY gosterimSayisi ASC LIMIT 1");
               $fetchBanner->execute();
               $banner = $fetchBanner->fetch(PDO::FETCH_ASSOC);
               ?>
               <img src="assets/images/Banner Örnekleri/<?=$banner["bannerResmi"]?>" alt="">
            <?php 
               $addBannerView = $db->prepare("UPDATE bannerler SET gosterimSayisi=gosterimSayisi+1 WHERE id = ? LIMIT 1");
               $addBannerView->execute([$banner["id"]]);
            ?>
         </div>
      </div>
   </div>
   <div class="manWrapper__items">
      <div class="manWrapper__items__search">
         <div class="row height d-flex justify-content-center align-items-center">
            <form action="ushaq-ayakkabilari" method="post" class="">
               <?php
                  if($menuId !== "") {?>
                        <input type="hidden" name="menuId" value="<?=$menuId?>">
                     <?php
                      }
               ?>
               <div class="input-group mb-3">
                  <input name="arama" type="text" class="form-control form-control-lg" placeholder="Search Here">
                  <button type="submit" class="input-group-text btn btn-success"><i class="bi bi-search me-2"></i> Ara</button>
               </div>
            </form>
         </div>
      </div>

      <div class="manWrapper__items__wrapper">
         <?php
            $goodsFetch = $db->prepare("SELECT * FROM goods WHERE durumu = 1 AND urunTuru = 'cocuk' $menuKosulu $aramaKosulu ORDER BY id DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
            $goodsFetch->execute();
            $goodsFetchCount = $goodsFetch->rowCount();
            $goods = $goodsFetch->fetchAll(PDO::FETCH_ASSOC);
            if($goodsFetchCount > 0) {
                  foreach($goods as $good) {
                     $UrunuFiyati = donusumleriGeriDondur($good["urun_fiyati"]);
                     $UrunParaBirimi = donusumleriGeriDondur($good["para_birimi"]);
                     switch($good["para_birimi"]) {
                        case "USD":
                           $fiyat = ($good["urun_fiyati"] * $dolarKuru) + (($good["urun_fiyati"] * $dolarKuru) * $good["KDVOrani"] / 100);
                           break;
                        case "EUR":
                           $fiyat = ($good["urun_fiyati"] * $euroKuru) + (($good["urun_fiyati"] * $euroKuru) * $good["KDVOrani"] / 100);
                           break;
                        default:
                           $fiyat = ($good["urun_fiyati"]) + ($good["urun_fiyati"] * $good["KDVOrani"] / 100);
                           break;
                     }
                     if($good["yorumSayisi"]>0) {
                        $puan = number_format(($good["toplamYorumPuani"]/$good["yorumSayisi"]), 2, ".", "");
                     } else {
                        $puan = 0;
                     }
                   
                     if($puan==0) {
                        $img = "assets/images/YildizCizgiliBos.png";
                     } elseif($puan > 0 and $puan <= 1) {
                        $img = "assets/images/YildizBirDolu.png";
                     } elseif($puan > 1 and $puan <= 2) {
                        $img = "assets/images/YildizIkiDolu.png";
                     } elseif($puan > 2 and $puan <= 3) {
                        $img = "assets/images/YildizUcDolu.png";
                     } elseif($puan > 3 and $puan <= 4) {
                        $img = "assets/images/YildizDortDolu.png";
                     } elseif($puan > 4 and $puan <= 5) {
                        $img = "assets/images/YildizBesDolu.png";
                     }
                     ?>
                     <div class="manWrapper__item">
                        <div class="manWrapper__item__img">
                          <a href="ushaq-ayakkabisi/<?=donusumleriGeriDondur($good["urun_adi"])?>/<?=donusumleriGeriDondur($good["id"])?>"><img src="assets/images/UrunResimleri/Cocuk/<?=donusumleriGeriDondur($good["urun_resmi_bir"])?>" alt=""></a>
                        </div>
                        <div class="manWrapper__item__desc">
                           <div style="color: orange; font-weight: bold" class="manWrapper__item__desc__title">Uşaq Ayakkabısı</div>
                           <div class="manWrapper__item__desc__name"><?=donusumleriGeriDondur($good["urun_adi"])?></div>
                           <div class="manWrapper__item__desc__name__star">
                              <img src="<?=$img?>" alt="">
                           </div>
                           <div class="manWrapper__item__desc__name__price"><?=fiyatBitimlerndir($fiyat)?> TL</div>
                        </div>
                     </div>
          <?php
          }
            } else {
               echo "<div class='manWrapper__item'>belə bir malımız yoxdur</div>";
            }
         ?>
         
      </div>
      <?php
         if($bulunanSafyaSayisi>1) {?>
            <div class="paginationWrapper">
               <nav aria-label="Page navigation example ">
                  <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="cocukayakkabisayfala/1/<?$sayfalamaKosulu?>">&laquo;</a></li>
                  
           
                  <?php
                     for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                        if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                           $curr = $i;
                        if($sayfalama == $i) {
                           echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                        } else {
                           echo "<li class=\"page-item\"><a class=\"page-link\" href=\"cocukayakkabisayfala/$curr$sayfalamaKosulu\">$curr</a></li>";
                        }
                     }
                  }
                  ?>
                     
                     <li class="page-item"><a class="page-link"  href="cocukayakkabisayfala/<?=$bulunanSafyaSayisi?><?$sayfalamaKosulu?>">&raquo;</a></li>
                  
                  </ul>
               </nav>
            </div>
         <?php
         }
      ?>
   </div>
</div>