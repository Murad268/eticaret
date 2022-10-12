<?php
   if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }
   if(isset($_GET["id"])) {
      $gelenId = $_GET["id"];
   } else {
      $gelenId = "";
   }
   if(isset($_POST["menuname"])) {
      $menuname = $_POST["menuname"];
   } else {
      $menuname = "";
   }

 

   if(($menuname == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=25&id=$gelenId");
   }
   $menuSorgusu = $db->prepare("UPDATE menuler SET menuAdi = ? WHERE id = $gelenId");
   $menuSorgusu->execute([$menuname]);
   $menuSayi = $menuSorgusu->rowCount();
   if($menuSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=29");
      exit();
   } else {
      $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=31&id=$gelenId");
      exit();
   }

?>
