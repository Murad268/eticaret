<?php

if(!isset($_SESSION["admin"])) {
   header("Location: index.php?sayfaKoduDis=1");
   exit();
}
if(isset($_GET["id"]) ) {
   $gelenId = $_GET["id"];
} else {
   $gelenId = "";
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


if($_FILES["goodphotoFirst"]["error"] !== 4) {
   $goodphotoFirst = $_FILES["goodphotoFirst"];
   $photoName1 = $_FILES["goodphotoFirst"]["name"];
} else {
   $goodphotoFirst = null;
   $photoName1 = null;
}

if($_FILES["goodphotoSecond"]["error"] !== 4) {
   $goodphotoSecond = $_FILES["goodphotoSecond"];
   $photoName2 = $_FILES["goodphotoSecond"]["name"];
} else {
   $goodphotoSecond = null;
   $photoName2 = null;
}

if($_FILES["goodphotoThird"]["error"] !== 4) {
   $goodphotoThird = $_FILES["goodphotoThird"];
   $photoName3 = $_FILES["goodphotoThird"]["name"];
} else {
   $goodphotoThird = null;
   $photoName3 = null;
}

if($_FILES["goodphotoFourth"]["error"] !== 4) {
   $goodphotoFourth = $_FILES["goodphotoFourth"];
   $photoName4 = $_FILES["goodphotoFourth"]["name"];
} else {
   $goodphotoFourth = null;
   $photoName4 = null;
}





if(!empty($_POST["variant"][0])) {
   $variantArray = $_POST["variant"];
} else {
   $variantArray = "";
 
}

if(!empty($_POST["stok"][0])) {
   $stok = $_POST["stok"];
} else {
   $stok = "";
}

if(isset($_POST["newvariant"])) {
   $newvariant = $_POST["newvariant"];
} else {
   $newvariant = "";
}
if(isset($_POST["newstok"])) {
   $newstok = $_POST["newstok"];
} else {
   $newstok = "";
}




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
if(($goodname == "") or ($menu == "") or ($goodprice == "") or ($goodcurrency == "") or ($kdv == "") or ($kargo == "") or ($gooddesc == "")  or ($variantArray == "") or ($stok == "")) {
   $_SESSION["adminmess"] = "Hər hansısa məlumat və ya hamısı boş göndərilib";
   header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=51&id=$gelenId");
   exit();
} else {
   $urunDeyismekSorgusu = $db->prepare("UPDATE goods SET urun_adi = ?, urun_fiyati = ?, para_birimi = ?, urun_aciklamasi = ?, durumu = ?, variantBasligi = ?, KDVOrani = ?, urunTuru = ?, menuId = ?, kargoUcreti = ? WHERE id = $gelenId");
   $urunDeyismekSorgusu->execute([$goodname, $goodprice, $goodcurrency, $gooddesc, 1, "numara", $kdv, explode("/", $menu)[1], explode("/", $menu)[0], $kargo]);
   if($goodphotoFirst !== null) {
      $urunResimDeyismekSorgusu = $db->prepare("UPDATE goods SET urun_resmi_bir = ? WHERE id = $gelenId");
      $urunResimDeyismekSorgusu->execute([$photoName1]);
      move_uploaded_file($goodphotoFirst["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName1");
   }
   if($goodphotoSecond !== null) {
      $urunResimDeyismekSorgusu = $db->prepare("UPDATE goods SET urun_resmi_iki = ? WHERE id = $gelenId");
      $urunResimDeyismekSorgusu->execute([$photoName2]);
      move_uploaded_file($goodphotoSecond["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName2");
   }

   if($goodphotoThird !== null) {
      $urunResimDeyismekSorgusu = $db->prepare("UPDATE goods SET urun_resmi_uc = ? WHERE id = $gelenId");
      $urunResimDeyismekSorgusu->execute([$photoName3]);
      move_uploaded_file($goodphotoThird["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName3");
   }

   if($goodphotoFourth !== null) {
      $urunResimDeyismekSorgusu = $db->prepare("UPDATE goods SET urun_resmi_dord = ? WHERE id = $gelenId");
      $urunResimDeyismekSorgusu->execute([$photoName4]);
      move_uploaded_file($goodphotoFourth["tmp_name"], "../assets/images/UrunResimleri/$klasor/$photoName4");
   }

   foreach($variantArray as $key => $variant) {
      $variantSorgusu = $db->prepare("UPDATE urunvariantlari SET urunİd = ? , variantAdi = ?, stokAdedi = ? WHERE urunİd = $gelenId");
      $variantSorgusu->execute([$gelenId, $variant,  $stok[$key]]);
   }

   if(($newstok !== "") and ($newvariant !== "")) {
      foreach($newvariant as $key => $variant) {
         $menuFetch = $db->prepare("INSERT INTO urunvariantlari(urunİd, variantAdi, stokAdedi) VALUES(?, ?, ?)");
         $menuFetch->execute([$gelenId, $variant, $newstok[$key]]);
         $menuFetchCount = $menuFetch->rowCount();
      }
   }
   header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=47");
   exit();
}   
?>