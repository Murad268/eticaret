<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }
     if(isset($_GET["id"])) {
      $gelenId = $_GET["id"];
     } else {
      $gelenId = "";
     }
     if($gelenId == "") {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=47");
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
         $urunuSorgula = $db->prepare("SELECT * FROM goods WHERE id = ?");
         $urunuSorgula->execute([$gelenId]);
         $urun = $urunuSorgula->fetch(PDO::FETCH_ASSOC);
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
                           <option <?=$urun["menuId"] == $menu["id"]?"selected":null?> value="<?=$menu["id"]?>/<?=$menu["urunTuru"]?>"><?=$menu["menuAdi"]?>(<?=$menu["urunSayisi"]?>)</option>
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
                           <option <?=$urun["menuId"] == $menu["id"]?"selected":null?> value="<?=$menu["id"]?>/<?=$menu["urunTuru"]?>"><?=$menu["menuAdi"]?>(<?=$menu["urunSayisi"]?>)</option>
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
                           <option <?=$urun["menuId"] == $menu["id"]?"selected":null?> value="<?=$menu["id"]?>/<?=$menu["urunTuru"]?>"><?=$menu["menuAdi"]?>(<?=$menu["urunSayisi"]?>)</option>
                        <?php
                        }
                     }
                  ?>
                  <optgroup>
            </select>
         </div>
         <div>Məhsul Adı:</div>
         <div><input name="goodname" value="<?=$urun["urun_adi"]?>" type="text"></div>
         <div>Məhsul Qiyməti:</div>
         <div><input value="<?=$urun["urun_fiyati"]?>" name="goodprice" type="text"></div>
         <div>Məhsul Valyutası:</div>
         <div><input value="<?=$urun["para_birimi"]?>" name="goodcurrency" type="text"></div>
         <div>KDV Həcmi:</div>
         <div><input value="<?=$urun["KDVOrani"]?>" name="kdv" type="text"></div>
         <div>Kargo Qiyməti:</div>
         <div><input  value="<?=$urun["kargoUcreti"]?>" name="kargo" type="text"></div>
         <div>Məhsul Açığlaması:</div>
         <div><textarea  class="good__desc" name="gooddesc"><?=$urun["urun_aciklamasi"]?></textarea></div>
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
      <button class="btn btn-success">Məhsulu Yenilə</button>
   </form>
</div>