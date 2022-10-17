<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   if(isset($_POST["var"])) {
      $odemeSecimi = $_POST["var"];
   } else {
      $odemeSecimi = "";
   }

 


   if($odemeSecimi!="") {
      if($odemeSecimi == "bankahevalesi") {
         
         $sepetiSorgula = $db->prepare("SELECT * FROM sepet WHERE uyeId = $id");
         $sepetiSorgula->execute();
         $sepetiSorgulaCount=$sepetiSorgula->rowCount();
        
     
         if($sepetiSorgulaCount>0) {
            $toplamMalKargosu = 0;
            while($mallar = $sepetiSorgula->fetch(PDO::FETCH_ASSOC)) {
      
               
               $odemeSecimiElaveEt = $db->prepare("UPDATE sepet SET odemeSecimi=? WHERE uyeId=?");
               $odemeSecimiElaveEt->execute([$odemeSecimi, $id]);
               $urunleriSorgula = $db->prepare("SELECT * FROM goods WHERE id=?");
               $urunleriSorgula->execute([$mallar["urunId"]]);
               $urunler = $urunleriSorgula->fetch(PDO::FETCH_ASSOC);
               $variantlariSorgula=$db->prepare("SELECT * FROM urunvariantlari WHERE id=?");
               $variantlariSorgula->execute([$mallar["variantId"]]);
               $variantlar = $variantlariSorgula->fetch(PDO::FETCH_ASSOC);
               $kargonuSorgula = $db->prepare("SELECT * FROM kargo WHERE id=?");
               $kargonuSorgula->execute([$mallar["kargoId"]]);
               $kargo = $kargonuSorgula->fetch(PDO::FETCH_ASSOC);
               $adresleriSorgula = $db->prepare("SELECT * FROM adresler WHERE id=? AND userId=?");
               $adresleriSorgula->execute([$mallar["adresId"], $id]);
               $adresler = $adresleriSorgula->fetch(PDO::FETCH_ASSOC);  
            

               $sifarisNumarasi = $mallar["sepetNumarasi"];
               $urunİd = $mallar["urunId"];
               $urunAdi  = $urunler["urun_adi"];
               $urunFiyati = $urunler["urun_fiyati"];
               $paraBirimi = $urunler["para_birimi"];
               $urun_aciklamasi = $urunler["urun_aciklamasi"];
               $urunResmiBir = $urunler["urun_resmi_bir"];
               $variantBasligi = $urunler["variantBasligi"];
               $variantSecimi = $variantlar["variantAdi"];
               $kargoUcreti = $urunler["kargoUcreti"];
               $kdvOrani = $urunler["KDVOrani"];
               $kargoFirmasiSecimi = $kargo["ad"];
               $adresAdiSoyadi = $adresler["adSoyad"];
               $adresDetay = $adresler["adres"];
               $adresTelefon = $adresler["telefonNumarasi"];
               $odemeSecimi = "banka hevalesi";
               $siparishTarihi = $unix;
               $siparisİp = $ip;
               $uyeİd = $id;
               $toplamUrunAdedi=$mallar["urunAdedi"];
               $toplamUrunFiyati=($urunFiyati*$toplamUrunAdedi) + (($urunFiyati*$toplamUrunAdedi) *$kdvOrani/100);
               $urunTuru = $urunler["urunTuru"];
               $toplamMalKargosu += $kargoUcreti*$toplamUrunAdedi;
               if($toplamMalKargosu>$kargoBaraji) {
                  $kargoUcreti=0;
               }
               $siparislereElaveEt = $db->prepare("INSERT INTO siparisler (sifarisNumarasi, urunİd, urunAdi, urunFiyati, paraBirimi, urunResmiBir, variantBasligi, variantSecimi, kargoUcreti, kdvOrani, kargoFirmasiSecimi, adresAdiSoyadi, adresDetay, adresTelefon, odemeSecimi, siparishTarihi, siparisİp, uyeİd, toplamUrunAdedi, toplamUrunFiyati, urunTuru) VALUES(?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
               $siparislereElaveEt->execute([$sifarisNumarasi, $urunİd, $urunAdi, $urunFiyati, $paraBirimi, $urunResmiBir, $variantBasligi, $variantSecimi, $kargoUcreti, $kdvOrani, $kargoFirmasiSecimi, $adresAdiSoyadi, $adresDetay, $adresTelefon, $odemeSecimi, $siparishTarihi, $siparisİp, $uyeİd, $toplamUrunAdedi, $toplamUrunFiyati, $urunTuru]);
               $siparislereElaveEtSay = $siparislereElaveEt->rowCount();
          
               if($siparislereElaveEtSay>0) {
                  $sepetiBosalt = $db->prepare("DELETE FROM sepet WHERE uyeId=? AND sepetNumarasi=?");
                  $sepetiBosalt->execute([$id, $sifarisNumarasi]);
                  $sepetBolsaltCount = $sepetiBosalt->rowCount();
                
               }
            }
            header("Location: alisverissepetibankahavalesiileodemetamam");
            exit();
         } else {
            header("Location: index.php");
            exit();
         }
      } else {
         if(isset($_POST["taksit"])) {
            $taksit = $_POST["taksit"];
         } else {
            $taksit = "";
         }
 
         if($taksit == "") {
            header("Location: index.php");
            exit();
         }
         $sepetiSorgula = $db->prepare("SELECT * FROM sepet WHERE uyeId = $id");
         $sepetiSorgula->execute();
         $sepetiSorgulaCount=$sepetiSorgula->rowCount();
         $sepet = $sepetiSorgula->fetchAll(PDO::FETCH_ASSOC);
         if($sepetiSorgulaCount>0) {
            $toplamMalKargosu = 0;
            foreach($sepet as $mallar) {
           
               $odemeSecimiElaveEt = $db->prepare("UPDATE sepet SET odemeSecimi=? WHERE uyeId=?");
               $odemeSecimiElaveEt->execute([$odemeSecimi, $id]);
               $urunleriSorgula = $db->prepare("SELECT * FROM goods WHERE id=?");
               $urunleriSorgula->execute([$mallar["urunId"]]);
               $urunler = $urunleriSorgula->fetch(PDO::FETCH_ASSOC);
               $variantlariSorgula=$db->prepare("SELECT * FROM urunvariantlari WHERE id=?");
               $variantlariSorgula->execute([$mallar["variantId"]]);
               $variantlar = $variantlariSorgula->fetch(PDO::FETCH_ASSOC);
               $kargonuSorgula = $db->prepare("SELECT * FROM kargo WHERE id=?");
               $kargonuSorgula->execute([$mallar["kargoId"]]);
               $kargo = $kargonuSorgula->fetch(PDO::FETCH_ASSOC);
               $adresleriSorgula = $db->prepare("SELECT * FROM adresler WHERE id=? AND userId=?");
               $adresleriSorgula->execute([$mallar["adresId"], $id]);
               $adresler = $adresleriSorgula->fetch(PDO::FETCH_ASSOC);  
            

               $sifarisNumarasi = $mallar["sepetNumarasi"];
               $urunİd = $mallar["urunId"];
               $urunAdi  = $urunler["urun_adi"];
               $urunFiyati = $urunler["urun_fiyati"];
               $paraBirimi = $urunler["para_birimi"];
               $urun_aciklamasi = $urunler["urun_aciklamasi"];
               $urunResmiBir = $urunler["urun_resmi_bir"];
               $variantBasligi = $urunler["variantBasligi"];
               $variantSecimi = $variantlar["variantAdi"];
               $kargoUcreti = $urunler["kargoUcreti"];
               $kdvOrani = $urunler["KDVOrani"];
               $kargoFirmasiSecimi = $kargo["ad"];
               $adresAdiSoyadi = $adresler["adSoyad"];
               $adresDetay = $adresler["adres"];
               $adresTelefon = $adresler["telefonNumarasi"];
               $odemeSecimi = "Kredi Kartı";
               $siparishTarihi = $unix;
               $siparisİp = $ip;
               $uyeİd = $id;
               $toplamUrunAdedi=$mallar["urunAdedi"];
               $toplamUrunFiyati=($urunFiyati*$toplamUrunAdedi) + (($urunFiyati*$toplamUrunAdedi) * $kdvOrani/100);
               $urunTuru = $urunler["urunTuru"];
               $toplamMalKargosu += $kargoUcreti*$toplamUrunAdedi;
               if($toplamMalKargosu>$kargoBaraji) {
                  $kargoUcreti=0;
               }
               $siparislereElaveEt = $db->prepare("INSERT INTO siparisler (sifarisNumarasi, urunİd, urunAdi, urunFiyati, paraBirimi, urunResmiBir, variantBasligi, variantSecimi, kargoUcreti, kdvOrani, kargoFirmasiSecimi, adresAdiSoyadi, adresDetay, adresTelefon, odemeSecimi, siparishTarihi, siparisİp, uyeİd, toplamUrunAdedi, toplamUrunFiyati, urunTuru, taksit) VALUES(?, ?, ?, ?, ?, ?, ?, ? , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
               $siparislereElaveEt->execute([$sifarisNumarasi, $urunİd, $urunAdi, $urunFiyati, $paraBirimi, $urunResmiBir, $variantBasligi, $variantSecimi, $kargoUcreti, $kdvOrani, $kargoFirmasiSecimi, $adresAdiSoyadi, $adresDetay, $adresTelefon, $odemeSecimi, $siparishTarihi, $siparisİp, $uyeİd, $toplamUrunAdedi, $toplamUrunFiyati, $urunTuru, $taksit]);
               $siparislereElaveEtSay = $siparislereElaveEt->rowCount();
               if($siparislereElaveEtSay>0) {
            
               
               }
            }
            header("Location: odemeKartSonuc");
            exit();
         }
      }
   } else {
      header("Location: index.php");
      exit();
   }
?>