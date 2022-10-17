<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   unset($_SESSION["alert"]);
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

            
               $uadresFetch = $db->prepare("SELECT * FROM adresler WHERE id = ? ");
               $uadresFetch->execute([$_GET["id"]]);
               $uadresCount = $uadresFetch->rowCount();
               $uadres = $uadresFetch->fetch(PDO::FETCH_ASSOC);
               if($uadresCount>0) {
                  $uadresName = DonusumleriGeriDondur($uadres["adSoyad"]);
                  $uadresId = DonusumleriGeriDondur($uadres["userId"]);
                  $uadresAdres= DonusumleriGeriDondur($uadres["adres"]);
                  $uadresIlce = DonusumleriGeriDondur($uadres["ilce"]);
                  $uadresCity= DonusumleriGeriDondur($uadres["sehir"]);
                  $uadresPhone= DonusumleriGeriDondur($uadres["telefonNumarasi"]);
               }
          ?>
      <h4 class="havaleWrapper__form__title">Adresler</h4>
      <div class="havaleWrapper__form__subtitle">Aşağıdan adreslerinizi güncelleye bilirsiniz</div>
      <form method="post" action="adesYenile/<?=$_GET["id"]?>">  
            <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label">İsim Soyisim</label>
               <input type="text" value="<?=$uadresName?>" name="full_name"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">        
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Adres</label>
               <textarea style="height: 100px;"  name="adres" class="form-control" id="exampleInputPassword1"><?=$uadresAdres?></textarea>  
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">İlçe</label>
               <input  type="text" value="<?=$uadresIlce?>"   name="ilce" class="form-control" id="exampleInputPassword1">    
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Şehir</label>
               <input  type="text" value="<?=$uadresCity?>"   name="city" class="form-control" id="exampleInputPassword1">      
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Telefon Numarası</label>
               <input  type="text" value="<?=$uadresPhone?>"   name="phone" class="form-control" id="exampleInputPassword1">
            </div>
            <button class="btn btn-primary">adresi güncelle</button>
           
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