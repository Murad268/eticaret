<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         ADMIN PARAMETRLƏRİ
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=39">yeni admin əlavə elə</a>
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
         $adminsiSorgula = $db->prepare("SELECT * FROM admindadas");
         $adminsiSorgula->execute();
         $adminsiSorgulaCount = $adminsiSorgula->rowCount();
         $admins = $adminsiSorgula->fetchAll(PDO::FETCH_ASSOC);
         if($adminsiSorgulaCount>0) {
            foreach($admins as $admin) {?>
                       <div class="admin__item">
                           <div class="admin__item__login"><?=$admin["adminAdi"]?></div>
                           <div class="admin__item__name"><?=$admin["adminAdSoyad"]?></div>
                           <div class="admin__item__email"><?=$admin["adminEmaili"]?></div>
                           <div class="admin__item__pass"><?=$admin["adminTelefon"]?></div>
                           <div class="admin__item__controlls">
                              <?php
                                
                                 if($admin["id"]==$admin_id) {?>
                                    <span class="adminsil"><button class="btn btn-warning" disabled>X</button></span>
                                 <?php
                                 } else{?>
                                    <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=36&id=<?=$admin["id"]?>"><span><img src="../assets/images/Sil20x20.png" alt="">Sil</span></a>
                                 <?php
                                 }
                              ?>
                              <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=37&id=<?=$admin["id"]?>"><span><img src="../assets/images/Guncelleme20x20.png" alt="">Yenilə</span></a>
                           </div>
                      </div>
                      <hr>
            <?php
            }
         }
      ?> 
    
    </div>
</div>