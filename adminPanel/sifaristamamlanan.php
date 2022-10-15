<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
      $sayfalamaIcinButonSayisi = 2;
      $sayfaBasinaGosterilecek = 10;
      $toplamKayitSayisiSorgusu = $db->prepare("SELECT DISTINCT sifarisNumarasi FROM siparisler WHERE onayDurumu = ? AND kargoDurumu = ?  ORDER BY sifarisNumarasi DESC");
      $toplamKayitSayisiSorgusu->execute([1, 1]);
      $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
      $sayfalamayBaslayacaqKayotSayisi = ($sayfalama*$sayfaBasinaGosterilecek) - $sayfaBasinaGosterilecek;
      $bulunanSafyaSayisi = ceil($toplamKayitSayisi/$sayfaBasinaGosterilecek);
   ?>
      <div class="panel__header">
         ŞİFARİŞ PARAMETRLƏRİ
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=53">Gözləyən Sifarişlər</a>
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
            $siparisNumralariSorgusu = $db->prepare("SELECT DISTINCT sifarisNumarasi FROM siparisler WHERE kargoDurumu = 1 AND onayDurumu = 1 ORDER BY sifarisNumarasi DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
            $siparisNumralariSorgusu->execute();
            $siparisNumralariSayisi = $siparisNumralariSorgusu->rowCount();
            $siparisNumralariKayitlari = $siparisNumralariSorgusu->fetchAll(PDO::FETCH_ASSOC);
          
            if($siparisNumralariSayisi > 0) {
               foreach($siparisNumralariKayitlari as $siparisNumralariSatirlar) {
                  
                  $siparisNo = DonusumleriGeriDondur($siparisNumralariSatirlar["sifarisNumarasi"]);
                  $siparisSorgusu = $db->prepare("SELECT * FROM siparisler WHERE onayDurumu = 1 AND kargoDurumu = 1 AND  sifarisNumarasi = ?  ORDER BY id ASC");
                  $siparisSorgusu->execute([$siparisNumralariSatirlar["sifarisNumarasi"]]);
                  $siparisSorgusuKayitari = $siparisSorgusu->fetchAll(PDO::FETCH_ASSOC);
                  $mebleg = 0;
                  foreach($siparisSorgusuKayitari as $siparisSatirlar) {
                 
                     $tarix = $siparisSatirlar["siparishTarihi"];
                     $mebleg += ($siparisSatirlar["toplamUrunFiyati"]);
                  
                  }
                  ?>
                       <div class="sifariswrapper">
                              <div><b>Sifariş Tarixi</b></div>
                              <div>: &nbsp;&nbsp;<?=registrDate($tarix)?></div>
                              <div><b>Sifariş Məbləği</b></div>
                              <div>: &nbsp;&nbsp;<?=fiyatBitimlerndir($mebleg)?></div>
                              <div>
                                 <a style="text-decoration: none; color: black; margin-right :5px" href="index.php?sayfaKoduDis=0&sayfaKoduIc=54&sepet=<?=$siparisSatirlar["sifarisNumarasi"]?>">
                                    <img src="../assets/images/DokumanKirmiziKalemli20x20.png" alt="">
                                    Detay
                                 </a>
                                 <a style="text-decoration: none; color: black; margin-left :5px" href="index.php?sayfaKoduDis=0&sayfaKoduIc=59&sepet=<?=$siparisSatirlar["sifarisNumarasi"]?>">
                                    <img src="../assets/images/Sil20x20.png" alt="">
                                    Sil
                                 </a>
                              </div>
                         </div>
                        <hr>
                  <?php
                  
               } 
            } else {
               echo "Heç bir sifariş yoxdur";
            }
          ?>
 
    
    </div>

    <?php
         if($bulunanSafyaSayisi>0) {?>
            <div class="paginationWrapper">
                  <nav aria-label="Page navigation example ">
                     <ul class="pagination">
                     <li class="page-item"><a class="page-link" href="index.php?sayfaKoduDis=0&sayfaKoduIc=53&sayfalama=1">&laquo;</a></li>
                     <?php
                        for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                           if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                              $curr = $i;
                           if($sayfalama == $i) {
                              echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                           } else {
                              echo "<li class=\"page-item\"><a class=\"page-link\" href=\"index.php?sayfaKoduDis=0&sayfaKoduIc=53&sayfalama=$curr\">$curr</a></li>";
                           }
                        }
                     }
                     ?>
                        
                        <li class="page-item"><a class="page-link"  href="index.php?sayfaKoduDis=0&sayfaKoduIc=53&sayfalama=<?=$bulunanSafyaSayisi?>">&raquo;</a></li>
                     </ul>
                  </nav>
               </div>
        <?php }
        ?>
</div>