<div class="havaleWrapper">
   <div class="havaleWrapper__form">
      <h4 class="havaleWrapper__form__title">İletişim</h4>
      <div class="havaleWrapper__form__subtitle">Bir Sorunumuzmu var? Bizlere Her Konuda Yaza Bilirsiniz.</div>
      <form action="index.php?sayfaKodu=17" method="post">

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
               <label for="floatingTextarea2" class="form-label">Açıklama</label>
               <textarea name="text" class="form-control"  id="floatingTextarea2" style="height: 100px"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Mesajı Gönder</button>
      </form>
   </div>
   <div class="havaleWrapper__desc">
      <h4 class="havaleWrapper__form__title">Deyerlendirmeye Alınmayan Mesajlar</h4>
      <div class="havaleWrapper__form__subtitle">Geçersiz Gördüyümüz Mesajlar Aşağıdakı Şekildedir.</div>
      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/DokumanKirmiziKalemli20x20.png" alt="">
            Geçersiz Bilgi Girişi
         </div>
         <div class="havaleWrapper__desc__item__desc">
         İsim soyisim, e-mail adresi veya cep telefonu bilgileri rastgele veya geçersiz şekilde doldurmak suretiyle gönderilen mesajlar.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/UcuncuSahislar20x20.png" alt="">
            3-cü Şahıslar
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Extra Eğitim kullanıcı hesapları hakkında (Örneğin; Bilgi edinme, şifre talebi vb. gibi) herhangi bir yakını, arkadaşı vb. gibi 3. şahıslar tarafından gönderilen mesajlar.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/HedefMaviOkSiyah20x20.png" alt="">
            Reklam & Tanıtım
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Site, kurum veya kuruluşlar ile ilgili reklam veya tanıtım içeren mesajlar.
         </div>
      </div>

      <div class="havaleWrapper__desc__item">
         <div class="havaleWrapper__desc__item__title">
            <img src="assets/images/InsanlarSiyah20x20.png" alt="">
            Politika & Siyaset
         </div>
         <div class="havaleWrapper__desc__item__desc">
         Politik veya siyasi içerikli mesajlar. <br> <br>
         Yukarıda belirtilmiş olan vb. gibi konularda gönderilecek olan tüm mesajlar, içeriği her ne olursa olsun değerlendirilmeye alınmayacak olup, herhangi bir şekilde cevap dönüşü yapılmayacaktır.

         </div>
      </div>
   </div>
</div>