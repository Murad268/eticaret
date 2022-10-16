<?php
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=60");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }
   $kargoSilSorgusu = $db->prepare("DELETE FROM havalebildirimleri WHERE id = $gelenId");
   $kargoSilSorgusu->execute();
   $kargoSilSorgusuCount = $kargoSilSorgusu->rowCount();
   if($kargoSilSorgusuCount > 0) {
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=60");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=60");
   }
?>