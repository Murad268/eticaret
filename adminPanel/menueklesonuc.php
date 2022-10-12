<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_POST["menucat"])) {
      $menucat = $_POST["menucat"];
   } else {
      $menucat = "";
   }
   if(isset($_POST["menuname"])) {
      $menuname = $_POST["menuname"];
   } else {
      $menuname = "";
   }
  




   if(($menuname == "") or ($menucat == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=33");
      exit();
   } else {
      $menuSorgula = $db->prepare("INSERT INTO menuler (urunTuru, menuAdi) VALUES(?, ?)");
      $menuSorgula->execute([$menucat, $menuname]);
   }
   $menuSorgulaSayi = $menuSorgula->rowCount();
   if($menuSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
      exit();
   } else {
      $_SESSION["adminmess"] = "Məlumatların yazılması zamanı xəta.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=33");
      exit();
   }
?>