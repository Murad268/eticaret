<?php
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=35");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }
   $adminSilSorgusu = $db->prepare("DELETE FROM admindadas WHERE id = $gelenId");
   $adminSilSorgusu->execute();
   $adminSilSorgusuCount = $adminSilSorgusu->rowCount();
   if($adminSilSorgusuCount > 0) {
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=35");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=35");
   }
?>