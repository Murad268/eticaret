<?php
   if(isset($_GET["email"])) {
      $gelenEmail  = $_GET["email"];
   } else {
      $gelenEmail = "";
   }

   if(isset($_GET["activationCode"])) {
      $activationCode  = $_GET["activationCode"];
   } else {
      $activationCode = "";
   }
   if(isset($_GET["newMail"])) {
      $newMail  = $_GET["newMail"];
   } else {
      $newMail = "";
   }

   if(($email !== "") and ($activationCode !== "") and ($newMail !== "")) {
      $updateFetch = $db->prepare("UPDATE users SET  email=? WHERE email=? AND activationCode = ?");
      $updateFetch->execute([$newMail, $gelenEmail,  $activationCode]);
      $affectedUsers = $updateFetch->rowCount();
      if($affectedUsers>0) {
         unset($_SESSION["userName"]);
         unset($_SESSION["email"]);
         unset($_SESSION["phone"]);
         $_SESSION["message"] = "Məlumatlar güncəlləndilər";    
         header("Location: user-enter");   
      }
   }



?>