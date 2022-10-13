<?php

   if(isset($_SESSION["admin"])) {
      header("Location: index.php?disSayfaKodu=0");
   } else {
      if(isset($_POST["username"])) {
         $adminLogin = $_POST["username"];
      } else {
         $adminLogin = "";
      }
   
      if(isset($_POST["pass"])) {
         $pass = $_POST["pass"];
      } else {
         $pass = "";
      }

      if(($adminLogin !== "") && ($pass !== "")) {
         $adminFetch = $db->prepare("SELECT * FROM admindadas WHERE adminAdi = ? AND adminSifresi=?");
         $hash = md5($pass);
         $adminFetch->EXECUTE([$adminLogin, $hash]);
         $adminFetchCount = $adminFetch->rowCount();
         if($adminFetchCount>0) {
            unset($_SESSION["admmess"]);
            $_SESSION["admin"] = $adminLogin;
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=0");
         } else {
            $_SESSION["admmess"] = "belə bir admin mövcud deyil";
            header("Location: index.php?disSayfaKodu=1");
         }
      } else {
         $_SESSION["admmess"] = "boş dəyərlər daxil edilmişdir";
         header("Location: index.php?disSayfaKodu=1");
         exit();
      }
   }

?>