<?php


   if(isset($_GET["id"])) {
      $urunId = $_GET["id"];
   } else {
      $urunId = "";
   }
   if(isset($_POST["variant"])) {
      $urunVariant = $_POST["variant"];
   } else {
      $urunVariant = "";
   }

   if(isset($_POST["count"])) {
      $urunSayi = $_POST["count"];
   } else {
      $urunSayi = "";
      echo "a";
   }

  
   $urunuSorgula = $db->prepare("SELECT * FROM goods WHERE id = $urunId LIMIT 1");
   $urunuSorgula->execute();
   $urun = $urunuSorgula->fetch(PDO::FETCH_ASSOC);

   $urunAdi = $urun["urun_adi"];
   if($urun["urunTuru"] == "erkek") {
      $backLink = "kishi-ayakkabisi";
   } else if($urun["urunTuru"] == "kadin") {
      $backLink = "qadin-ayakkabisi";
   } if($urun["urunTuru"] == "cocuk") {
      $backLink = "ushaq-ayakkabisi";
   }

   if(($urunId !== "") or ($urunVariant !== "") or ($urunSayi !== "")) {
      $slotYoxla = $db->prepare("SELECT * FROM urunvariantlari WHERE id = ?");
      $slotYoxla->execute([$urunVariant]);
      $slotCount = $slotYoxla->rowCount();
      $slot=$slotYoxla->fetch(PDO::FETCH_ASSOC);
     
      if($urunSayi>$slot["stokAdedi"]) {
         $_SESSION["goodDetailsMess"] = "Hazırda stokda bu məhsuldan istədiyiniz sayda yoxdur";
         header("Location: $backLink/$urunAdi/$urunId");
         exit();
      }

      
      $checkCart = $db->prepare("SELECT * FROM sepet WHERE uyeId=? AND urunId=? AND variantId=? ");
      $checkCart->execute([$id, $urunId, $urunVariant]);
      $checkCartCount = $checkCart->rowCount();
      if($checkCartCount>0) {
         $addSay = $db->prepare("UPDATE sepet SET urunAdedi=urunAdedi+? WHERE uyeId=? AND urunId=? AND variantId=?");
         $addSay->execute([$urunSayi, $id, $urunId, $urunVariant]);
         unset($_SESSION["addFav"]);
         $_SESSION["goodDetailsMess"] = "Səbətdə bu məhsulun sayı artırıldı.";
         header("Location: $backLink/$urunAdi/$urunId");
         exit();
      } else {
         $addCart = $db->prepare("INSERT INTO sepet (sepetNumarasi, uyeId, urunId, variantId, urunAdedi) values (?, ?, ?, ?, ?)");
         $addCart->execute([$unix, $id, $urunId, $urunVariant, $urunSayi]);
         $sepetNum = $db->prepare("UPDATE sepet SET sepetNumarasi=? WHERE uyeId =?");
         $sepetNum->execute([$unix, $id]);
         $addCartCount = $addCart->rowCount();
         if($addCartCount>0) {
            $_SESSION["goodDetailsMess"] = "Məhsul səbətə əlavə edildi.";
            unset($_SESSION["addFav"]);
            header("Location: $backLink/$urunAdi/$urunId");
            exit();
         }
      }
     
   } else {
      header("Location: index.php");
      exit();
   }
?>