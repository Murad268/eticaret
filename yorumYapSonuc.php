<?php
   $gelenId = $_GET["gelenUrunId"];
   $puan = $_POST["star"];
   $yorum = $_POST["yorum"];


   $yorumKayitSorgusu = $db->prepare("INSERT INTO yorumlar(urunId, uyeId, puan, yorumMetni, 	yorumTarihi, yorumIoAdresi) values(?,?,?,?,?,?)");
   $yorumKayitSorgusu->execute([$gelenId, $id, $puan, $yorum, $unix, $ipAdresi]);
   $yorumKayitKontrol=$yorumKayitSorgusu->rowCount();
   if($yorumKayitKontrol>0) {
      $urunGuncellemeSorgusu = $db->prepare("UPDATE goods SET yorumSayisi=yorumSayisi+1, toplamYorumPuani=toplamYorumPuani+$puan WHERE id=$gelenId LIMIT 1");
      $urunGuncellemeSorgusu->execute();
      $urunGuncellemeSorgusuKontrol=$urunGuncellemeSorgusu->rowCount();
      if($urunGuncellemeSorgusuKontrol>0) {
         header("Location: index.php?sayfaKodu=39");
         exit();
      }
   }
?>