<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         PADO
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
               $bankaSorgusu = $db->prepare("SELECT COUNT(*) AS bankalar FROM bankahesablarimiz");
               $bankaSorgusu->execute();
               $bankalar = $bankaSorgusu->fetch(PDO::FETCH_ASSOC);
               $menyuSorgusu = $db->prepare("SELECT COUNT(*) AS menuler FROM menuler");
               $menyuSorgusu->execute();
               $menyu = $menyuSorgusu->fetch(PDO::FETCH_ASSOC);
               $urunlerSorgusu = $db->prepare("SELECT COUNT(*) AS urunler FROM goods");
               $urunlerSorgusu->execute();
               $urunler = $urunlerSorgusu->fetch(PDO::FETCH_ASSOC);
               $usersSorgusu = $db->prepare("SELECT COUNT(*) AS users FROM users");
               $usersSorgusu->execute();
               $users = $usersSorgusu->fetch(PDO::FETCH_ASSOC);
               $adminSorgusu = $db->prepare("SELECT COUNT(*) AS admins FROM admindadas");
               $adminSorgusu->execute();
               $admins = $adminSorgusu->fetch(PDO::FETCH_ASSOC);
               $kargoSorgusu = $db->prepare("SELECT COUNT(*) AS kargolar FROM kargo");
               $kargoSorgusu->execute();
               $kargolar = $kargoSorgusu->fetch(PDO::FETCH_ASSOC);
               $bannerSorgusu = $db->prepare("SELECT COUNT(*) AS bannerler FROM bannerler");
               $bannerSorgusu->execute();
               $banner = $bannerSorgusu->fetch(PDO::FETCH_ASSOC);
               $commentSorgusu = $db->prepare("SELECT COUNT(*) AS comment FROM yorumlar");
               $commentSorgusu->execute();
               $comment = $commentSorgusu->fetch(PDO::FETCH_ASSOC);  
               $destekSorgusu = $db->prepare("SELECT COUNT(*) AS faq FROM faq");
               $destekSorgusu->execute();
               $faq = $destekSorgusu->fetch(PDO::FETCH_ASSOC);
            ?>

       <div class="pano__wrapper">
            <div class="pano__wrapper__item">
               <a href="sifarishler">
                  <div class="pano__wrapper__item__title">Gözləyən Şifarişlər</div>
                  <div class="pano__wrapper__item__count"><?=$bekleyenSifarisler["bekleyenSifarisler"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="tamamlanansifarisler">
                  <div class="pano__wrapper__item__title">Tamamlanmış Şifarişlər</div>
                  <div class="pano__wrapper__item__count"><?=$tamamlananSifarisler["tamamlananSifarisler"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="sifarishler">
                  <div class="pano__wrapper__item__title">Bütün Şifarişlər</div>
                  <div class="pano__wrapper__item__count"><?=$tamamlananSifarisler["tamamlananSifarisler"]+$bekleyenSifarisler["bekleyenSifarisler"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="havalebildirimleri">
                  <div class="pano__wrapper__item__title">Hevale Bildirimleri</div>
                  <div class="pano__wrapper__item__count"><?=$hevaleler["hevalelerSayisi"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="bankhesablari">
                  <div class="pano__wrapper__item__title">Bank Hesabları</div>
                  <div class="pano__wrapper__item__count"><?=$bankalar["bankalar"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="menyular">
                  <div class="pano__wrapper__item__title">Menyu Sayısı</div>
                  <div class="pano__wrapper__item__count"><?=$menyu["menuler"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="mehsullar">
                  <div class="pano__wrapper__item__title">Məhsullar</div>
                  <div class="pano__wrapper__item__count"><?=$urunler["urunler"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="users">
                  <div class="pano__wrapper__item__title">Userlər</div>
                  <div class="pano__wrapper__item__count"><?=$users["users"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=35">
                  <div class="adminler">Adminlər</div>
                  <div class="pano__wrapper__item__count"><?=$admins["admins"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="kargolar">
                  <div class="pano__wrapper__item__title">Kargolar</div>
                  <div class="pano__wrapper__item__count"><?=$kargolar["kargolar"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="bannerler">
                  <div class="pano__wrapper__item__title">Bannerlər</div>
                  <div class="pano__wrapper__item__count"><?=$banner["bannerler"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="serhler">
                  <div class="pano__wrapper__item__title">Şərhlər</div>
                  <div class="pano__wrapper__item__count"><?=$comment["comment"]?></div>
               </a>
            </div>
            <div class="pano__wrapper__item">
               <a href="destek">
                  <div class="pano__wrapper__item__title">Dəstək Mətnləri</div>
                  <div class="pano__wrapper__item__count"><?=$faq["faq"]?></div>
               </a>
            </div>
       </div>
   
    

</div>