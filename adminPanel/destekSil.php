<?php
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=23");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }
   $destekSilSorgusu = $db->prepare("DELETE FROM faq WHERE id = $gelenId");
   $destekSilSorgusu->execute();
   $destekSilSorgusuCount = $destekSilSorgusu->rowCount();
   if($destekSilSorgusuCount > 0) {
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=23");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=23");
   }
?>