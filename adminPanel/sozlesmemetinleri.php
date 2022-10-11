<?php
   if(!isset($_SESSION["admin"])) {
   header("Location: index.php?sayfaKoduDis=1");
   exit();
   }
?>
<div class="panel__header">
   SÖZLEŞMELER VE METİNLER
</div>
<form class="textingForm" action="index.php?sayfaKoduDis=0&sayfaKoduIc=4" method="post">
   <?php
      if(isset($_SESSION["adminmess"])) {
         $mess = $_SESSION["adminmess"];
         echo "<div class='alert alert-danger' role='alert'>
            $mess
         </div>";
      }
   ?>
   <div class="sozlesmeMetinleri">
      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">Hakkımızda Metni</div>
         <textarea name="hakkimizdaMetni" class="sozlesmeMetinleriElement__desc"><?=$hakkimizdaMetni?></textarea>
      </div>

      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">Üyelik Sözleşmesi Metni</div>
         <textarea name="uyelikSozlezmesiMetni" class="sozlesmeMetinleriElement__desc uyelikSozlezmesiMetni"><?=$UyelikSozlezmesiMetni?></textarea>
      </div>

      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">Kullanım Koşulları Metni</div>
         <textarea name="kullanimKosullariMetni" class="sozlesmeMetinleriElement__desc"><?=$kullanimKosullariMetni?></textarea>
      </div>

      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">Gizlilik Sözleşmesi Metni</div>
         <textarea name="gizlilikSozlezlesmesiMetni" class="sozlesmeMetinleriElement__desc"><?=$gizlilikSozlezlesmesiMetni?></textarea>
      </div>

      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">Mesafeli Satış Sözleşmesi Metni</div>
         <textarea name="mesafeliSatisSozlesmesiMetni" class="sozlesmeMetinleriElement__desc"><?=$mesafeliSatisSozlesmesiMetni?></textarea>
      </div>

      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">Teslimat Metni</div>
         <textarea name="teslimatMetni" class="sozlesmeMetinleriElement__desc"><?=$teslimatMetni?></textarea>
      </div>

      <div class="sozlesmeMetinleriElement">
         <div class="sozlesmeMetinleriElement__label">İptal & İade & Deyişim Metni</div>
         <textarea name="iptalIadeDeyisimMetni" class="sozlesmeMetinleriElement__desc"><?=$iptalIadeDeyisimMetni?></textarea>
      </div>
   </div>
   <button class="sozclass btn btn-success">Ayarları Kaydet</button>
</form>