<?php
   if(!isset($_GET["sepet"]) or ($_GET["sepet"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=57");
      exit();
   } else {
      $gelenId = $_GET["sepet"];
   }
   $adminSilSorgusu = $db->prepare("DELETE FROM siparisler WHERE sifarisNumarasi = $gelenId");
   $adminSilSorgusu->execute();
   $adminSilSorgusuCount = $adminSilSorgusu->rowCount();
   if($adminSilSorgusuCount > 0) {
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=57");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=57");
   }
?>