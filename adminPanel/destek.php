<div class="destekwrapper">
<?php
   if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }

?>
   <div class="panel__header">
      FAQ AYARLARI
   </div>
   <div class="addBank">
      <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=27">yeni FAQ əlavə elə</a>
   </div>
   <?php
         if(isset($_SESSION["bankDel"])) {
         $mess = $_SESSION["bankDel"];
         echo "<div class='alert alert-danger' role='alert'>
            $mess
         </div>";
         }  
   ?>
   <?php
      $sorgula = $db->prepare("SELECT * FROM faq");
      $sorgula->execute();
      $sorgulaCount = $sorgula->rowCount();
      $faq = $sorgula->fetchAll(PDO::FETCH_ASSOC);
      if($sorgulaCount>0) {
         foreach($faq as $key => $destek) {?>
         <div class="destekwrapper__item">
            <div class="destekwrapper__item__title"><?=$key+1?>. <?=$destek["question"]?></div>
            <div class="destekwrapper__item__desc"><?=$destek["answer"]?></div>
            <div class="destekwrapper__item__controlls">
               <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=24&id=<?=$destek["id"]?>"><span><img src="../assets/images/Sil20x20.png" alt="">Sil</span></a>
               <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=25&id=<?=$destek["id"]?>"><span><img src="../assets/images/Guncelleme20x20.png" alt="">Yenilə</span></a>
            </div>
         </div>
        <?php
         }
      }
   ?>
   
</div>