<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
      if(isset($_POST["query"])) {
         $query = $_POST["query"];
         $searchingUser = "WHERE yorumMetni LIKE '%$query%'";
      } else {
         $query = "";
         $searchingUser = "";
      }
      $sayfalamaIcinButonSayisi = 2;
      $sayfaBasinaGosterilecek = 10;
      $toplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM yorumlar $searchingUser ORDER BY id DESC");
      $toplamKayitSayisiSorgusu->execute();
      $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
      $sayfalamayBaslayacaqKayotSayisi = ($sayfalama*$sayfaBasinaGosterilecek) - $sayfaBasinaGosterilecek;
      $bulunanSafyaSayisi = ceil($toplamKayitSayisi/$sayfaBasinaGosterilecek);
   ?>
      <div class="panel__header">
         Şərh Paramertrləri
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
      <div class="manWrapper__items__search">
         <div class="row height d-flex justify-content-center align-items-center">
            <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=45" method="post" class="">
            
               <div class="input-group mb-3">
                  <input name="query" type="text" class="form-control form-control-lg" placeholder="Search Here">
                  <button type="submit" class="input-group-text btn btn-success"><i class="bi bi-search me-2"></i> Axtar</button>
               </div>
            </form>
         </div>
      </div>
      <?php
        $yorumSorgusu = $db->prepare("SELECT * FROM yorumlar $searchingUser ORDER BY id DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
        $yorumSorgusu->execute();
        $yoruNumralariSayisi = $yorumSorgusu->rowCount();
        $yorumiKayitlari = $yorumSorgusu->fetchAll(PDO::FETCH_ASSOC);
       
        if($yoruNumralariSayisi > 0) {
         foreach($yorumiKayitlari as $yorum) {
            $uyelerSorgusu = $db->prepare("SELECT * FROM users WHERE id = ?");
            $uyelerSorgusu->execute([$yorum["uyeId"]]);
            $uye = $uyelerSorgusu->fetch(PDO::FETCH_ASSOC);
            switch($yorum["puan"]) {
               case 1:
                  $puanImg = "../assets/images/YildizBirDolu.png";
                  break;
               case 2:
                  $puanImg = "../assets/images/YildizIkiDolu.png";
                  break;
               case 3:
                  $puanImg = "../assets/images/YildizUcDolu.png";
                  break;
               case 4:
                  $puanImg = "../assets/images/YildizDortDolu.png";
                  break;
               case 5:
                  $puanImg = "../assets/images/YildizBesDolu.png";
                  break;
            }?>
            <div class="comment__item">
               <div class="comment__item__top">
                  <p><?=$yorum["yorumMetni"]?></p>
                  <p><?=$uye["full_name"]?></p>
               </div>
               <div class="comment__item__bottom">
                  <img src="<?=$puanImg?>" alt="">
                  <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=46&id=<?=$yorum["id"]?>"><img src="../assets/images/Sil20x20.png" alt=""></a>
               </div>
            </div>
            <hr>
         <?php
         }
        } else {
         echo "Şərh yoxdur";
        }
      ?>
       
       <?php
            if($bulunanSafyaSayisi>1) {?>
               <div style="margin: 30px 320px" class="paginationWrapper">
                  <nav aria-label="Page navigation example ">
                     <ul class="pagination">
                     <li class="page-item"><a class="page-link" href="index.php?sayfaKoduDis=0&sayfaKoduIc=45&sayfalama=1<?$sayfalamaKosulu?>">&laquo;</a></li>
                     <?php
                        for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                           if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                              $curr = $i;
                           if($sayfalama == $i) {
                              echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                           } else {
                              echo "<li class=\"page-item\"><a class=\"page-link\" href=\"index.php?sayfaKoduDis=0&sayfaKoduIc=45&sayfalama=$curr\">$curr</a></li>";
                           }
                        }
                     }
                     ?>
                        
                        <li class="page-item"><a class="page-link"  href="index.php?sayfaKoduDis=0&sayfaKoduIc=45&sayfalama=<?=$bulunanSafyaSayisi?>&<?$sayfalamaKosulu?>">&raquo;</a></li>
                     </ul>
                  </nav>
               </div>
            <?php
            }
               ?>
 
    
    </div>
</div>