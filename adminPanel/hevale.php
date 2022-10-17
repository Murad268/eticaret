<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
  
   ?>
      <div class="panel__header">
         HEVALE BİLDİRİMLERİ
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
            $hevaleSorgusu = $db->prepare("SELECT * FROM havalebildirimleri");
            $hevaleSorgusu->execute();
            $hevaleler = $hevaleSorgusu->fetchAll(PDO::FETCH_ASSOC);
            $hevalelerSayisi = $hevaleSorgusu->rowCount();
           
          
            if($hevalelerSayisi > 0) {
               foreach($hevaleler as $hevale) {
                  $bankalariAra = $db->prepare("SELECT * FROM bankahesablarimiz WHERE id = ?");
                  $bankalariAra->execute([$hevale["bankaİd"]]);
                  $banka = $bankalariAra->fetch(PDO::FETCH_ASSOC);?>
                  <div class="hevale__item">
                     <div class="hevale__item_title">
                        <?=$hevale["adSoyad"]?>
                     </div>
                     <div class="hevale__item__wrapper">
                        <div><b style="color:black">Bank</b></div>
                        <div><?=DonusumleriGeriDondur($banka["bankaAdı"])?></div>
                        <div><b style="color:black">Telefon</b></div>
                        <div><?=DonusumleriGeriDondur($hevale["telefonNumarası"])?></div>
                        <div><b style="color:black">E-Mail</b></div>
                        <div><?=DonusumleriGeriDondur($hevale["emailAdresi"])?></div>
                        <div style="margin-top: 30px"><b style="color:black">Açıqlama Notu</b></div>
                        <div style="margin-top: 30px"><?=DonusumleriGeriDondur($hevale["acıklama"])?></div>
                     </div>
                     <div class="hevale__item_delete">
                        <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=61&id=<?=$hevale["id"]?>"><img src="../assets/images/Sil20x20.png" alt=""></a>
                     </div>
                     </div>
               <?php
               }
            } else {
               echo "Qeydiyyatda olan Hevale bildirimi yoxdur";
            }
         ?>
   
    
    </div>
</div>