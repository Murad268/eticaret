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
       
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=35");
     }

?>
<div class="siteayarlari">
   <div class="panel__header">
      ADMIN PARAMETRLƏRİ
   </div>
   <form action="index.php?sayfaKoduDis=0&sayfaKoduIc=38&id=<?=$gelenId?>" method="post" enctype="multipart/form-data">
      <?php
         if(isset($_SESSION["adminmess"])) {
            $mess = $_SESSION["adminmess"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
         }
         $adminSorgusu = $db->prepare("SELECT * FROM admindadas  WHERE id = $gelenId");
         $adminSorgusu->execute();
         $adminSayi = $adminSorgusu->rowCount();
         $adminler = $adminSorgusu->fetchAll(PDO::FETCH_ASSOC);
      
         if($adminSayi > 0) {
            foreach($adminler as $admin) {?>
                  <div class="siteayarlari__ayarlar">
                     <div>Login:</div>
                     <div><input name="adminlogin" type="text" value="<?=$admin["adminAdi"]?>"></div>
                     <div>Admin Şifrəsi:</div>
                     <div><input name="adminpass" type="password" value="<?=$admin["adminSifresi"]?>" type="text"></div>
                     <div>Admin Email:</div>
                     <div><input name="adminemail"value="<?=$admin["adminEmaili"]?>" type="text"></div>
                     <div>Admin ad soyad:</div>
                     <div><input name="adminname" value="<?=$admin["adminAdSoyad"]?>" type="text"></div>
                     <div>Admin telefon:</div>
                     <div><input name="adminphone" value="<?=$admin["adminTelefon"]?>" type="text"></div>
                  </div>
            <?php
            }
         } else {
            echo "admin sorgusu hatali";
            die();
         }
      ?>

      <button class="btn btn-success">Admin Parametrlərini Yenilə</button>
   </form>
</div>