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
         $variantinSorgusu = $db->prepare("SELECT * FROM urunvariantlari WHERE urunİd = ?");
         $variantinSorgusu->execute([$gelenId]);
         $variantlar = $variantinSorgusu->fetchAll(PDO::FETCH_ASSOC);
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
         <div><input value="<?=$urun["kargoUcreti"]?>" name="kargo" type="text"></div>
         <div>Məhsul Açığlaması:</div>
         <div><textarea class="good__desc" name="gooddesc"><?=$urun["urun_aciklamasi"]?></textarea></div>

         <?php
            if($urun["urun_resmi_bir"] !== null) {?>
                 <div><div class="btn btn-success phototrigger" style="text-align: left" class="btn btn-success">1-ci şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled value="33" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 1:</div>
                 <div class="photo photoOwn"><input name="goodphoto1" type="file"></div> 
            <?php
            } else {?>
             <div>Məhsul Rəsmi 1:</div>
             <div class="photo"><input name="goodphoto1" type="file"></div> 
            <?php
            }
         ?>
       <?php
            if($urun["urun_resmi_iki"] !== null) {?>
                 <div><div  class="btn btn-success phototrigger">2-ci şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled value="33" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 2:</div>
                 <div class="photo photoOwn"><input name="goodphoto2" type="file"></div>
            <?php
            } else {?>
              <div>Məhsul Rəsmi 2:</div>
              <div class="photo"><input name="goodphoto1" type="file"></div>
            <?php
            }
         ?>
      <?php
            if($urun["urun_resmi_uc"] !== null) {?>
                 <div><div  class="btn btn-success phototrigger">3-cü şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled value="33" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 3:</div>
                 <div class="photo photoOwn"><input name="goodphoto3" type="file"></div>   
            <?php
            } else {?>
                <div>Məhsul Rəsmi 3:</div>
                <div class="photo"><input name="goodphoto1" type="file"></div>   
            <?php
            }
         ?>
      <?php
            if($urun["urun_resmi_dord"] !== null) {?>
                 <div><div class="btn btn-success phototrigger">4-cü şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled  value="33" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 4:</div>
                 <div class="photo photoOwn"><input name="goodphoto4" type="file"></div> 
            <?php
            } else {?>
             <div>Məhsul Rəsmi 4:</div>
             <div class="photo"><input name="goodphoto1"  type="file"></div> 
            <?php
            }
         ?>


         
         
    
        
      </div>
  
      <div class="variants">
       
      <div class="variant__wrapper">
            <div>1-ci ayaqqabı ölçüsü: </div>
            <div><input value="<?=$variantlar[0]["variantAdi"]?>" name="variant[]" type="text"></div>
            <div>1-ci ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[0])?$variantlar[0]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>2-ci ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[1])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>2-ci ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[1])?$variantlar[1]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>3-cü ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[2])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>3-cü ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[2])?$variantlar[2]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>4-cü ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[3])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>4-cü ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[3])?$variantlar[3]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>5-ci ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[4])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>5-ci ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[4])?$variantlar[4]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>6-cı ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[5])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>6-cı ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[5])?$variantlar[5]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>7-ci ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[6])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>7-ci ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[6])?$variantlar[6]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>8-ci ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[7])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>8-ci ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[7])?$variantlar[7]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      <div class="variant__wrapper">
            <div>9-cu ayaqqabı ölçüsü: </div>
            <div><input value="<?=isset($variantlar[8])?$variantlar[1]["variantAdi"]:null?>" name="variant[]" type="text"></div>
            <div>9-cu ölçü üçün stok ədədi: </div>
            <div><input value="<?=isset($variantlar[8])?$variantlar[8]["stokAdedi"]:null?>" name="stok[]" type="text"></div>
      </div>
      </div>
      <button class="btn btn-success">Məhsulu Yenilə</button>
   </form>
</div>