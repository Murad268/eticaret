<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   $sayfalamaIcinButonSayisi = 2;
   $sayfaBasinaGosterilecek = 10;
   $toplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM favoriler WHERE uyeId = ? ORDER BY id ASC");
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
<div class="adresMainWrapper favoitesWrapper"> 
   <div class="havaleWrapper__form">
      
      <h4 class="havaleWrapper__form__title">Hesabım > Favoriler</h4>
      <div class="havaleWrapper__form__subtitle">Tüm favorilere eklediginiz ürünleri aşağıdan göre biliirsiniz.</div>
      <?php
     
         
       
        
         
      ?>

         
         <?php
            $favoritesFetch = $db->prepare("SELECT * FROM favoriler WHERE uyeId = ? ORDER BY id DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
            $favoritesFetch->execute([$id]);
            $favoritesFetchCount = $favoritesFetch->rowCount();
            $favorites = $favoritesFetch->fetchAll(PDO::FETCH_ASSOC);
          
            if($favoritesFetchCount > 0) {?>
            <div class="comments__header">
            <div class="comments__header__item mainCommentItem">Resim</div>
            <div class="comments__header__item mainCommentItem">Sil</div>
            <div class="comments__header__item mainCommentItem">Adı</div>
            <div class="comments__header__item mainCommentItem">Fiyatı</div>
            <?php
            
               foreach($favorites as $favorite) {
                
                  $favoritesGoodFetch = $db->prepare("SELECT * FROM goods WHERE id = ? LIMIT 1");
                  $favoritesGoodFetch->execute([$favorite["urunId"]]);
                  $favoritedGoods = $favoritesGoodFetch->fetch(PDO::FETCH_ASSOC);
                 
                  if($favoritedGoods["urunTuru"] == "erkek") {
                     $klasor = "Erkek";
                  } elseif($favoritedGoods["urunTuru"] == "kadin") {
                     $klasor = "Kadin";
                  } else {
                     $klasor = "Cocuk";
                  }
                
                 ?>
                     <div class="comments__header__item "><img style="height: 80px; width: 60px" src="assets/images/UrunResimleri/<?=$klasor."/".DonusumleriGeriDondur($favoritedGoods["urun_resmi_bir"])?>" alt=""></div>
                     <div class="comments__header__item ">
                        <div class="deleteFavorite" style="cursor: pointer;"><img src="assets/images/Sil20x20.png" alt=""></div>
                        <a hidden href="sevimlilerdenSil/<?=DonusumleriGeriDondur($favorite["id"])?>">
                           <img class="favoriteDelete" src="assets/images/Sil20x20.png" alt="">
                        </a>
                     </div>
                     <div class="comments__header__item "><a href=""><?=DonusumleriGeriDondur($favoritedGoods["urun_adi"])?></a></div>
                     <div class="comments__header__item "><?=DonusumleriGeriDondur($favoritedGoods["urun_fiyati"])." ".DonusumleriGeriDondur($favoritedGoods["para_birimi"])?></div>
                 <?php 
                 echo "<hr>";
                 echo "<hr>";
                 echo "<hr>";
                 echo "<hr>";
               }
            } else {
               echo "Sevimliləriniz boşdur";
            }
         ?>
      </div>
      
   </div>
         
 <?php
   if($bulunanSafyaSayisi > 0) {?>
      <div class="paginationWrapper">
            <nav aria-label="Page navigation example ">
               <ul class="pagination">
               <li class="page-item"><a class="page-link" href="sevimliler/1">&laquo;</a></li>
               <?php
                  for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                     if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                        $curr = $i;
                     if($sayfalama == $i) {
                        echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                     } else {
                        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"sevimliler/$curr\">$curr</a></li>";
                     }
                  }
               }
               ?>
                  
                  <li class="page-item"><a class="page-link"  href="sevimliler/<?=$bulunanSafyaSayisi?>">&raquo;</a></li>
               </ul>
            </nav>
         </div>
   <?php
   }
      
 ?>
     
</div>