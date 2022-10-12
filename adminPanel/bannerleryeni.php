<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      BANNER AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=22" method="post" enctype="multipart/form-data">
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

         ?>
      <div class="siteayarlari__ayarlar">
         <div>Banner Alanı:</div>
         <div>
            <select name="bannerAlani" id="">
               <option value="anasayfa">Ana səhifə</option>
               <option value="menualtı">Menu Altı</option>
               <option value="urundetay">Məhsullar</option>
            </select>
         </div>
         <div>Banner Şəkli:</div>
         <div class="photo"><input name="banerimg" type="file"></div>
         <div>Banner Adı:</div>
         <div><input name="bannername" type="text"></div>
      </div>
      <button class="btn btn-success">Yeni banner əlavə elə</button>
   </form>
</div>