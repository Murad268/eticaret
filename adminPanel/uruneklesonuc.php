<?php

   if(!isset($_SESSION["admin"])) {
    header("Location: index.php?sayfaKoduDis=1");
    exit();
   }

   if(isset($_POST["menu"])) {
      $menu = $_POST["menu"];
   } else {
      $menu = "";
   }
   if(isset($_POST["goodname"])) {
      $goodname = $_POST["goodname"];
   } else {
      $goodname = "";
   }
   if(isset($_POST["goodprice"])) {
      $goodprice = $_POST["goodprice"];
   } else {
      $goodprice = "";
   }

   if(isset($_POST["goodcurrency"])) {
      $goodcurrency = $_POST["goodcurrency"];
   } else {
      $goodcurrency = "";
   }


   if(isset($_POST["kdv"])) {
      $kdv = $_POST["kdv"];
   } else {
      $kdv = "";
   }

   if(isset($_POST["kargo"])) {
      $kargo = $_POST["kargo"];
   } else {
      $kargo = "";
   }

   if(isset($_POST["gooddesc"])) {
      $gooddesc = $_POST["gooddesc"];
   } else {
      $gooddesc = "";
   }

 
  if($_FILES["goodphoto1"]["error"] !== 4) {
      $goodphoto1 = $_FILES["goodphoto1"];
      $photoName1 = $_FILES["goodphoto1"]["name"];
  } else {
      $goodphoto1 = null;
      $photoName1 = null;
  }
  

   if(isset($_FILES["goodphoto2"])) {
      $goodphoto2 = $_FILES["goodphoto2"];
      $photoName2 = $_FILES["goodphoto2"]["name"];
   } else {
      $goodphoto2 = null;
      $photoName2 = null;
   }

   if(isset($_FILES["goodphoto3"])) {
      $goodphoto3 = $_FILES["goodphoto3"];
      $photoName3 = $_FILES["goodphoto2"]["name"];
   } else {
      $goodphoto3 = null;
      $photoName3 = null;
   }


   if(isset($_FILES["goodphoto4"])){
      $goodphoto4 = $_FILES["goodphoto4"];
      $photoName4 = $_FILES["goodphoto2"]["name"];
   } else {
      $goodphoto4 = null;
      $photoName4 = null;
   }

   if(!empty($_POST["variant"])) {
      $variantArray = $_POST["variant"];
   } else {
      $variantArray = "";
   }

   if(!empty($_POST["stok"])) {
      $stok = $_POST["stok"];
   } else {
      $stok = "";
   }

   


   if(($goodname == "") or ($menu == "") or ($goodprice == "") or ($goodcurrency == "") or ($kdv == "") or ($kargo == "") or ($gooddesc == "") or ($goodphoto1 == null) or ($variantArray == "") or ($stok == "")) {
      $_SESSION["adminmess"] = "Hər hansısa məlumat və ya hamısı boş göndərilib";
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=49");
      exit();
   } else {
      $goodAddFetch = $db->prepare("INSERT INTO goods (urun_adi, urun_fiyati, para_birimi, urun_aciklamasi, urun_resmi_bir, urun_resmi_iki, urun_resmi_uc, urun_resmi_dord, durumu, variantBasligi, KDVOrani, urunTuru, menuId, kargoUcreti) VALUES (?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $goodAddFetch->execute([$goodname, $goodprice, $goodcurrency, $gooddesc, $photoName1, $photoName2, $photoName3, $photoName4, 1, "numara", $kdv, explode("/", $menu)[1], explode("/", $menu)[0], $kargo]);
      $goodFetchCount = $goodAddFetch->rowCount();
      $urunIcinId = $db->lastInsertId();
      switch(explode("/", $menu)[1]) {
         case "erkek":
            $klasor = "Erkek";
            $type  = "Erkek Ayakkabısı";
            break;
         case "kadin":
            $klasor = "Kadin";
            $type  = "Kadın Ayakkabısı";
            break;
         default:
            $klasor = "Cocuk";
            $type  = "Çocuk Ayakkabısı";
            break;
      }
      if($goodFetchCount > 0) {
         move_uploaded_file($goodphoto1["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName1");
         if($goodphoto2 !== null) {
            move_uploaded_file($goodphoto2["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName2");
         }
         if($goodphoto3 !== null) {
            move_uploaded_file($goodphoto3["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName3");
         }
         if($goodphoto4 !== null) {
            move_uploaded_file($goodphoto4["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName4");
         }
         $updatemenu = $db->prepare("UPDATE menuler SET urunSayisi=urunSayisi+1 WHERE id = ?");
         $updatemenu->execute([explode("/", $menu)[0]]);
         $updatedMenuCount = $updatemenu->rowCount();
         if(($variantArray !== "")) {
            foreach($variantArray as $key => $variant) {
               $menuFetch = $db->prepare("INSERT INTO urunvariantlari(urunİd, variantAdi, stokAdedi) VALUES(?, ?, ?)");
               $menuFetch->execute([$urunIcinId, $variant, $stok[$key]]);
               $menuFetchCount = $menuFetch->rowCount();
            }
         }
         if($updatedMenuCount > 0) {
            unset($_SESSION["adminmess"]);
            header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=47");
            exit();
         }
      } 
   }
?>