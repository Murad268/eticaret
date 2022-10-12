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
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=13&id=$gelenId");
     }

      if(isset($_POST["bannerAlani"])) {
         $bannerAlani = $_POST["bannerAlani"];
      } else {
         $bannerAlani = "";
      }
      if(isset($_POST["bannername"])) {
         $bannername = $_POST["bannername"];
      } else {
         $bannername = "";
      }


 


 

   

   if(($bannername == "") or ($bannerAlani == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=19&id=$gelenId");
      exit();
   } else {
      $bannerSorgula = $db->prepare("UPDATE bannerler SET bannerAlani = ?, bannerAdi = ?  WHERE id = $gelenId");
      $bannerSorgula->execute([$bannerAlani, $bannername]);
      if(!empty($_FILES["banerimg"]["error"] !== 4)) {
         $extention = explode("/", $_FILES["banerimg"]["type"])[1];
         $name = $_FILES["banerimg"]["name"].rand();
         $allName = $name.".".$extention;
         if(($_FILES["banerimg"]["tmp_name"]) and ($_FILES["banerimg"]["name"]) and ($_FILES["banerimg"]["type"]) and ($_FILES["banerimg"]["error"] == 0) and ($_FILES["banerimg"]["size"] > 0)) {
            move_uploaded_file($_FILES["banerimg"]["tmp_name"], "../assets/images/Banner Örnekleri/".$allName);
            $bannerLogoSorgula = $db->prepare("UPDATE bannerler SET bannerResmi=? WHERE id = ?");
            $bannerLogoSorgula->execute([$allName, $gelenId]);
            $_SESSION["logomess"] = "Yalnızca şəkil yeniləndi";
         } else {
            $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
         }
      } else {
         unset($_SESSION["logomess"]);
         $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
      }
   }
   $bannerSorgulaSayi = $bannerSorgula->rowCount();
   if($bannerSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      unset($_SESSION["logomess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
      exit();
   } else {
      $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=19&id=$gelenId");
      exit();
   }
?>