<?php
     if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
     }


?>
<div class="siteayarlari">
   <div class="panel__header">
      FAQ AYARLARI
   </div>
   <form class="destekform" action="index.php?sayfaKoduDis=0&sayfaKoduIc=28" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }


         ?>
          <div class="destekupdatewrapper__item">
            <div class="destekwrapper__item__title"><input name="question"  type="text"></div>
            <div class="destekwrapper__item__desc"><textarea name="answer" id="" cols="30" rows="10"></textarea></div>
         </div>
      <button class="btn btn-success">Yeni FAQ əlavə elə</button>
   </form>
</div>