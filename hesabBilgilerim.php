<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
?>
  <hr>
      <div class="user__navbar">
         <div class="user__navbar__link"><a href="user-bilgileri">Üyelik Bilgileri</a></div>
         <div class="user__navbar__link"><a href="adresler">Adresler</a></div>
         <div class="user__navbar__link"><a href="sevimliler">Favoriler</a></div>
         <div class="user__navbar__link"><a href="sherhler">Yorumlar</a></div>
         <div class="user__navbar__link"><a href="sifarishler">Siparişler</a></div>
      </div>
   <hr>
<div class="havaleWrapper"> 
 
   <div class="havaleWrapper__form">
         <?php
            if(isset($_SESSION["message"])) {
               $mess = $_SESSION["message"];
               echo "<div class='alert alert-danger' role='alert'>
                  $mess
               </div>";
            }
          ?>
      <h4 class="havaleWrapper__form__title">Hesabım > Üyelik Bilgileri</h4>
      <div class="havaleWrapper__form__subtitle">Aşağıdan üyelik bilgilerini göre veya güncelleye bilirsiniz</div>
      <form>
             
            <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label">İsim Soyisim</label>
               <input disabled type="text" value="<?=$userName?>" name="full_name" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
               <a href="adsoyaddeyis/deyis">Ad Soyadı Güncelle</a>           
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">E-Mail adresi</label>
               <input disabled value="<?=$email?>" type="email" required name="email" class="form-control" id="exampleInputPassword1">
               <a href="email/deyis">Email adresini Güncelle</a>       
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Telefon Numarası</label>
               <input disabled type="text" value="<?=$phone?>" required name="phone" class="form-control" id="exampleInputPassword1">
               <a href="phone/deyis">Telefon Numarasını Güncelle</a>       
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Şifre</label>
               <input disabled type="password" value="<?=$password?>" required name="sifre" class="form-control" id="exampleInputPassword1">
               <a href="sifre/deyis">Şifreyi Güncelle</a>       
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Cins</label>
               <input disabled  type="text" value="<?=$sex?>" required name="ipAdresi" class="form-control" id="exampleInputPassword1">
               <a href="sex/deyis">Cinsi Güncelle</a>   
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Kayıt Tarihi</label>
               <input disabled type="text" value="<?=registrDate($registrationDate)?>" required name="regDate" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">İp Adresi</label>
               <input disabled type="text" value="<?=$ip?>" required name="ipAdresi" class="form-control" id="exampleInputPassword1">
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