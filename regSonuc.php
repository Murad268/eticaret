<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require "freamworks/PHPMailer/src/Exception.php";
   require 'freamworks/PHPMailer/src/PHPMailer.php';
   require 'freamworks/PHPMailer/src/SMTP.php';
   if(isset($_POST["full_name"])) {
      $full_name = Guvenlik($_POST["full_name"]);
   } else {
      $full_name="";
   }
   if(isset($_POST["email"])) {
      $email = Guvenlik($_POST["email"]);
   } else {
      $email="";
   }
   if(isset($_POST["phone"])) {
      $phone = Guvenlik( $_POST["phone"]);
   } else {
      $phone="";
   }
   if(isset($_POST["password"])) {
      $password = Guvenlik($_POST["password"]);
   } else {
      $password="";
   }

   if(isset($_POST["yes"])) {
      $yes = Guvenlik($_POST["yes"]);
   } else {
      $yes="";
   }
   if(isset($_POST["sex"])) {
      $sex = Guvenlik($_POST["sex"]);
   } else {
      $sex="";
   }

   $activation = activationCode();
 

   if(($full_name !== "") or ($email !== "") or ($phone !== "") or ($password !== "") or ($sex !== "")) {
      if($yes == "on") {
         $checkEmailOrPassword = $db->prepare("SELECT * FROM users WHERE email = ? or phone = ?");
         $checkEmailOrPassword->execute([$email, $phone]);
         $check = $checkEmailOrPassword->rowCount();
         if($check>0) {
            echo $check;
            $_SESSION["regMessage"] = "bu email və ya telefon nömrəsi ilə istifadəçi artıq mövcuddur";
            header("Location: index.php?sayfaKodu=22");
           } else {
            $pass = md5($password);
            $addUser = $db->prepare("INSERT INTO `users` (`full_name`, `email`, `sifre`, `phone`, `sex`, `regDate`, `ip`, `activationCode`) VALUES ('$full_name', '$email', '$pass', '$phone', '$sex', '$unix', '$ipAdresi', '$activation')");
            $addUser->execute();
            $kayit = $addUser->rowCount();
            if($kayit>0) {
               header("Location: index.php?sayfaKodu=22");
               $link = $siteAdresi."activation.php?email=".$email."&activationCode=".$activation;
               $_SESSION["regMessage"] = "Qeydiyyat uğurla bitmişdir";
               $MailIcerigiHazirla = "Xoş günlər cənab ".$full_name.  "</br>".
               "saytımıza maraq göstərdiyiniz üçün sizə təşəkkür edirik". "</br>".
               "öz profilinizi aktivləşdirmək üçün <a href=\"$link\">tıklayın</a>";
	
               $MailGonder		=	new PHPMailer(true);
               
               try{
                  $MailGonder->SMTPDebug			=	0;
                  $MailGonder->isSMTP();
                  $MailGonder->Host				=	DonusumleriGeriDondur($hostAdresi);
                  $MailGonder->SMTPAuth			=	true;
                  $MailGonder->CharSet			=	"UTF-8";
                  $MailGonder->Username			=	DonusumleriGeriDondur($mail);
                  $MailGonder->Password			=	DonusumleriGeriDondur($mailPass);
                  $MailGonder->SMTPSecure			=	PHPMailer::ENCRYPTION_SMTPS;
                  $MailGonder->Port				=	465;
                  $MailGonder->SMTPOptions		=	array(
                                                'ssl' => array(
                                                   'verify_peer' => false,
                                                   'verify_peer_name' => false,
                                                   'allow_self_signed' => true
                                                )
                                             );
                  $MailGonder->setFrom(DonusumleriGeriDondur($mail), DonusumleriGeriDondur($ad));
                  $MailGonder->addAddress(DonusumleriGeriDondur($email), DonusumleriGeriDondur($ad));
                  $MailGonder->addReplyTo($email, $full_name);
                  $MailGonder->isHTML(true);
                  $MailGonder->Subject = DonusumleriGeriDondur($ad) . ' Aktivasiyon linki';
                  $MailGonder->MsgHTML($MailIcerigiHazirla);
                  $MailGonder->send();
                  $_SESSION["regMessage"] = "Aktivasiya linki daxil etdiyiniz poçt adresinə göndərilmişdir.";
                  header("Location:index.php?sayfaKodu=22");
                  exit();
               }catch(Exception $e){
                  $_SESSION["regMessage"] = "Qeydiyyat zamanı müəyyən problemlər baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";

                  header("Location:index.php?sayfaKodu=22");
                  exit();
               }


            } else {
               $_SESSION["regMessage"] = "Qeydiyyat zamanı müəyyən problemlər baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";
            }
         }
      } else {
         $_SESSION["regMessage"] = "Əgər istifadəçi sözləşmesini oxumamısınızsa oxuyun və razısınızsa təstiq edin. Təstiq etmədiyiniz halda davam etmək mümkün olmayacaqdır.";
         header("Location: index.php?sayfaKodu=22");
      }
   } else {
      $_SESSION["regMessage"] = "Məlumatların daxil edilməsində natamamlıq. Xahiş edirik, bütün məlumatları daxil edəsiniz!";
      header("Location: index.php?sayfaKodu=22");
   }


  
     
    


  
?>