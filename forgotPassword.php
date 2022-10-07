
<div class="regWrapper">
      <h3>Şifrəni dəyişmək</h3>
      <form method="post" action="index.php?sayfaKodu=29">
         <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Poçt ünvanınız və ya Telefonunuz</label>
            <input name="phoneOrEmail" placeholder="poçt ünvanınızı daxile din" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
         </div>
         <button type="submit" class="btn btn-primary">Şifrəni deəyişmək üçün bildiriş göndər</button>
         <?php
            if(isset($_SESSION["message"])) {
               $mess = $_SESSION["message"];
               echo "<div class='alert alert-danger' role='alert'>
                  $mess
               </div>";
            }
         ?>
      </form>


   </div>