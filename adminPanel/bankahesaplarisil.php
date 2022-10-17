<?php
   if(!isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=1");
      exit();
   }
   if(!isset($_GET["id"]) or ($_GET["id"] == "")) {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=5");
      exit();
   } else {
      $gelenId = $_GET["id"];
   }
   $bankaSilSorgusu = $db->prepare("DELETE FROM bankahesablarimiz WHERE id = $gelenId");
   $bankaSilSorgusu->execute();
   $bankaSilSorgusuCount = $bankaSilSorgusu->rowCount();
   if($bankaSilSorgusuCount > 0) {
      unset($_SESSION["bankDel"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=5");
      exit();
   } else {
      $_SESSION["bankDel"] = "Silinmə zamanı xəta baş verdi.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=5");
   }
?>