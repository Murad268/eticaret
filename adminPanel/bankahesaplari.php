<div class="bankahesaplari">
   <?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }
   ?>
   <div class="panel__header">
      BANKA HESAP AYARLARI
   </div>
   <div class="addBank">
      <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=9">yeni bank elave ele</a>
   </div>
   <?php
         if(isset($_SESSION["bankDel"])) {
            $mess = $_SESSION["bankDel"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
   ?>
   <?php
      $banklariSorgula = $db->prepare("SELECT * FROM bankahesablarimiz");
      $banklariSorgula->execute();
      $banklariSorgulaCount = $banklariSorgula->rowCount();
      $bankalar = $banklariSorgula->fetchAll(PDO::FETCH_ASSOC);
      if($banklariSorgulaCount > 0) {
         foreach($bankalar as $banka) {?>
            <div class="bankahesaplari__item">
               <div class="bankahesaplari__item__left">
                  <div class="left__image">
                     <img src="../assets/images/<?=$banka["bankLogo"]?>" alt="">
                  </div>
                  <div class="bankahesaplari__item__left__controlls">
                     <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=6&id=<?=$banka["id"]?>"><span><img src="../assets/images/Sil20x20.png" alt="">Sil</span></a>
                     <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=7&id=<?=$banka["id"]?>"><span><img src="../assets/images/Guncelleme20x20.png" alt="">Yenilə</span></a>
                  </div>
               </div>
               <div class="bankahesaplari__item__right">
                  <div class="bankahesaplari__item__right__top">
                     <div class="bankahesaplari__item__right__top__left"><span>Banka Adı </span><span>:&nbsp;&nbsp;&nbsp;<?=$banka["bankaAdı"]?></span></div>
                     <div class="bankahesaplari__item__right__top__right"><span>Hesap Sahibi </span><span>:&nbsp;&nbsp;&nbsp;	<?=$banka["hesabSahibi"]?></span></div>
                  </div>
                  <div class="bankahesaplari__item__right__bottom">
                     <span>Şube ve Konum Bilgileri</span>
                     <span>:&nbsp;&nbsp;&nbsp;<?=$banka["ŞubeAdı"]?>(<?=$banka["ŞubeKodu"]?>) - <?=$banka["KonumŞehir"]?> / <?=$banka["konumÜlke"]?></span>
                  </div>
                  <div class="bankahesaplari__item__right__footer">
                     <span>Hesap Bilgileri </span>
                     <span>:&nbsp;&nbsp;&nbsp;<?=$banka["paraBirimi"]?> / <?=$banka["hesabNumarası"]?> / <?=$banka["ibanNumarası"]?></span>
                  </div>
               </div>
            </div>
         <?php
         }
      } else {
         echo "Heç bir bank qeydiyyatınız yoxdur.";
      }
   ?>

</div>