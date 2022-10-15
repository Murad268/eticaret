<div class="kargolar">
   <?php
      if(!isset($_SESSION["admin"])) {
         header("Location: index.php?sayfaKoduDis=1");
         exit();
      }
      if(isset($_GET["sepet"])) {
         $gelenId = $_GET["sepet"];
      } else {
         $gelenId = "";
      }
      if($gelenId == ""){
         header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=53");
         exit();
      }
   ?>
      <div class="panel__header">
         MƏHSUL PARAMETRLƏRİ
      </div>
      <div class="addBank">
         <a href="index.php?sayfaKoduDis=0&sayfaKoduIc=54">Tamamlanan sifarişlərə geri dön</a>
      </div>
      <?php
          if(isset($_SESSION["bankDel"])) {
            $mess = $_SESSION["bankDel"];
            echo "<div class='alert alert-danger' role='alert'>
               $mess
            </div>";
          }  
      ?>
    <div class="kargolar__wrapper">
      <?php
         $siparisleriSorgula = $db -> prepare("SELECT * FROM siparisler WHERE sifarisNumarasi = ?");
         $siparisleriSorgula->execute([$gelenId]);
         $siparisSayi = $siparisleriSorgula->rowCount();
         $siparisler = $siparisleriSorgula->fetchAll(PDO::FETCH_ASSOC);
         if($siparisSayi < 0) {
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=53");
            exit();
         }
         $count = 0;
         foreach($siparisler as $siparis) {
            switch($siparis["paraBirimi"]) {
               case "USD":
                  $fiyat = ($siparis["urunFiyati"] * $dolarKuru) + (($siparis["urunFiyati"] * $dolarKuru) * $siparis["kdvOrani"] / 100);
                  break;
               case "EUR":
                  $fiyat = ($siparis["urunFiyati"] * $euroKuru) + (($siparis["urunFiyati"] * $euroKuru) * $siparis["kdvOrani"] / 100);
                  break;
               default:
                  $fiyat = ($siparis["urunFiyati"]) + ($siparis["urunFiyati"] * $siparis["kdvOrani"] / 100);
                  break;
            }
            foreach($siparisler as $siparis) {
               switch($siparis["urunTuru"]) {
                  case "erkek":
                     $klasor = "Erkek";
                     break;
                  case "kadin":
                     $klasor = "Kadin";
                     break;
                  default:
                     $klasor = "Cocuk";
                     break;
               }
            }
            if($count == 0) {?>
            <div class="main__detay">
               <div><span><b style="color: black">Ad Soyadı:&nbsp;&nbsp;&nbsp;&nbsp;</b></span><span class="sss"><?=DonusumleriGeriDondur($siparis["adresAdiSoyadi"])?></span></div>
               <div><span><b style="color: black">Telefon:&nbsp;&nbsp;&nbsp;&nbsp;</b></span><span><?=DonusumleriGeriDondur($siparis["adresTelefon"])?></span></div>
               <div><span><b style="color: black">Adres:&nbsp;&nbsp;&nbsp;&nbsp;</b></span><span><?=DonusumleriGeriDondur($siparis["adresDetay"])?></span></div>
               <div><span><b style="color: black">Kargo Göndəri Kodu:&nbsp;&nbsp;&nbsp;&nbsp;</b></span><span><?=DonusumleriGeriDondur($siparis["kargoGonderiKodu"])?></span></div>
            </div>
         <?php
           $count++;
      
            }
            
          ?>
              <div class="urunMainWrapper">
               <div class="urunMainWrapper__img">
                  <img src="../assets/images/UrunResimleri/<?=$klasor?>/<?=$siparis["urunResmiBir"]?>" alt="">
               </div>
               <div class="urunMainWrapper__desc">
                  <div class="urunMainWrapper__desc__title">Ad:</div>
                  <div class="urunMainWrapper__desc__body"><?=$siparis["urunAdi"]?></div>
                  <div class="urunMainWrapper__desc__title">Qiymət:</div>
                  <div class="urunMainWrapper__desc__body"><?=donusumleriGeriDondur(fiyatBitimlerndir($siparis["urunFiyati"]))?> TL</div>
                  <div class="urunMainWrapper__desc__title">Ödəmə:</div>
                  <div class="urunMainWrapper__desc__body"><?=$siparis["odemeSecimi"]?></div>
                  <div class="urunMainWrapper__desc__title">Taksit:</div>
                  <div class="urunMainWrapper__desc__body"><?=isset($siparis["taksit"])?$siparis["taksit"]:"0"?></div>
                  <div class="urunMainWrapper__desc__title">Ədəd:</div>
                  <div class="urunMainWrapper__desc__body"><?=$siparis["toplamUrunAdedi"]?> ədəd</div>
                  <div class="urunMainWrapper__desc__title">Tam qiymət:</div>
                  <div class="urunMainWrapper__desc__body"><?=DonusumleriGeriDondur(FiyatBitimlerndir($siparis["toplamUrunFiyati"]))?> TL</div>
                  <div class="urunMainWrapper__desc__title">Kargo Seçimi:</div>
                  <div class="urunMainWrapper__desc__body"><?=$siparis["kargoFirmasiSecimi"]?></div>
                  <div class="urunMainWrapper__desc__title">Kargo Oranı:</div>
                  <div class="urunMainWrapper__desc__body"><?=$siparis["kdvOrani"]?></div>
                  <div class="urunMainWrapper__desc__title">Kargo Qiyməti:</div>
                  <div class="urunMainWrapper__desc__body"><?=DonusumleriGeriDondur(FiyatBitimlerndir($siparis["kargoUcreti"]))?> TL</div>
               </div>
            </div>
         <?php
         }
      ?>
        
    
    
    </div>
</div>