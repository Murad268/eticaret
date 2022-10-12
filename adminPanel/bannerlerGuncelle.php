<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }
     if(isset($_GET["id"]) ) {
      $gelenId = $_GET["id"];
     } else {
         $gelenId = "";
     }
     if($gelenId == "") {
       
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=12");
     }

?>
<div class="siteayarlari">
   <div class="panel__header">
      BANNLER ALANLARI AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=20&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
         if(isset($_SESSION["logomess"])) {
            $mess = $_SESSION["logomess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }

         $banerorgusu = $db->prepare("SELECT * FROM bannerler  WHERE id = $gelenId");
         $banerorgusu->execute();
         $banerSayisi = $banerorgusu->rowCount();
         $banerler = $banerorgusu->fetchAll(PDO::FETCH_ASSOC);
      
         if($banerSayisi > 0) {
            foreach($banerler as $baner) {?>
                  <div class="siteayarlari__ayarlar">
                     <div>Banner Alanı:</div>
                     <div>
                        <select name="bannerAlani" id="">
                           <option <?=$baner["bannerAlani"] == "anasahifa"?"selected":null?> value="anasayfa">Ana səhifə</option>
                           <option <?=$baner["bannerAlani"] == "menuAlti"?"selected":null?> value="menualtı">Menu Altı</option>
                           <option <?=$baner["bannerAlani"] == "urunAlti"?"selected":null?> value="urundetay">Məhsullar</option>
                        </select>
                     </div>
                     <div>Banner Şəkli:</div>
                     <div class="photo"><input name="banerimg" type="file"></div>
                     <div>Banner Adı:</div>
                     <div><input name="bannername" value="<?=$baner["bannerAdi"]?>" type="text"></div>
                  </div>
            <?php
            }
         } else {
            echo "site kargo sorgusu hatali";
            die();
         }
      ?>

      <button class="btn btn-success">Banner Bilgilərini Yenilə</button>
   </form>
</div>