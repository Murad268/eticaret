<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         MENÜ AYARLARI
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=33">yeni menü elave ele</a>
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
            foreach($menular as $menu) {?>
                       <div class="menu__item">
                        <div class="menu__item__header"> <?=strtoupper(substr($menu["urunTuru"], 0, 1)).substr($menu["urunTuru"], 1)?> Ayakkabilari</div>
                        <div class="menu__item__footer">
                           <div class="menu__item__footer__left">
                              <?=$menu["menuAdi"]?>  (<?=$menu["urunSayisi"]?>)
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