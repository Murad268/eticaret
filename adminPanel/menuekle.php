<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      MENYU AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=34" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
        

         ?>
      <div class="siteayarlari__ayarlar">
         <div>Menyu üçün malın kateqoriyası:</div>
         <div>
            <select name="menucat" id="">
               <option value="erkek">Kişi Ayaqqabısı</option>
               <option value="kadin">Qadın Ayaqqabısı</option>
               <option value="cocuk">Uşaq Ayaqqabısı</option>
            </select>
         </div>
         <div>Münyu Adı:</div>
         <div><input name="menuname" type="text"></div>
      </div>
      <button class="btn btn-success">Yeni menyu əlavə elə</button>
   </form>
</div>