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

   if(($question == "") or ($answer == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=25&id=$gelenId");
   }
   $faqSorgusu = $db->prepare("UPDATE faq SET question = ?, answer = ? WHERE id = $gelenId");
   $faqSorgusu->execute([$question, $answer]);
   $faqSayi = $faqSorgusu->rowCount();
   if($faqSayi>0) {
      unset($_SESSION["adminmess"]);
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=23");
      exit();
   } else {
      $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=25&id=$gelenId");
      exit();
   }

?>
