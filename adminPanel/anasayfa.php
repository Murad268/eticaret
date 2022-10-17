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
                  <li><a href="sifarishler">Sifarişlər (<?=$bekleyenSifarisler["bekleyenSifarisler"]?>/<?=$tamamlananSifarisler["tamamlananSifarisler"]?>)</a></li>
                  <li><a href="havalebildirimleri">HEVALE BİLDİRİMLƏRİ (<?=$hevaleler["hevalelerSayisi"]?>)</a></li>
                  <li><a href="mehsullar">MƏHSULLAR</a></li>
                  <li><a href="users">USERLƏR</a></li>
                  <li><a href="serhler">ŞƏRHLƏR</a></li>
                  <li><a href="saytparametrleri">SAYT PARAMETRLƏRİ  </a></li>
                  <li><a href="menyular">MENYULAR</a></li>
                  <li><a href="bankhesablari">BANK HESAP PARAMETRLƏRİ</a></li>
                  <li><a href="sozlesmemetunleri">SÖZLƏŞMƏLƏR VƏ MƏTNLƏT</a></li>
                  <li><a href="kargolar">KARGO PARAMETRLƏRİ</a></li>
                  <li><a href="bannerler">BANNER PARAMETRLƏRİ</a></li>
                  <li><a href="destek">DƏSTƏK İÇERİKLƏRİ</a></li>
                  <li><a href="adminler">ADMİNLƏR</a></li>
                  <li><a href="chixish">ÇIXIŞ</a></li>
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