<!-- 1.58 -->

<?php
   if(isset($_GET["id"])) {
      $gelenId = $_GET["id"];
   } else {
      $gelenId = "";
   }
   if($gelenId == "") {
      header("Location: index.php");
      exit();
   }
?>
<div class="goodWrapper">
   <?php
      $goodImageFetch = $db->prepare("SELECT * FROM goods WHERE id = ? ");
      $goodImageFetch->execute([$gelenId]);
      $goodImages = $goodImageFetch->fetch(PDO::FETCH_ASSOC);

      $miniImages = [];
      if(!empty($goodImages["urun_resmi_bir"])) {
         $miniImages[] = Guvenlik($goodImages["urun_resmi_bir"]);
      }
      if(!empty($goodImages["urun_resmi_iki"])) {
         $miniImages[] = Guvenlik($goodImages["urun_resmi_iki"]);
      }
      if(!empty($goodImages["urun_resmi_uc"])) {
         $miniImages[] = Guvenlik($goodImages["urun_resmi_uc"]);
      }
      if(!empty($goodImages["urun_resmi_dord"])) {
         $miniImages[] = Guvenlik($goodImages["urun_resmi_dord"]);
      }
    
      switch($goodImages["urunTuru"]) {
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
   ?>
   <div class="goodWrapper__photos">
      <div class="goodWrapper__photos__image">
         <div class="goodWrapper__photos__img">
            <img src="assets/images/UrunResimleri/<?=$klasor."/".DonusumleriGeriDondur($goodImages["urun_resmi_bir"])?>" alt="">
         </div>
         <div class="goodWrapper__photos__miniImgs">
            <?php
               foreach($miniImages as $miniImg) {?>
               <div class="goodWrapper__photos__miniImg">
                  <img src="assets/images/UrunResimleri/<?=$klasor."/".$miniImg?>" alt="">
               </div>
            <?php }
            ?>   
         </div>
      </div>
      <div class="goodWrapper__photos__banner">
         <div class="goodWrapper__photos__banner__header">
            REKLAMLAR
         </div>
         <div class="goodWrapper__photos__banner__image">
            <?php
                  $fetchBanner = $db->prepare("SELECT * FROM bannerler WHERE	bannerAlani = 'urunAlti' ORDER BY gosterimSayisi ASC LIMIT 1");
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
   <div class="goodWrapper__details">
            <?php
               if(isset($_SESSION["message"])) {
                  $mess = $_SESSION["message"];
                  echo "<div class='alert alert-danger' role='alert'>
                     $mess
                  </div>";
               }
            ?>
      <div class="goodWrapper__details__title"><?=DonusumleriGeriDondur($goodImages["urun_adi"])?></div>
      <form action="index.php?sayfaKodu=55&id=<?=$gelenId?>" method="post">
         <div class="goodWrapper__details__btns">
            <div class="goodWrapper__details__btn">
               <img src="assets/images/Facebook24x24.png" alt="">
            </div>
            <div class="goodWrapper__details__btn">
               <img src="assets/images/Twitter24x24.png" alt=""> 
            </div>
            <?php
               if(!isset($_SESSION["userName"])) {?>
                  <div style="cursor: pointer;" div class="goodWrapper__details__btn">
                     <a href="index.php?sayfaKodu=53&id=<?=$gelenId?>"><i class="fa fa-heart" style="color: black;" aria-hidden="true"></i></a>
                  </div>
               <?php
               } else {
                  $fethFvorites = $db->prepare("SELECT * FROM favoriler WHERE uyeId = ? AND 	urunId = ?");
                  $fethFvorites->execute([$id, $gelenId]);
                  $fethFvoritesCount = $fethFvorites->rowCount();
                  if($fethFvoritesCount>0) {?>
                     <div style="cursor: pointer;" div class="goodWrapper__details__btn">
                        <a href="index.php?sayfaKodu=54&id=<?=$gelenId?>"><i class="fa fa-heart" style="color: orange;" aria-hidden="true"></i></a>
                     </div>
                  <?php
                  } else {?>
                     <div style="cursor: pointer;" class="goodWrapper__details__btn">
                        <a href="index.php?sayfaKodu=53&id=<?=$gelenId?>"><i class="fa fa-heart" style="color: black;" aria-hidden="true"></i></a>
                     </div>
                  <?php
                  }
               }
            
            ?>
         
            <div class="goodWrapper__details__btn">
               <button class="btn btn-primary text-white">SEPETE EKLE</button>
            </div>
         </div>
         <div class="goodWrapper__details__order">
            <div class="goodWrapper__details__order__select">
               <select name="variant" id="">
                  <option value="">Lütfen Numara Seçiniz</option>
                  <?php
                     $fetchVariants = $db->prepare("SELECT * FROM urunvariantlari WHERE urunİd = ?");
                     $fetchVariants->execute([$gelenId]);
                     $fetchVariantsCount = $fetchVariants->rowCount();
                     if($fetchVariantsCount > 0) {
                        foreach($fetchVariants as $fetchVariant) {?>
                           <?php
                              if(!$fetchVariant["stokAdedi"] > 0) {?>
                                 <option value="none"><?=$fetchVariant["variantAdi"]?> - Hazırda stokda bu mal yoxdur</option>
                              <?php
                              } else {?>
                                 <option value="<?=$fetchVariant["id"]?>"><?=$fetchVariant["variantAdi"]?></option>
                              <?php
                              }
                           ?>
                        
                     <?php
                        }
                     }
                  ?>
               </select>
             
            </div>
            <div class="goodCount">
               <div style="cursor: pointer" class="goodCount__plus"><i class="fa fa-plus" aria-hidden="true"></i></div>
            
               <input class="input" name="count"  value="1"  style="width: 30px;" type="text">
               <div style="cursor: pointer" class="goodCount__minus"><i class="fa fa-minus" aria-hidden="true"></i></div>
            </div>
            <div class="goodWrapper__details__order__price"><?=fiyatBitimlerndir(DonusumleriGeriDondur($goodImages["urun_fiyati"]))?> TL</div>
         </div>
      </form>
      <ul class="goodWrapper__details__list">
         <li class="goodWrapper__details__list__item"><img src="assets/images/SaatEsnetikGri20x20.png" alt="">Siparişiniz <strong style="color: black"><?=ucGunIreli($unix)?></strong> tarihine kadar kargoya verilecektir</li>
         <li class="goodWrapper__details__list__item"><img src="assets/images/SaatHizCizgiliLacivert20x20.png" alt="">İlgili ürün süper hızlı gönderi kapsamındadır. Aynı gün teslimat yapılabilir</li>
         <li class="goodWrapper__details__list__item"><img src="assets/images/KrediKarti20x20.png" alt="">Tüm bankaların kredi kartları ile peşin veya taksitli ödeme seçeneyi</li>
         <li class="goodWrapper__details__list__item"><img src="assets/images/Banka20x20.png" alt="">Tüm bankalardan hevale ve ya EFT ile ödeme seçeneyi</li>
      </ul>

      <div class="goodWrapper__details__desc">
         <div class="goodWrapper__details__desc__header">Ürün Açıklama</div>
         <div class="goodWrapper__details__desc__desc">
            <?=DonusumleriGeriDondur($goodImages["urun_aciklamasi"])?>
         </div>
         <hr>
      </div>
      <div class="goodWrapper__details__comments__header">
            Ürün Yorumları
      </div>
      <div class="goodWrapper__details__comments">
        
         <?php
            $fetchComments = $db->prepare("SELECT * FROM yorumlar WHERE urunId = ?");
            $fetchComments->execute([$gelenId]);
            $fetchCommentsCount = $fetchComments->rowCount();
            $comments = $fetchComments->fetchAll(PDO::FETCH_ASSOC);
         
            if($fetchCommentsCount>0) {
               foreach($comments as $comment) {
                  switch($comment["puan"]) {
                     case 1:
                        $puanImg = "assets/images/YildizBirDolu.png";
                        break;
                     case 2:
                        $puanImg = "assets/images/YildizIkiDolu.png";
                        break;
                     case 3:
                        $puanImg = "assets/images/YildizUcDolu.png";
                        break;
                     case 4:
                        $puanImg = "assets/images/YildizDortDolu.png";
                        break;
                     case 5:
                        $puanImg = "assets/images/YildizBesDolu.png";
                        break;
                  }
                  $userFetch = $db->prepare("SELECT * FROM users WHERE id = ?");
                  $userID = $comment["uyeId"];
                  $userFetch->execute([$userID]);
                  $user = $userFetch->fetch(PDO::FETCH_ASSOC);
                  ?>
               
                  <div class="goodWrapper__details__comments__list">
                     <div class="goodWrapper__details__comments__list__header">
                        <div class="goodWrapper__details__comments__list__header__puan"><img src="<?=$puanImg?>" alt=""></div>
                        <div class="goodWrapper__details__comments__list__header__name"><?=donusumleriGeriDondur($user["full_name"])?></div>
                        <div class="goodWrapper__details__comments__list__header__tarih"> <?=registrDate(donusumleriGeriDondur($comment["yorumTarihi"]))?></div>
                     </div>
                     
                  </div>
                  <div class="goodWrapper__details__comments__list__comment">
                        <?=$comment["yorumMetni"]?>
                  </div>
                  <hr>
               <?php
               }
            }
         ?>
    
      </div>
   </div>
</div>