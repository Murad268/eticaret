<?php
 
  if(isset($_SESSION["message"])) {
     $mess = $_SESSION["message"];
     echo "<div class='alert alert-danger' role='alert'>
        $mess
     </div>";
  }

   if(isset($_GET["email"])) {
      $email =Guvenlik($_GET["email"]);
   } else {
      $email = "";
   }

   if(isset($_GET["activationCode"])) {
      $activationCode = Guvenlik($_GET["activationCode"]);
   } else {
      $activationCode = "";
   }

   if(($mail != "") and ($activationCode != "") ) {
      $controllFetch = $db->prepare("SELECT * FROM users WHERE email = ? AND activationCode = ?");
      $controllFetch->execute([$email, $activationCode]);
      $usersCount = $controllFetch->rowCount();
      $users = $controllFetch->fetch(PDO::FETCH_ASSOC);
      unset($_SESSION["message"]);
   } else {
      header("Location: index.php");
   }

   if($usersCount > 0) {?>
      <div class="regWrapper">
            <h3>Yeni şifreyi dahil et</h3>
            <form method="post" action="index.php?sayfaKodu=31&email=<?=$email?>&activationCode=<?=$activationCode?>">
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Şifre</label>
                  <input name="pass" placeholder="yeni şifreni daxil edin" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Şifreni tekrar edin</label>
                  <input name="rePass" placeholder="yeni şifreni tekrar edin" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
               
               <button type="submit" class="btn btn-primary">Şifreyi deyiş</button>
         
            </form>
          

      </div>
<?php } else {
   header("Location: index.php");
}

?>

