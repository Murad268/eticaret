<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      MƏHSUL PARAMETRLƏRİ
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=50" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
         ?>
           <div class="siteayarlari__ayarlar urun__ayarlari">
         <div>Məhsul Menyusu:</div>
         <div>
            <select name="menu" id="">
               <optgroup label="Kişi Ayaqqabıları">
                  <?php
                     $menulerSorgusu = $db->prepare("SELECT * FROM menuler WHERE urunTuru = 'erkek'");
                     $menulerSorgusu->execute();
                     $menulerSayi = $menulerSorgusu->rowCount();
                     $menuler = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                     if($menulerSayi>0) {
                        foreach($menuler as $menu) {?>
                           <option value="<?=$menu["id"]?>/<?=$menu["urunTuru"]?>"><?=$menu["menuAdi"]?>(<?=$menu["urunSayisi"]?>)</option>
                        <?php
                        }
                     }
                  ?>
                  <optgroup>
                  <optgroup label="Qadın Ayaqqabıları">
                  <?php
                     $menulerSorgusu = $db->prepare("SELECT * FROM menuler WHERE urunTuru = 'kadin'");
                     $menulerSorgusu->execute();
                     $menulerSayi = $menulerSorgusu->rowCount();
                     $menuler = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                     if($menulerSayi>0) {
                        foreach($menuler as $menu) {?>
                           <option value="<?=$menu["id"]?>/<?=$menu["urunTuru"]?>"><?=$menu["menuAdi"]?>(<?=$menu["urunSayisi"]?>)</option>
                        <?php
                        }
                     }
                  ?>
                  <optgroup>
                  <optgroup label="Uşaq Ayaqqabıları">
                  <?php
                     $menulerSorgusu = $db->prepare("SELECT * FROM menuler WHERE urunTuru = 'cocuk'");
                     $menulerSorgusu->execute();
                     $menulerSayi = $menulerSorgusu->rowCount();
                     $menuler = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                     if($menulerSayi>0) {
                        foreach($menuler as $menu) {?>
                           <option value="<?=$menu["id"]?>/<?=$menu["urunTuru"]?>"><?=$menu["menuAdi"]?>(<?=$menu["urunSayisi"]?>)</option>
                        <?php
                        }
                     }
                  ?>
                  <optgroup>
            </select>
         </div>
         <div>Məhsul Adı:</div>
         <div><input name="goodname" type="text"></div>
         <div>Məhsul Qiyməti:</div>
         <div><input name="goodprice" type="text"></div>
         <div>Məhsul Valyutası:</div>
         <div>
            <select name="goodcurrency" id="">
               <option value="TRY">Türk Lirəsi</option>
               <option value="USD">Amerikan Dolları</option>
               <option value="EUR">Euro</option>
            </select>
         </div> 
         <div>KDV Həcmi:</div>
         <div><input name="kdv" type="text"></div>
         <div>Kargo Qiyməti:</div>
         <div><input name="kargo" type="text"></div>
         <div>Məhsul Açığlaması:</div>
         <div><textarea class="good__desc" name="gooddesc"></textarea></div>
         <div>Məhsul Rəsmi 1:</div>
         <div class="photo"><input name="goodphoto1" type="file"></div> 
        
         
      </div>
      <div class="add__good__img">
            +
      </div>
      <div class="variants">
      <div class="variant__wrapper">
            <div>1-ci ayaqqabı ölçüsü: </div>
            <div><input name="variant[]" type="text"></div>
            <div>1-ci ölçü üçün stok ədədi: </div>
            <div><input name="stok[]" type="text"></div>
      </div>
         
      </div>
      <div class="add__good__variant">
               +
      </div>
      <button class="btn btn-success">Yeni məhsul əlavə elə</button>
   </form>
</div>