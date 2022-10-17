<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
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
<div class="adresMainWrapper"> 
               <?php
                  if(isset($_SESSION["alert"])) {
                     $mess = $_SESSION["alert"];
                     echo "<div class='alert alert-danger' role='alert'>
                        $mess
                     </div>";
                  }
               ?>
   <div class="havaleWrapper__form">
      
      <h4 class="havaleWrapper__form__title">Hesabım > Adresler</h4>
      <div class="havaleWrapper__form__subtitle">Tüm adreslerinizi göruntülüye və ya güncelliye bilirsiniz.</div>
      <div class="adresMainWrapper__header">
         <div class="adresMainWrapper__header__text">Adresler</div>
         <div class="adresMainWrapper__header__add"><a href="yeniAdres">Yeni adres ekle</a></div>
      </div>
      <div class="aresWrapper">
         <?php
            $adressFetch = $db->prepare("SELECT * FROM adresler WHERE userId = ?");
            $adressFetch->execute([$id]);
            $adressCount=$adressFetch->rowCount();
            $adresler = $adressFetch->fetchAll(PDO::FETCH_ASSOC);
            $firstColor = "#FFFFFF";
            $secondColor =  "#F1F1F1";
            $colorCount = 1;
            if($adressCount > 0) {
               foreach($adresler as $key => $adress) {  
                  if($colorCount%2 ) {
                     $bgColor = $firstColor;
                  } else {
                     $bgColor = $secondColor;
                  }
                  ?>
               
                  <div style="background-color: <?=$bgColor?>;" class="aresWrapper__item">
                     <div class="areWrapper__item__addr"><?=$adress["adSoyad"]."-".$adress["adres"]."-".$adress["ilce"]."/".$adress["sehir"]."-".$adress["telefonNumarasi"]?></div>
                     <div class="aresWrapper__item__controlls">
                        <div class="update">
                           <img src="assets/images/Guncelleme20x20.png" alt="">
                           <span class="updateDiv">Güncelle</span>
                           <a hidden class="updateLink" href="adresiYenile/<?=$adress["id"]?>">Güncelle</a>
                        </div>
                       
                        <div class="delete">
                           <img src="assets/images/Sil20x20.png" alt="">
                           <span class="deleteDiv">sil</span>
                           <a hidden class="deleteLink" href="adresiSil/<?=$adress["id"]?>">Sil</a>
                        </div>
                     </div>
                  </div>
               <?php $colorCount++;
               
            }
               
            }else {
               echo '
                     <div style="background-color: <?=$bgColor?>;" class="aresWrapper__item">
                        Heç bir adresiniz yoxdur.
                     </div>
               ';
            }
         ?>
      </div>
   </div>

</div>