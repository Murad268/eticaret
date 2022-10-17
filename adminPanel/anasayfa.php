<?php
   
   if(isset($_SESSION["admin"])) {?>
      <div class="container">
         <div class="panelWrapper">
            <div class="panelWrapper__menu">
               <div class="panelWrapper__menu__logo">
                  <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=0"><img src="../assets/images/<?=$logo?>" alt=""></a>
               </div>
               <?php
                  $bekleyenSifarisSorgusu = $db->prepare("SELECT COUNT(*) AS bekleyenSifarisler FROM siparisler WHERE onayDurumu = 0 AND kargoDurumu = 0");
                  $bekleyenSifarisSorgusu->execute();
                  $bekleyenSifarisler = $bekleyenSifarisSorgusu->fetch(PDO::FETCH_ASSOC);
                  $tamamlananSifarisSorgusu = $db->prepare("SELECT COUNT(*) AS tamamlananSifarisler FROM siparisler WHERE onayDurumu = 1 AND kargoDurumu = 1");
                  $tamamlananSifarisSorgusu->execute();
                  $tamamlananSifarisler = $tamamlananSifarisSorgusu->fetch(PDO::FETCH_ASSOC);
                  $hevaleSorgusu = $db->prepare("SELECT COUNT(*) AS hevalelerSayisi FROM havalebildirimleri");
                  $hevaleSorgusu->execute();
                  $hevaleler = $hevaleSorgusu->fetch(PDO::FETCH_ASSOC);
               ?>
               <ul class="menu__items">
                  <li><a href="sifarishler">SİPARİŞLER (<?=$bekleyenSifarisler["bekleyenSifarisler"]?>/<?=$tamamlananSifarisler["tamamlananSifarisler"]?>)</a></li>
                  <li><a href="havalebildirimleri">HEVALE BİLDİRİMLERİ (<?=$hevaleler["hevalelerSayisi"]?>)</a></li>
                  <li><a href="mehsullar">ÜRÜNLER</a></li>
                  <li><a href="users">ÜYELER</a></li>
                  <li><a href="serhler">YORUMLAR</a></li>
                  <li><a href="saytparametrleri">SİTE AYARLARI</a></li>
                  <li><a href="menyular">MENÜLER</a></li>
                  <li><a href="bankhesablari">BANKA HESAP AYARLARI</a></li>
                  <li><a href="sozlesmemetunleri">SÖZLEŞMELER VE METİNLER</a></li>
                  <li><a href="kargolar">KARGO AYARLARI</a></li>
                  <li><a href="bannerler">BANNER AYARLARI</a></li>
                  <li><a href="destek">DESTEK İÇERİKLERİ</a></li>
                  <li><a href="adminler">YÖNETİCİLİER</a></li>
                  <li><a href="chixish">ÇIKIŞ</a></li>
               </ul>
            </div>
            <div class="panelWrapper__content">
               <?php
                     if(($sayfaKoduIc == 0) or ($sayfaKoduIc == "") or (!$sayfaKoduIc)) {
                        include($inside[0]);
                     } else {
                        include($inside[$sayfaKoduIc]);
                     }
               ?>
            </div>
         </div>
      </div>
   <?php
   } else {
      header("Location: admingiris");
      exit();
   }
?>