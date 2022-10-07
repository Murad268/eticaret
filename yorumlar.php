<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   $sayfalamaIcinButonSayisi = 2;
   $sayfaBasinaGosterilecek = 2;
   $toplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM yorumlar WHERE uyeId = ? ORDER BY yorumTarihi DESC");
   $toplamKayitSayisiSorgusu->execute([$id]);
   $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
   $sayfalamayBaslayacaqKayotSayisi = ($sayfalama*$sayfaBasinaGosterilecek) - $sayfaBasinaGosterilecek;
   $bulunanSafyaSayisi = ceil($toplamKayitSayisi/$sayfaBasinaGosterilecek);
?>
  <hr>
      <div class="user__navbar">
         <div class="user__navbar__link"><a href="index.php?sayfaKodu=27">Üyelik Bilgileri</a></div>
         <div class="user__navbar__link"><a href="index.php?sayfaKodu=36">Adresler</a></div>
         <div class="user__navbar__link"><a href="index.php?sayfaKodu=37">Favoriler</a></div>
         <div class="user__navbar__link"><a href="index.php?sayfaKodu=38">Yorumlar</a></div>
         <div class="user__navbar__link"><a href="index.php?sayfaKodu=39">Siparişler</a></div>
      </div>
   <hr>
<div class="adresMainWrapper"> 
   <div class="havaleWrapper__form">
      
      <h4 class="havaleWrapper__form__title">Hesabım > Yorumlar</h4>
      <div class="havaleWrapper__form__subtitle">Tüm yorumlarınızı aşağıdan göre biliirsiniz.</div>
      <?php
               $yorumNumralariSorgusu = $db->prepare("SELECT * FROM yorumlar WHERE uyeId = ? ORDER BY yorumTarihi DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
               $yorumNumralariSorgusu->execute([$id]);
               $yorumNumralariSayisi = $yorumNumralariSorgusu->rowCount();
               $yorumNumralariKayitlari = $yorumNumralariSorgusu->fetchAll(PDO::FETCH_ASSOC);
               if(!$yorumNumralariSayisi>0) {
                  echo "Henüz sisteme kayıtlı yorumunuz yok";
               }
      ?>
      <div class="comments__header">
      
      
         <?php    
               if($yorumNumralariSayisi>0) {?>
                  <div class="comments__header__item mainCommentItem">Puan</div>
                  <div class="comments__header__item mainCommentItem">Yorum</div>
                  <?php     foreach($yorumNumralariKayitlari as $yorumlar) {  

             
                  switch($yorumlar["puan"]) {
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
                  ?>
                     <div class="comments__header__item">
                        <img style="width: 70px; height: 15px" src="<?=$puanImg?>" alt="">
                     </div>
                     <div class="comments__header__item"><?=$yorumlar["yorumMetni"]?></div> 
               <?php
               }
               } 
         ?>
      </div>
      
   </div>
            <?php
               if($bulunanSafyaSayisi > 1) {?>
                  <div class="paginationWrapper">
                     <nav aria-label="Page navigation example ">
                        <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="index.php?sayfaKodu=38&sayfalama=1">&laquo;</a></li>
                        <?php
                           for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                              if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                                 $curr = $i;
                              if($sayfalama == $i) {
                                 echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                              } else {
                                 echo "<li class=\"page-item\"><a class=\"page-link\" href=\"index.php?sayfaKodu=38&sayfalama=$curr\">$curr</a></li>";
                              }
                           }
                        }
                        ?>
                           
                           <li class="page-item"><a class="page-link"  href="index.php?sayfaKodu=38&sayfalama=<?=$bulunanSafyaSayisi?>">&raquo;</a></li>
                        </ul>
                     </nav>
                  </div>
               <?}
            ?>
 
     
</div>