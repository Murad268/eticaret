
<?php
if(!isset($_SESSION["userName"])) {
   header("Location: index.php");
   
}
if(isset($_GET["id"])) {
   $gelenUrunId = Guvenlik($_GET["id"]);
} else {
   $gelenUrunId = "";
}
if($gelenUrunId == "") {
   $_SESSION["message"] = "Error. Məhsulun idsinin yüklənməsində səhvlik baş verdi;";
} else {
   unset($_SESSION["message"]);
}
?>
<div class="havaleWrapper">
   <div class="havaleWrapper__form">
      <h4 class="havaleWrapper__form__title">Yorum</h4>
      <div class="havaleWrapper__form__subtitle">Sipariş etdiyiniz ürün hakkında aşağıda yorum yapa bilrsiniz</div>
      <form action="index.php?sayfaKodu=46&gelenUrunId=<?=$gelenUrunId?>" method="post">
                <?php
                  if(isset($_SESSION["message"])) {
                     $mess = $_SESSION["message"];
                     echo "<div class='alert alert-danger' role='alert'>
                        $mess
                     </div>";
                  }
               ?>
               <div class="container d-flex justify-content-center mt-200">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="stars">
                           <input value="5" class="star star-5" id="star-5" type="radio" name="star"/>
                           <label class="star star-5" for="star-5"></label>
                           <input value="4" class="star star-4" id="star-4" type="radio" name="star"/>
                           <label class="star star-4" for="star-4"></label>
                           <input value="3" class="star star-3" id="star-3" type="radio" name="star"/>
                           <label class="star star-3" for="star-3"></label>
                           <input value="2" class="star star-2" id="star-2" type="radio" name="star"/>
                           <label class="star star-2" for="star-2"></label>
                           <input value="1" class="star star-1" id="star-1" type="radio" name="star"/>
                           <label class="star star-1" for="star-1"></label>
                        </div>
                     </div>
                  </div>
               </div>
            <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label">Yorum metni</label>
               <textarea style="height: 265px;" name="yorum"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
            </div>
          
            <button type="submit" class="btn btn-success">Yorumu Gönder</button>

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