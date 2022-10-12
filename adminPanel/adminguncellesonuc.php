
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
  if($gelenId == "") {
      header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=37&id=$gelenId");
  }

   if(isset($_POST["adminlogin"])) {
      $adminlogin = $_POST["adminlogin"];
   } else {
      $adminlogin = "";
   }
   if(isset($_POST["adminpass"])) {
      $adminpass = $_POST["adminpass"];
   } else {
      $adminpass = "";
   }
   if(isset($_POST["adminemail"])) {
      $adminemail = $_POST["adminemail"];
   } else {
      $adminemail = "";
   }
   if(isset($_POST["adminname"])) {
      $adminname = $_POST["adminname"];
   } else {
      $adminname = "";
   }
   if(isset($_POST["adminphone"])) {
      $adminphone = $_POST["adminphone"];
   } else {
      $adminphone = "";
   }









if(($adminlogin == "") or ($adminpass == "") or ($adminemail == "") or ($adminname == "") or ($adminphone == "")) {
   $_SESSION["adminmess"] = "Hər hansısa məlumat və ya bütün məlumatlar boş göndərilib";
   header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=37&id=$gelenId");
   exit();
} else {
   $adminSorgula = $db->prepare("UPDATE admindadas SET adminAdi = ?, adminSifresi = ?, adminEmaili = ?, adminAdSoyad = ?, adminTelefon = ?  WHERE id = $gelenId");
   $hash = md5($adminpass);
   $adminSorgula->execute([$adminlogin, $hash, $adminemail, $adminname, $adminphone]);
 
}
$adminSorgulaSayi = $adminSorgula->rowCount();
if($adminSorgulaSayi>0) {
   unset($_SESSION["adminmess"]);
   unset($_SESSION["logomess"]);
   header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=35");
   exit();
} else {
   $_SESSION["adminmess"] = "Heç bir məlumat dəyişilmədi";
   header("Location: index.php?sayfaKoduDis=0&sayfaKoduIc=37&id=$gelenId");
   exit();
}
?>