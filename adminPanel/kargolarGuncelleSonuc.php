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
   if(isset($_POST["kargoname"])) {
      $kargoname = $_POST["kargoname"];
   } else {
      $kargoname = "";
   }



 


 

   

   if(($kargoname == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=13&id=$gelenId");
      exit();
   } else {
      $kargolariniSorgula = $db->prepare("UPDATE kargo SET ad = ? WHERE id = $gelenId");
      $kargolariniSorgula->execute([$kargoname]);
      if(!empty($_FILES["kargologo"]["error"] !== 4)) {
         $extention = explode("/", $_FILES["kargologo"]["type"])[1];
         $name = $_FILES["kargologo"]["name"].rand();
         $allName = $name.".".$extention;
         if(($_FILES["kargologo"]["tmp_name"]) and ($_FILES["kargologo"]["name"]) and ($_FILES["kargologo"]["type"]) and ($_FILES["kargologo"]["error"] == 0) and ($_FILES["kargologo"]["size"] > 0)) {
            move_uploaded_file($_FILES["kargologo"]["tmp_name"], "../assets/images/".$allName);
            $kargoLogoSorgula = $db->prepare("UPDATE kargo SET logo=? WHERE id = ?");
            $kargoLogoSorgula->execute([$allName, $gelenId]);
            $_SESSION["logomess"] = "Yalnızca şəkil yeniləndi";
         } else {
            $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
         }
      } else {
         unset($_SESSION["logomess"]);
         $_SESSION["logomess"] = "Şəklin Yüklənməyində xəta baş verdi";
      }
   }
   $kargolariniSorgulaSorgulaSayi = $kargolariniSorgula->rowCount();
   if($kargolariniSorgulaSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      unset($_SESSION["logomess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=11");
      exit();
   } else {
      $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=13&id=$gelenId");
      exit();
   }
?>