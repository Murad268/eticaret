<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_POST["question"])) {
      $question = $_POST["question"];
   } else {
      $question = "";
   }

   if(isset($_POST["answer"])) {
      $answer = $_POST["answer"];
   } else {
      $answer = "";
   }




   if(($answer == "") or ($question == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=27");
      exit();
   } else {

      $destekSorgula = $db->prepare("INSERT INTO faq (question, answer, indexId) VALUES(?, ?, ?)");
      $index = "r" .(string)$unix;
      $destekSorgula->execute([$question, $answer, $index]);
   }
   $destekSorgulaSayi = $destekSorgula->rowCount();
   if($destekSorgulaSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=23");
      exit();
   } else {
      $_SESSION["adminmess"] = "Məlumatların yazılması zamanı xəta.";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=27");
      exit();
   }
?>