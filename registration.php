<?php
   if(isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
?>
      <div class="regWrapper">
            <h3>Qeydiyyatdan keçmək</h3>
            <form method="post" action="index.php?sayfaKodu=23">
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Ad və Soyadınız</label>
                  <input name="full_name" placeholder="ad və Soyadınızı daxil edin" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Poçt ünvanınız</label>
                  <input name="email" placeholder="poçt ünvanınızı daxile din" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               </div>
               <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Telefon nömrəsi</label>
                  <input name="phone" placeholder="telefon nömrənizi daxil edin" type="text" class="form-control" id="exampleInputPassword1">
               </div>
               <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Parol</label>
                  <input name="password" placeholder="parolunuzu daxil edin" type="password" class="form-control" id="exampleInputPassword1">
               </div>
              
              <div class="chechBox mb-3">
                  <h5>cinsiniz</h5>
                  <input type="radio" name="sex" value="erkek" id="sex1">
                  <label for="sex1">erkek</label>
                  <input type="radio" name="sex" value="kadın" id="sex2">
                  <label for="sex2">kadın</label>
                  <div class="rules">
                     <input type="checkbox" name="yes" id=""> Bütün qaydalarla razıyam. Qaydalarla tanış olmaq üçün <a target="_blank" href="uyelikSozlezmesi">Üyelik Sözleşmesi</a> mətnini oxuyun
                  </div>
              </div>
               <button type="submit" class="btn btn-primary">Qeydiyyatdan keç</button>
               <?php
                  if(isset($_SESSION["regMessage"])) {
                     $mess = $_SESSION["regMessage"];
                     echo "<div class='alert alert-danger' role='alert'>
                        $mess
                     </div>";
                  }
               ?>
            </form>
            <div class="or">Əgər hesabınız varsa, <a href="user-enter">buradan</a>  daxil olun</div>
      
         </div>