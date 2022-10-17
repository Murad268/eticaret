
<?php
 
   if(isset($_POST["pass"])) {
      $pass = Guvenlik($_POST["pass"]);
   } else {
      $pass = "";
   }


   if(isset($_POST["rePass"])) {
      $rePass = Guvenlik($_POST["rePass"]);
   } else {
      $rePass = "";
   }

   $email = Guvenlik($_GET["email"]);
   $activationCode = Guvenlik($_GET["activationCode"]);
   if(($pass !== "") or ($rePass !== "")) {
      if($pass == $rePass) {
         $hash = md5($pass);
         $changePassFetch = $db->prepare("UPDATE users SET sifre = ? WHERE email = ? AND activationCode = ?");
         $changePassFetch->execute([$hash, $email, $activationCode]);
         $kayit = $changePassFetch->rowCount();
         echo $email;
         echo $activationCode;
         if($kayit>0) {
            $_SESSION["message"] = "Şifre dəyişdirildi.";
            header("Location: user-enter");
         }
      } else {
         $_SESSION["message"] = "Şifrələr üst-üstə düşmürlər";
         header("Location: index.php?sayfaKodu=30&email=$email&activationCode=$activationCode");
      }
   } else {
      $_SESSION["message"] = "Boş bölmə gönderilib. Xahiş edirik, bütün bölmələri doldurun";
      header("Location: index.php?sayfaKodu=30&email=$email&activationCode=$activationCode");
   }
?>