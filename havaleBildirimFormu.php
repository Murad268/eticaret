<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: user-enter");
   }
?>
<div class="havaleWrapper">
   <div class="havaleWrapper__form">
      <h4 class="havaleWrapper__form__title">Köçürmə bildiriş forması</h4>
      <div class="havaleWrapper__form__subtitle">Tamamlanmış Ödəniş Əməliyyatlarınızı Aşağıdakı Formadan Göndərin</div>
      <form action="index.php?sayfaKodu=10" method="post">

            <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label">Ad Soyad (*)</label>
               <input type="text" name="full_name" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">E-Mail adresi (*)</label>
               <input type="email" required name="email" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Telefon Nömrəsi (*)</label>
               <input type="text" required name="phone" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="Select" required class="form-label">Ödeme Edilən Bank (*)</label>
               <select name="bank" id="Select" class="form-select">
                  <?php
                     $fethHavale = $db->prepare("SELECT * FROM bankahesablarimiz");
                     $fethHavale->execute();
                     $bankHevaleCount = $fethHavale->rowCount();
                     $hevaleBanks = $fethHavale->fetchAll(PDO::FETCH_ASSOC);
                     if($bankHevaleCount > 0) {
                        foreach($hevaleBanks as $bank) {?>
                           <option value="<?=$bank["id"]?>"><?=donusumleriGeriDondur($bank["bankaAdı"])?></option>
                     <?php  }
                     }  
                  ?>
               </select>
            </div>
            <div class="mb-3">
               <label for="floatingTextarea2" class="form-label">Açıqlama</label>
               <textarea name="text" class="form-control"  id="floatingTextarea2" style="height: 100px"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Bildirişi Gönder</button>

      </form>
   </div>
   <div class="havaleWrapper__desc">
      <?php
     ?>
      <h4 class="havaleWrapper__form__title">Mexanizm</h4>
      <div class="havaleWrapper__form__subtitle">Pul köçürmələri / EFT əməliyyatlarına nəzarət</div>
      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/Banka20x20.png" alt="">
            Pul köçürmə / EFT əməliyyatı
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Müştəri əvvəlcə bank hesabları səhifəsində istənilən hesaba ödəniş edir.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/DokumanKirmiziKalemli20x20.png" alt="">
            Bildiriş Prosesi
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Müştəri ödəniş əməliyyatınızı tamamladıqdan sonra etdiyi ödəniş üçün bildiriş formasını dolduraraq “Hevale Bildiriş Formu” səhifəsindən onlayn göndərir.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/CarklarSiyah20x20.png" alt="">
            Nəzarətlər
         </div>
         <div class="havaleWrapper__desc__item__desc">
         “Köçürmə Bildiriş Formunuz bizə çatan kimi müvafiq şöbə tərəfindən etdiyiniz pul köçürmə/EFT əməliyyatı müvafiq bank vasitəsilə yoxlanılır.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/InsanlarSiyah20x20.png" alt="">
            Təsdiq / Rədd etmə
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Pul köçürmə bildirişi etibarlıdırsa, yəni hesab ödənilibsə, menecer müvafiq ödəniş təsdiqini verir və sifarişinizi çatdırılma bölməsinə yönləndirir.
         </div>
      </div>


      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/SaatEsnetikGri20x20.png" alt="">
            Sifarişin Hazırlanması və Çatdırılması
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Menecer ödənişi təsdiqlədikdən sonra səhifəmizdə yerləşdirdiyiniz sifariş ən qısa zamanda hazırlanaraq yükə çatdırılaraq sizə çatdırılacaq.
         </div>
      </div>
   </div>
</div>