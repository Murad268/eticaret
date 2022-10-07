<?php
  


   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }





   if(isset($_GET["adsoyad"])) {?>
      <div class="havaleWrapper"> 
         <div class="havaleWrapper__form">
            <h4 class="havaleWrapper__form__title">Hesabım > Üyelik Bilgileri</h4>
            <div class="havaleWrapper__form__subtitle">Aşağıdan üyelik bilgilerini göre veya güncelleye bilirsiniz</div>
            <form  action="index.php?sayfaKodu=35" method="post"> 
               <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">İsim Soyisim</label>
                  <input type="text" value="<?=$userName?>" name="full_name"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <button name="nameUpdate" class="btn btn-success mt-4">Güncelle</button>           
               </div>
            </form>
         </div>
         <div class="havaleWrapper__desc">
            <h4 class="havaleWrapper__form__title">Reklam</h4>
            <div class="havaleWrapper__form__subtitle">MegaShoes.com reklamları</div>
         
            <div class="hesapReklamAlani">
               <img src="assets/images/facebook-advertising-ss-1920-800x450.webp" alt="">
            </div>   
         </div>
      </div>
  <?php }






if(isset($_GET["email"])) {?>
   <div class="havaleWrapper"> 
      <div class="havaleWrapper__form">
         <h4 class="havaleWrapper__form__title">Hesabım > Üyelik Bilgileri</h4>
         <div class="havaleWrapper__form__subtitle">Aşağıdan üyelik bilgilerini göre veya güncelleye bilirsiniz</div>
         <form  action="index.php?sayfaKodu=35" method="post"> 
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">E-Mail adresi</label>
               <input value="<?=$email?>" type="email" required name="email" class="form-control" id="exampleInputPassword1">
               <button name="emailUpdate" class="btn btn-success mt-4">Güncelle</button>         
            </div>
         </form>
      </div>
      <div class="havaleWrapper__desc">
         <h4 class="havaleWrapper__form__title">Reklam</h4>
         <div class="havaleWrapper__form__subtitle">MegaShoes.com reklamları</div>
      
         <div class="hesapReklamAlani">
            <img src="assets/images/facebook-advertising-ss-1920-800x450.webp" alt="">
         </div>   
      </div>
   </div>
<?php }







if(isset($_GET["phone"])) {?>
   <div class="havaleWrapper"> 
      <div class="havaleWrapper__form">
         <h4 class="havaleWrapper__form__title">Hesabım > Üyelik Bilgileri</h4>
         <div class="havaleWrapper__form__subtitle">Aşağıdan üyelik bilgilerini göre veya güncelleye bilirsiniz</div>
         <form  action="index.php?sayfaKodu=35" method="post"> 
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Telefon Numarası</label>
               <input type="text" value="<?=$phone?>" required name="phone" class="form-control" id="exampleInputPassword1">
               <button name="phoneUpdate" class="btn btn-success mt-4">Güncelle</button>     
            </div>
         </form>
      </div>
      <div class="havaleWrapper__desc">
         <h4 class="havaleWrapper__form__title">Reklam</h4>
         <div class="havaleWrapper__form__subtitle">MegaShoes.com reklamları</div>
         <div class="hesapReklamAlani">
            <img src="assets/images/facebook-advertising-ss-1920-800x450.webp" alt="">
         </div>   
      </div>
   </div>
<?php }





if(isset($_GET["sifre"])) {?>
   <div class="havaleWrapper"> 
      <div class="havaleWrapper__form">
         <h4 class="havaleWrapper__form__title">Hesabım > Üyelik Bilgileri</h4>
         <div class="havaleWrapper__form__subtitle">Aşağıdan üyelik bilgilerini göre veya güncelleye bilirsiniz</div>
         <form  action="index.php?sayfaKodu=35" method="post"> 
            <?php
               if(isset($_SESSION["message"])) {
                  $mess = $_SESSION["message"];
                  echo "<div class='alert alert-danger' role='alert'>
                     $mess
                  </div>";
               }
            ?>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Köhnə Şifrə</label>
               <input type="password"  name="oldPassword" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Yeni Şifre</label>
               <input type="password"  name="newPassword" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Yeni Şifreni Təkrarla</label>
               <input type="password"  name="reNewPassword" class="form-control" id="exampleInputPassword1">
            </div>
            <button name="passUpdate" class="btn btn-success mt-4">Güncelle</button>  
         </form>
      </div>
      <div class="havaleWrapper__desc">
         <h4 class="havaleWrapper__form__title">Reklam</h4>
         <div class="havaleWrapper__form__subtitle">MegaShoes.com reklamları</div>
         <div class="hesapReklamAlani">
            <img src="assets/images/facebook-advertising-ss-1920-800x450.webp" alt="">
         </div>   
      </div>
   </div>
<?php }

if(isset($_GET["sex"])) {?>
   <div class="havaleWrapper"> 
      <div class="havaleWrapper__form">
         <h4 class="havaleWrapper__form__title">Hesabım > Üyelik Bilgileri</h4>
         <div class="havaleWrapper__form__subtitle">Aşağıdan üyelik bilgilerini göre veya güncelleye bilirsiniz</div>
         <form  action="index.php?sayfaKodu=35" method="post"> 
            <div class="mb-3">
               <select style="width: 100%; height: 30px" name="sex" id="">
                  <option <?=$sex=="erkek"?"selected":null?> value="erkek">Erkek</option>
                  <option  <?=$sex=="kadın"?"selected":null?> value="kadın">Kadın</option>
               </select>       
               <button name="sexUpdate" class="btn btn-success mt-4">Güncelle</button>  
            </div>
         </form>
      </div>
      <div class="havaleWrapper__desc">
         <h4 class="havaleWrapper__form__title">Reklam</h4>
         <div class="havaleWrapper__form__subtitle">MegaShoes.com reklamları</div>
      
         <div class="hesapReklamAlani">
            <img src="assets/images/facebook-advertising-ss-1920-800x450.webp" alt="">
         </div>   
      </div>
   </div>
<?php }

exit();



?>