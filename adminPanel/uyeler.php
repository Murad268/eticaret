<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
      if(isset($_POST["query"])) {
         $query = $_POST["query"];
         $searchingUser = " AND (full_name LIKE '%$query%' OR email LIKE '%$query%' OR phone LIKE '%$query%' OR sex LIKE '%$query%')";
      } else {
         $query = "";
         $searchingUser = "";
      }
      $sayfalamaIcinButonSayisi = 2;
      $sayfaBasinaGosterilecek = 10;
      $toplamKayitSayisiSorgusu = $db->prepare("SELECT * FROM users WHERE silinmeDurumu = 0 $searchingUser ORDER BY id DESC");
      $toplamKayitSayisiSorgusu->execute();
      $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
      $sayfalamayBaslayacaqKayotSayisi = ($sayfalama*$sayfaBasinaGosterilecek) - $sayfaBasinaGosterilecek;
      $bulunanSafyaSayisi = ceil($toplamKayitSayisi/$sayfaBasinaGosterilecek);
   ?>
      <div class="panel__header">
         İstifadəçi Paramertrləri
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=43">Silinmiş İştifadəçilər</a>
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
            <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=41" method="post" class="">
               <div class="input-group mb-3">
                  <input name="query" type="text" class="form-control form-control-lg" placeholder="Search Here">
                  <button type="submit" class="input-group-text btn btn-success"><i class="bi bi-search me-2"></i> Axtar</button>
               </div>
            </form>
         </div>
      </div>
      <?php
         $usersFetch = $db->prepare("SELECT * FROM users WHERE silinmeDurumu = 0 $searchingUser ORDER BY id DESC LIMIT $sayfalamayBaslayacaqKayotSayisi, $sayfaBasinaGosterilecek");
         $usersFetch->execute();
         $usersFetchCount = $usersFetch->rowCount();
         $users = $usersFetch->fetchAll(PDO::FETCH_ASSOC);
         if($usersFetchCount > 0) {
            foreach($users as $user) {?>
                  <div class="users__item">
                     <div class="users__item__name"><span>Adı Soyadı</span>: <?=$user["full_name"]?></div>
                     <div class="users__item__title__email"><span>E-Mail</span>: <?=$user["email"]?></div>
                     <div class="users__item__title__phone"><span>Telefon</span>: <?=$user["phone"]?></div>
                     <div class="users__item__title__sex"><span>Cinsiyyət</span>: <?=$user["sex"]?></div>
                     <div class="users__item__title__date"><span>Qeydiyyat Tarixi</span>: <?=registrDate($user["regDate"])?></div>
                     <div class="users__item__title__ip"><span>Qeydiyyat İP-si</span>: <?=$user["ip"]?></div>
                     <div class="user__delete">
                        <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=42&id=<?=$user["id"]?>"><img src="../assets/images/Sil20x20.png" alt=""></a>
                     </div>
                  </div>
            <?
            }
         } else {
            echo "İstifadəçilər yoxdur";
         }
      ?>
    
            <?php
                  if($bulunanSafyaSayisi>1) {?>
                     <div style="margin: 30px 320px" class="paginationWrapper">
                        <nav aria-label="Page navigation example ">
                           <ul class="pagination">
                           <li class="page-item"><a class="page-link" href="index.php?sayfaKoduDis=0&sayfaKoduIc=41&sayfalama=1<?$sayfalamaKosulu?>">&laquo;</a></li>
                           <?php
                              for($i = $sayfalama-$sayfalamaIcinButonSayisi; $i <= $sayfalama+$sayfalamaIcinButonSayisi; $i++) {
                                 if(($i > 0) and ($i <= $bulunanSafyaSayisi)) {
                                    $curr = $i;
                                 if($sayfalama == $i) {
                                    echo "<li style=\"cursor: pointer\" class=\"page-item\"><div style=\"background: red; color: white\" class=\"page-link\">$curr</div></li>";
                                 } else {
                                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"index.php?sayfaKoduDis=0&sayfaKoduIc=41&sayfalama=$curr\">$curr</a></li>";
                                 }
                              }
                           }
                           ?>
                              
                              <li class="page-item"><a class="page-link"  href="index.php?sayfaKoduDis=0&sayfaKoduIc=41&sayfalama=<?=$bulunanSafyaSayisi?>&<?$sayfalamaKosulu?>">&raquo;</a></li>
                           </ul>
                        </nav>
                     </div>
                  <?php
                  }
               ?>
 
    
    </div>
</div>