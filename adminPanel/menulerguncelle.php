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
       
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
     }

?>
<div class="siteayarlari">
   <div class="panel__header">
      MENYU AYARLARI
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=32&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
         $menuSorgusu = $db->prepare("SELECT * FROM menuler  WHERE id = $gelenId");
         $menuSorgusu->execute();
         $menuSayisi = $menuSorgusu->rowCount();
         $menuler = $menuSorgusu->fetchAll(PDO::FETCH_ASSOC);
      
         if($menuSayisi > 0) {
            foreach($menuler as $menu) {?>
                  <div class="siteayarlari__ayarlar">
                     <div>Malın Kategoriyası:</div>
                     <div><?=strtoupper(substr($menu["urunTuru"], 0, 1)).substr($menu["urunTuru"], 1)?> Ayakkabilari</div>
                     <div>Menyu Adı:</div>
                     <div><input name="menuname" value="<?=$menu["menuAdi"]?>" type="text"></div>
                  </div>
            <?php
            }
         } else {
            echo "site kargo sorgusu hatali";
            die();
         }
      ?>

      <button class="btn btn-success">Menyunu Yenilə</button>
   </form>
</div>