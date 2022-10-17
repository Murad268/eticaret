<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         Menyu Parametrləri
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=33">yeni menyu əlavə ele</a>
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
         $menulariSorgula = $db->prepare("SELECT * FROM menuler ORDER BY urunTuru");
         $menulariSorgula->execute();
         $menulariSorgulaCount = $menulariSorgula->rowCount();
         $menular = $menulariSorgula->fetchAll(PDO::FETCH_ASSOC);
         if($menulariSorgulaCount>0) {
            foreach($menular as $menu) {
               $toMenuFetch = $db->prepare("SELECT COUNT(*) AS urunSayi FROM goods WHERE menuId = ? AND durumu = 1");
               $toMenuFetch->execute([$menu["id"]]);
               $toMenu = $toMenuFetch->fetch(PDO::FETCH_ASSOC);
               $urunSayinizDeyis=$db->prepare("UPDATE menuler SET urunSayisi = ? WHERE id=?");
               $urunSayinizDeyis->execute([$toMenu["urunSayi"], $menu["id"]])?>
                       <div class="menu__item">
                        <div class="menu__item__header"> <?=strtoupper(substr($menu["urunTuru"], 0, 1)).substr($menu["urunTuru"], 1)?> Ayakkabilari</div>
                        <div class="menu__item__footer">
                           <div class="menu__item__footer__left">
                              <?=$menu["menuAdi"]?>  (<?=$toMenu["urunSayi"]?>)
                           </div>
                           <div class="menu__item__footer__right">
                              <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=30&id=<?=$menu["id"]?>"><span><img src="../assets/images/Sil20x20.png" alt="">Sil</span></a>
                              <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=31&id=<?=$menu["id"]?>"><span><img src="../assets/images/Guncelleme20x20.png" alt="">Yenilə</span></a>
                           </div>
                        </div>
                     </div>
            <?php
            }
         }
      ?> 
    
    </div>
</div>