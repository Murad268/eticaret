<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         BANNER AYARLARI
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=21">yeni banner əlavə elə</a>
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
      

      <div class="bannerler__wrapper__item">
         <div class="bannerler__wrapper__item__img__title">
            Şəkil
         </div>
         <div class="bannerler__wrapper__item__name__title">
            Adı
         </div>   
         <div class="bannerler__wrapper__item__place__title">Yeri</div>
         <div class="bannerler__wrapper__item__see__header">Görüntülənmə Sayısı</div>
         <div class="bannerler__wrapper__item__controlls__title">Kontrol</div>
      </div>
   
      
      <?php
         $banerleriSorgula = $db->prepare("SELECT * FROM bannerler ORDER BY gosterimSayisi");
         $banerleriSorgula->execute();
         $banerleriSorgulaCount = $banerleriSorgula->rowCount();
         $bannerler = $banerleriSorgula->fetchAll(PDO::FETCH_ASSOC);
         if($banerleriSorgulaCount>0) {
            foreach($bannerler as $banner) {?>
                     <div class="bannerler__wrapper__item">
                        <div class="bannerler__wrapper__item__img"><img src="../assets/images/Banner Örnekleri/<?=$banner["bannerResmi"]?>" alt=""></div>
                        <div class="bannerler__wrapper__item__name"><?=$banner["bannerAdi"]?></div>
                        <div class="bannerler__wrapper__item__place"><?=$banner["bannerAlani"]?></div>
                        <div class="bannerler__wrapper__item__see"><?=$banner["gosterimSayisi"]?> dəfə</div>
                        <div class="bannerler__wrapper__item__c">
                           <div class="banner__kontrol__subdiv">
                              <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=18&id=<?=$banner["id"]?>">
                                 <img src="../assets/images/Sil20x20.png" alt="">
                                 Sil
                              </a>
                              <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=19&id=<?=$banner["id"]?>"">
                                 <img src="../assets/images/Guncelleme20x20.png" alt="">
                                 Yenilə
                              </a>
                           </div>
                        </div>
                     </div>
            <?php
            }
         }
   ?> 
    </div>
</div>