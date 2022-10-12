<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      ADMIN PARAMETRLƏRİ
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=40" method="post" enctype="multipart/form-data">
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
            <div>Login:</div>
            <div><input name="adminlogin" type="text" "></div>
            <div>Admin Şifrəsi:</div>
            <div><input name="adminpass" type="text"></div>
            <div>Admin Email:</div>
            <div><input name="adminemail" type="text"></div>
            <div>Admin ad soyad:</div>
            <div><input name="adminname" type="text"></div>
            <div>Admin telefon:</div>
            <div><input name="adminphone" type="text"></div>
         </div>
      <button class="btn btn-success">Yeni admin əlavə elə</button>
   </form>
</div>