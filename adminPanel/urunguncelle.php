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
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=52&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
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
         <div>
            <select name="goodcurrency" id="">
               <option value="TRY">Türk Lirəsi</option>
               <option value="USD">Amerikan Dolları</option>
               <option value="EUR">Euro</option>
            </select>
         </div>
         <div>KDV Həcmi:</div>
         <div><input value="<?=$urun["KDVOrani"]?>" name="kdv" type="text"></div>
         <div>Kargo Qiyməti:</div>
         <div><input value="<?=$urun["kargoUcreti"]?>" name="kargo" type="text"></div>
         <div>Məhsul Açığlaması:</div>
         <div><textarea class="good__desc" name="gooddesc"><?=$urun["urun_aciklamasi"]?></textarea></div>

         <?php
            if($urun["urun_resmi_bir"] !== null) {?>
                 <div><div class="btn btn-success phototrigger" style="text-align: left" class="btn btn-success">1-ci şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled value="<?=$urun["urun_resmi_bir"]?>" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 1:</div>
                 <div class="photo photoOwn"><input name="goodphotoFirst" type="file"></div> 
            <?php
            } else {?>
             <div>Məhsul Rəsmi 1:</div>
             <div class="photo"><input name="goodphotoFirst" type="file"></div> 
            <?php
            }
         ?>
       <?php
            if($urun["urun_resmi_iki"] !== null) {?>
                 <div><div  class="btn btn-success phototrigger">2-ci şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled value="<?=$urun["urun_resmi_iki"]?>" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 2:</div>
                 <div class="photo photoOwn"><input name="goodphotoSecond" type="file"></div>
            <?php
            } else {?>
              <div>Məhsul Rəsmi 2:</div>
              <div class="photo"><input name="goodphotoSecond" type="file"></div>
            <?php
            }
         ?>
      <?php
            if($urun["urun_resmi_uc"] !== null) {?>
                 <div><div  class="btn btn-success phototrigger">3-cü şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled value="<?=$urun["urun_resmi_uc"]?>" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 3:</div>
                 <div class="photo photoOwn"><input name="goodphotoThird" type="file"></div>   
            <?php
            } else {?>
                <div>Məhsul Rəsmi 3:</div>
                <div class="photo"><input name="goodphotoThird" type="file"></div>   
            <?php
            }
         ?>
      <?php
            if($urun["urun_resmi_dord"] !== null) {?>
                 <div><div class="btn btn-success phototrigger">4-cü şəkli dəyiş</div></div>
                 <div><input class="photoHiddenInput" disabled  value="<?=$urun["urun_resmi_dord"]?>" type="text"></div>
                 <div class="photoTitle">Məhsul Rəsmi 4:</div>
                 <div class="photo photoOwn"><input name="goodphotoFourth" type="file"></div> 
            <?php
            } else {?>
             <div>Məhsul Rəsmi 4:</div>
             <div class="photo"><input name="goodphotoFourth"  type="file"></div> 
            <?php
            }
         ?>


         
         
    
        
      </div>
  
      <div class="variants guncelleVariant">
            <?php
               foreach($variantlar as $key => $variant) {
                  
                  if($key + 1 == 1) {
                     $extend = "ci";
                  } else if($key + 1 == 2) {
                     $extend = "ci";
                  } else if($key + 1 == 3) {
                     $extend = "cü";
                  } else if($key + 1 == 4) {
                     $extend = "cü";
                  } else if($key + 1 == 5) {
                     $extend = "ci";
                  } else if($key + 1 == 6) {
                     $extend = "cı";
                  } else if($key + 1 == 7) {
                     $extend = "ci";
                  } else if($key + 1 == 8) {
                     $extend = "ci";
                  } else if($key + 1 == 9) {
                     $extend = "cu";
                  }
                  ?>
                  <div class="variant__wrapper">
                        <div><?=$key+1?>-<?=$extend?> ayaqqabı ölçüsü: </div>
                        <div><input value="<?=$variant["variantAdi"]?>" name="variant[]" type="text"></div>
                        <div>1-ci ölçü üçün stok ədədi: </div>
                        <div><input value="<?=$variant["stokAdedi"]?>" name="stok[]" type="text"></div>
                  </div>
                  <?php
               };
            ?>
    
      </div>
      <div class="add__good__variants">
               +
      </div>
      <button class="btn btn-success">Məhsulu Yenilə</button>
   </form>
</div>