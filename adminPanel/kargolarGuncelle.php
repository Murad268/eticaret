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
       
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=11");
     }

?>
<div class="siteayarlari">
   <div class="panel__header">
      KARGO HESAP AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=14&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
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

         $kargoSorgusu = $db->prepare("SELECT * FROM kargo  WHERE id = $gelenId");
         $kargoSorgusu->execute();
         $kargoSayisi = $kargoSorgusu->rowCount();
         $kargolar = $kargoSorgusu->fetchAll(PDO::FETCH_ASSOC);
      
         if($kargoSayisi > 0) {
            foreach($kargolar as $kargo) {?>
                  <div class="siteayarlari__ayarlar">
                     <div>Kargo Logosu:</div>
                     <div class="photo"><input name="kargologo" type="file"></div>
                     <div>Kargo Adı:</div>
                     <div><input name="kargoname" value="<?=$kargo["ad"]?>" type="text"></div>
                  </div>
            <?php
            }
         } else {
            echo "site kargo sorgusu hatali";
            die();
         }
      ?>

      <button class="btn btn-success">Kargo Hesab Bilgilərini Yenilə</button>
   </form>
</div>