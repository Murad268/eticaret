<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_POST["kargoname"])) {
      $kargoname = $_POST["kargoname"];
   } else {
      $kargoname = "";
   }

  




   if(($kargoname == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=15");
      exit();
   } else {
         if(($_FILES["kargologo"]["tmp_name"]) and ($_FILES["kargologo"]["name"]) and ($_FILES["kargologo"]["type"]) and ($_FILES["kargologo"]["error"] == 0) and ($_FILES["kargologo"]["size"] > 0)) {
            $extention = explode("/", $_FILES["kargologo"]["type"])[1];
            $name = $_FILES["kargologo"]["name"].rand();
            $allName = $name.".".$extention;
            move_uploaded_file($_FILES["kargologo"]["tmp_name"], "../assets/images/".$allName);
            unset($_SESSION["logomess"]);
         } else {
            $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=15");
         }
      $kargoablariniSorgula = $db->prepare("INSERT INTO kargo (ad, logo) VALUES(?, ?)");
      $kargoablariniSorgula->execute([$kargoname, $allName]);
   }
   $kargoablariniSorgulaSayi = $kargoablariniSorgula->rowCount();
   if($kargoablariniSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=11");
      exit();
   } else {
      $_SESSION["adminmess"] = "Məlumatların yazılması zamanı xəta.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=15");
      exit();
   }
?>