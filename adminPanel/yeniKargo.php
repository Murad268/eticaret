<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      KARGO HESAP AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=16" method="post" enctype="multipart/form-data">
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
         <div>Kargo Logosu:</div>
         <div class="photo"><input name="kargologo" type="file"></div>
         <div>Kargo Adı:</div>
         <div><input name="kargoname" type="text"></div>
      </div>
      <button class="btn btn-success">Kargo Hesab Bilgisi əlavə elə</button>
   </form>
</div>