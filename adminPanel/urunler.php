<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         Məhsul Parametrləri
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=49">yeni məhsul əlavə elə</a>
      </div>
      <?php
          if(isset($_SESSION["bankDel"])) {
            $mess = $_SESSION["bankDel"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
          }  
      ?>
    <div class="kargolar__wrapper">
      <?php
         $urunlerinSorgusu = $db->prepare("SELECT * FROM goods WHERE durumu = 1");
         $urunlerinSorgusu->execute();
         $urunSayi = $urunlerinSorgusu->rowCount();
         $urunler = $urunlerinSorgusu->fetchAll(PDO::FETCH_ASSOC);
         if($urunSayi > 0) {
            foreach($urunler as $urun) {
               $menulerinSorgusu = $db->prepare("SELECT * FROM menuler WHERE id = ?");
               $menulerinSorgusu->execute([$urun["menuId"]]);
               $menuler = $menulerinSorgusu->fetch(PDO::FETCH_ASSOC);
               if($urun) {
                  switch($urun["urunTuru"]) {
                     case "erkek":
                        $klasor = "Erkek";
                        break;
                     case "kadin":
                        $klasor = "Kadin";
                        break;
                     default:
                        $klasor = "Cocuk";
                        break;
                  }
               } ?>
               <div class="urun">
                  <div class="urun__img">
                     <img src="../assets/images/UrunResimleri/<?=$klasor?>/<?=$urun["urun_resmi_bir"]?>" alt="">
                  </div>
                  <div class="urun__desc">
                     <div><?=strtoupper(substr($urun["urunTuru"], 0, 1)).substr($urun["urunTuru"], 1)?> Ayakkabisi-><?=$menuler["menuAdi"]?></div>
                     <div><?=$urun["urun_adi"]?></div>
                     <div><?=$urun["toplamSatisSyisi"]?> ədəd satıldı. <?=$urun["yorumSayisi"]?> adet şərhdə <?=$urun["toplamYorumPuani"]?> puan aldı. <?=$urun["goruntulenmeSayisi"]?> dəfə baxılıb.</div>
                  </div>
                  <div class="urun__controlls">
                     <div><?=$urun["urun_fiyati"]?> <?=$urun["para_birimi"]?></div>
                     <div class="urun__controlls__btns">
                        <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=48&id=<?=$urun["id"]?>"><span><img src="../assets/images/Sil20x20.png" alt="">Sil</span></a>
                        <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=51&id=<?=$urun["id"]?>"><span><img src="../assets/images/Guncelleme20x20.png" alt="">Yenilə</span></a>
                     </div>
                  </div>
               </div>
            <?php
            }
         }
      ?>
      
    
    </div>
</div>