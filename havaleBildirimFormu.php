<div class="havaleWrapper">
   <div class="havaleWrapper__form">
      <h4 class="havaleWrapper__form__title">Havale Bildirim Formu</h4>
      <div class="havaleWrapper__form__subtitle">Tamamlanmış Olan Ödeme İşlemlerinizi Aşağıdakı Formdan İletiniz</div>
      <form action="index.php?sayfaKodu=10" method="post">

            <div class="mb-3">
               <label for="exampleInputEmail1" class="form-label">İsim Soyisim (*)</label>
               <input type="text" name="full_name" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">E-Mail adresi (*)</label>
               <input type="email" required name="email" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="exampleInputPassword1" class="form-label">Telefon Numarası (*)</label>
               <input type="text" required name="phone" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
               <label for="Select" required class="form-label">Ödeme Yapılan Banka (*)</label>
               <select name="bank" id="Select" class="form-select">
                  <?php
                     $fethHavale = $db->prepare("SELECT * FROM bankahesablarımız");
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
               <label for="floatingTextarea2" class="form-label">Açıklama</label>
               <textarea name="text" class="form-control"  id="floatingTextarea2" style="height: 100px"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Bildirimi Gönder</button>

      </form>
   </div>
   <div class="havaleWrapper__desc">
      <h4 class="havaleWrapper__form__title">İşleyiş</h4>
      <div class="havaleWrapper__form__subtitle">Havale / EFT İşlemlerinin Kontrölü</div>
      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/Banka20x20.png" alt="">
            Havale / EFT İşlemli
         </div>
         <div class="havaleWrapper__desc__item__desc">
            Müşteri tarafından öncelikle banka hesaplarımız sayfasında bulunan herhangi bir hesaba ödeme işlemi gerçekleşdirilir.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/DokumanKirmiziKalemli20x20.png" alt="">
            Bildirim İşlemi
         </div>
         <div class="havaleWrapper__desc__item__desc">
            Ödeme işleminizi tamamladıktan sonra "Hevale Bildirim Formu" sayfasından müşteri yapmış olduğu ödeme için bildirim formunu doldurarak onlineolarak gönderir.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/CarklarSiyah20x20.png" alt="">
            Kontroller
         </div>
         <div class="havaleWrapper__desc__item__desc">
            "Hevale Bildirim Formu"nuz tarafımıza ulaşdığı anda ilgili departman tarafından yapmış olduğunuz hevale / EFT işlemi ilgili banka üzerinden kontrol edilir.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/InsanlarSiyah20x20.png" alt="">
            Onay / Red
         </div>
         <div class="havaleWrapper__desc__item__desc">
            Hevale bildirimi ge,erli ise, yani hesaba ödeme geçmiş ise, yönetici ilgili ödeme onayını vererek, siparişinizi teslimat birimine iletir.
         </div>
      </div>


      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/SaatEsnetikGri20x20.png" alt="">
            Sipariş Hazırlama & Teslimat
         </div>
         <div class="havaleWrapper__desc__item__desc">
            Yönetici ödeme onayından sonra sayfamız üzrinden vermiş olduğunuz sipariş en kısa sürede hazırlanarak kargoya teslim edilir və tarafınıza ulaştırılır.
         </div>
      </div>
   </div>
</div>