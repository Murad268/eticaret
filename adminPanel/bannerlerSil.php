<?php
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }
   $banerSilSorgusu = $db->prepare("DELETE FROM bannerler WHERE id = $gelenId");
   $banerSilSorgusu->execute();
   $banerSilSorgusuCount = $banerSilSorgusu->rowCount();
   if($banerSilSorgusuCount > 0) {
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=17");
   }
?>