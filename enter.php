<?php
   if(isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
?>
      <div class="regWrapper">
            <h3>Daxil olmaq</h3>
            <form method="post" action="index.php?sayfaKodu=26">
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Poçt ünvanınız</label>
                  <input name="email" placeholder="poçt ünvanınızı daxil edin" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
               <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Parol</label>
                  <input name="password" placeholder="parolunuzu daxil edin" type="password" class="form-control" id="exampleInputPassword1">
                  <a href="index.php?sayfaKodu=28">şifreni unutdum</a>
               </div>
              
               <button type="submit" class="btn btn-primary">Daxil ol</button>
               <?php
                  if(isset($_SESSION["message"])) {
                     $mess = $_SESSION["message"];
                     echo "<div class='alert alert-danger' role='alert'>
                        $mess
                     </div>";
                  }
               ?>
            </form>
            <div class="or">Əgər hesabınız yoxdursa, <a href="index.php?sayfaKodu=22">buradan</a>  qeydiyyatdan keçin</div>
      
         </div>