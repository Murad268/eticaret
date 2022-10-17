<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         KARGO AYARLARI
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=15">yeni kargo əlavə elə</a>
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
         $kargolariSorgula = $db->prepare("SELECT * FROM kargo");
         $kargolariSorgula->execute();
         $kargolariSorgulaCount = $kargolariSorgula->rowCount();
         $kargolar = $kargolariSorgula->fetchAll(PDO::FETCH_ASSOC);
         if($kargolariSorgulaCount>0) {
            foreach($kargolar as $kargo) {?>
                   <div class="kargo__item">
                     <div class="kargo__item__img">
                        <img src="../assets/images/<?=$kargo["logo"]?>" alt="">
                     </div>
                     <div class="kargo__item__name"><span style="font-weight: bold;">Kargo Firmasının Adı</span><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$kargo["ad"]?></span></div>
                     <div class="kargo__item__controlls">
                        <span style="margin-right: 20px;">
                           <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=12&id=<?=$kargo["id"]?>">
                              <img style="margin-right: 10px;" src="../assets/images/Sil20x20.png" alt="">
                              <span>Sil</span>
                           </a>
                        </span>
                        <span>
                           <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=13&id=<?=$kargo["id"]?>">
                              <img style="margin-right: 10px;" src="../assets/images/Guncelleme20x20.png" alt="">
                              <span>Yenilə</span>
                           </a>
                        </span>
                     </div>
                  </div>
            <?php
            }
         }
      ?>
    
    </div>
</div>