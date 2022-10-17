<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   $siparisleriSorgula = $db->prepare("SELECT * FROM sepet WHERE uyeId = $id");
   $siparisleriSorgula->execute();
   $siparisleriSorgulaCount = $siparisleriSorgula->rowCount();
   $siparisler = $siparisleriSorgula->fetchAll(PDO::FETCH_ASSOC);
   if($siparisleriSorgulaCount>0) {
      foreach($siparisler as $siparis) {
         $urunleriGuncelle = $db->prepare("UPDATE goods SET toplamSatisSyisi = toplamSatisSyisi+? WHERE id = ?");
         $urunleriGuncelle->execute([$siparis["urunAdedi"], $siparis["urunId"]]);
         $urunlerinGuncellemmeSayi = $urunleriGuncelle->rowCount();
         $variantlariSorgula=$db->prepare("SELECT * FROM urunvariantlari WHERE id=?");
         $variantlariSorgula->execute([$siparis["variantId"]]);
         $variantlar = $variantlariSorgula->fetch(PDO::FETCH_ASSOC);
         $variantlariSorgulat = $db->prepare("UPDATE urunvariantlari SET stokAdedi = stokAdedi-? WHERE urunİd = ? AND variantAdi=?");
         $variantlariSorgulat->execute([$siparis["urunAdedi"], $siparis["urunId"], $variantlar["variantAdi"]]);
         $variantlariSorgulateSayi = $variantlariSorgulat->rowCount();

         if($urunlerinGuncellemmeSayi>0 && $variantlariSorgulateSayi>0) {
            $sepetiBosalt = $db->prepare("DELETE FROM sepet WHERE uyeId=? AND sepetNumarasi=?");
            $sepetiBosalt->execute([$id, $siparis["sepetNumarasi"]]);
            $sepetBolsaltCount = $sepetiBosalt->rowCount();
            if($sepetBolsaltCount>0) {
               header("Location: alisveristamam");
               exit();
            } 

         }
      }
   }
?>