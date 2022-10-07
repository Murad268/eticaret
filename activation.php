<?php
   session_start(); ob_start();
   require_once("ayarlar/ayar.php");
   require_once("ayarlar/functions.php");
   $email = Guvenlik($_GET["email"]);
   $activationCode = $_GET["activationCode"];
   $activateUser = $db->prepare("UPDATE users SET status=1 WHERE email=? AND activationCode = ?");
   $activateUser->execute([$email, $activationCode]);
   $userAffect = $activateUser->rowCount();

   if($userAffect>0) {
      header("Location: index.php?sayfaKodu=25");
      // unset( $_SESSION["message"]);
      $_SESSION["message"] = "Profiliniz aktivləşdirildi";
   }  else {
      // header("Location: index.php");
   }
?>