<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   $sayfalamaIcinButonSayisi = 2;
   $sayfaBasinaGosterilecek = 10;
   $toplamKayitSayisiSorgusu = $db->prepare("SELECT DISTINCT sifarisNumarasi FROM siparisler WHERE uyeİd = ? ORDER BY sifarisNumarasi DESC");
   $toplamKayitSayisiSorgusu->execute([$id]);
   $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
   $sayfalamayBaslayacaqKayotSayisi = ($sayfalama*$sayfaBasinaGosterilecek) - $sayfaBasinaGosterilecek;
   $bulunanSafyaSayisi = ceil($toplamKayitSayisi/$sayfaBasinaGosterilecek);
?>
  <hr>
      <div class="user__navbar">
         <div class="user__navbar__link"><a href="user-bilgileri">Üyelik Bilgileri</a></div>
         <div class="user__navbar__link"><a href="adresler">Adresler</a></div>
         <div class="user__navbar__link"><a href="sevimliler">Favoriler</a></div>
         <div class="user__navbar__link"><a href="sherhler">Yorumlar</a></div>
         <div class="user__navbar__link"><a href="sifarishler">Siparişler</a></div>
      </div>
   <hr>
<div class="adresMainWrapper"> 
   <div class="havaleWrapper__form">
      
      <h4 class="havaleWrapper__form__title">Hesabım > Siparişler</h4>
      <div class="havaleWrapper__form__subtitle">Tüm siparişlerinizi aşağıdan göre biliirsiniz.</div>
      <?php
            $siparisNumralariSorgusu = $db->prepare("SELECT DISTINCT sifarisNumarasi FROM siparisler WHERE 	uyeİd = ? ORDER BY sifarisNumarasi DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
            $siparisNumralariSorgusu->execute([$id]);
            $siparisNumralariSayisi = $siparisNumralariSorgusu->rowCount();
            $siparisNumralariKayitlari = $siparisNumralariSorgusu->fetchAll(PDO::FETCH_ASSOC);
                 if(!$siparisNumralariSayisi>0) {
                  echo "Sisteme kayıtlı hiç bir şifarisiniz bulunmamaktadır";
                 }
      ?>
         <div class="ordersMainWrapper__header__add">
           
            <?php
            if($siparisNumralariSayisi>0) {?>
             <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Sipariş numarası
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Resim
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Yorum
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Adı
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Fiyatı
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Adet
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Toplam Fiyat
            </div>
            <div class="ordersMainWrapper__header__add__item ordersMainWrapper__header__add__item__head">
               Kargo Durumu/Takip
            </div>
            <?php
               foreach($siparisNumralariKayitlari as $siparisNumralariSatirlar) {
                  $siparisNo = DonusumleriGeriDondur($siparisNumralariSatirlar["sifarisNumarasi"]);
                  $siparisSorgusu = $db->prepare("SELECT * FROM siparisler WHERE uyeİd = ? AND sifarisNumarasi = ? ORDER BY id ASC");
                  $siparisSorgusu->execute([$id, $siparisNo]);
                  $siparisSorgusuKayitari = $siparisSorgusu->fetchAll(PDO::FETCH_ASSOC);
                  foreach($siparisSorgusuKayitari as $siparisSatirlar) {
                  
                     if($siparisSatirlar["urunTuru"] == "erkek") {
                        $klasor = "Erkek";
                     } elseif($siparisSatirlar["urunTuru"] == "kadin") {
                        $klasor = "Kadin";
                     } else {
                        $klasor = "Cocuk";
                     }

                     if($siparisSatirlar["kargoDurumu"] == 0) {
                        $kargoDurumuYazdir = "Beklemede";
                     } else {
                        $kargoDurumuYazdir = $siparisSatirlar["kargoGonderiKodu"];
                     }

               ?>  
                      <div class="ordersMainWrapper__header__add__item">
                       <?=$siparisSatirlar["sifarisNumarasi"]?>
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                        <img src="assets/images/UrunResimleri/<?=$klasor."/".$siparisSatirlar["urunResmiBir"]?>" alt="">
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                        <a href="yorumYap/<?=$siparisSatirlar["urunİd"]?>"><img src="assets/images/DokumanKirmiziKalemli20x20.png" alt=""></a>
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                        <?=$siparisSatirlar["urunAdi"]?>
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                     <?=fiyatBitimlerndir($siparisSatirlar["urunFiyati"])?> TL
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                        <?=$siparisSatirlar["toplamUrunAdedi"]?>
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                     <?=fiyatBitimlerndir($siparisSatirlar["toplamUrunFiyati"])?> TL
                     </div>
                     <div class="ordersMainWrapper__header__add__item">
                        <?=$kargoDurumuYazdir?>
                     </div>
                <?php
                  }?>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
                        <div>
                           <hr style="color: black">
                        </div>
              <?php
              
               }
              
       
         
            } 
         ?>

         
     
      </div>
      
   </div>
        <?php
         if($bulunanSafyaSayisi>0) {?>
            <div class="paginationWrapper">
                  <nav aria-label="Page navigation example ">
                     <ul class="pagination">
                     <li class="page-item"><a class="page-link" href="index.php?sayfaKodu=39&sayfalama=1">&laquo;</a></li>
                     <?php
                        for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                           if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                              $curr = $i;
                           if($sayfalama == $i) {
                              echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                           } else {
                              echo "<li class=\"page-item\"><a class=\"page-link\" href=\"index.php?sayfaKodu=39&sayfalama=$curr\">$curr</a></li>";
                           }
                        }
                     }
                     ?>
                        
                        <li class="page-item"><a class="page-link"  href="index.php?sayfaKodu=39&sayfalama=<?=$bulunanSafyaSayisi?>">&raquo;</a></li>
                     </ul>
                  </nav>
               </div>
        <?php }
        ?>
 
     
</div>