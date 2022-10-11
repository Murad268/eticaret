<?php
   
   if(isset($_SESSION["admin"])) {?>
      <div class="container">
         <div class="panelWrapper">
            <div class="panelWrapper__menu">
               <div class="panelWrapper__menu__logo">
                  <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=0"><img src="../assets/images/<?=$logo?>" alt=""></a>
               </div>

               <ul class="menu__items">
                  <li><a href="">SİPARİŞLER (x/x)</a></li>
                  <li><a href="">HEVALE BİLDİRİMLERİ (x/x)</a></li>
                  <li><a href="">ÜRÜNLER</a></li>
                  <li><a href="">ÜYELER</a></li>
                  <li><a href="">YORUMLAR</a></li>
                  <li><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=1">SİTE AYARLARI</a></li>
                  <li><a href="">MENÜLER</a></li>
                  <li><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=5">BANKA HESAP AYARLARI</a></li>
                  <li><a href="index.php?sayfaKoduDis=0&sayfaKoduIc=3">SÖZLEŞMELER VE METİNLER</a></li>
                  <li><a href="">KARGO AYARLARI</a></li>
                  <li><a href="">BANNER AYARLARI</a></li>
                  <li><a href="">DESTEK İÇERİKLERİ</a></li>
                  <li><a href="">Yöneticiler</a></li>
               </ul>
            </div>
            <div class="panelWrapper__content">
               <?php
                     if(($sayfaKoduIc == 0) or ($sayfaKoduIc == "") or (!$sayfaKoduIc)) {
                        include($inside[0]);
                     } else {
                        include($inside[$sayfaKoduIc]);
                     }
               ?>
            </div>
         </div>
      </div>
   <?php
   } else {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }
?>