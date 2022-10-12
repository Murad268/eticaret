<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
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
  




   if(($bannerAlani == "") or ($bannername == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=15");
      exit();
   } else {
         if(($_FILES["banerimg"]["tmp_name"]) and ($_FILES["banerimg"]["name"]) and ($_FILES["banerimg"]["type"]) and ($_FILES["banerimg"]["error"] == 0) and ($_FILES["banerimg"]["size"] > 0)) {
            $extention = explode("/", $_FILES["banerimg"]["type"])[1];
            $name = $_FILES["banerimg"]["name"].rand();
            $allName = $name.".".$extention;
            move_uploaded_file($_FILES["banerimg"]["tmp_name"], "../assets/images/Banner Örnekleri/".$allName);
            unset($_SESSION["logomess"]);
         } else {
            $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=21");
         }
      $bannerSorgula = $db->prepare("INSERT INTO bannerler (bannerAlani, bannerResmi, bannerAdi) VALUES(?, ?, ?)");
      $bannerSorgula->execute([$bannerAlani, $allName, $bannername]);
   }
   $bannerSorgulaSayi = $bannerSorgula->rowCount();
   if($bannerSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
      exit();
   } else {
      $_SESSION["adminmess"] = "Məlumatların yazılması zamanı xəta.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=21");
      exit();
   }
?>