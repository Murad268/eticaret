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
       
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=23");
     }

?>
<div class="siteayarlari">
   <div class="panel__header">
      FAQ AYARLARI
   </div>
   <form class="destekform" action="index.php?sayfaKoduDis=0&sayfaKoduIc=26&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
         $faqSorgusu = $db->prepare("SELECT * FROM faq  WHERE id = $gelenId");
         $faqSorgusu->execute();
         $faqSorgusuSayisi = $faqSorgusu->rowCount();
         $faq = $faqSorgusu->fetchAll(PDO::FETCH_ASSOC);
      
         if($faqSorgusuSayisi > 0) {
            foreach($faq as $destek) {?>
                 <div class="destekupdatewrapper__item">
                     <div class="destekwrapper__item__title"><input name="question" value="<?=$destek["question"]?>" type="text"></div>
                     <div class="destekwrapper__item__desc"><textarea name="answer" id="" cols="30" rows="10"><?=$destek["answer"]?></textarea></div>
                  </div>
            <?php
            }
         } else {
            echo "site kargo sorgusu hatali";
            die();
         }
      ?>

      <button class="btn btn-success">FAQ mətnini Yenilə</button>
   </form>
</div>