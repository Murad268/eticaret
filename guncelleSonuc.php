<?php
   if(!isset($_SESSION["userName"])) {
      header("Location: index.php");
   }
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require "freamworks/PHPMailer/src/Exception.php";
   require 'freamworks/PHPMailer/src/PHPMailer.php';
   require 'freamworks/PHPMailer/src/SMTP.php';

   if(isset($_POST["nameUpdate"])) {
      if(isset($_POST["full_name"])) {
         $fullName = Guvenlik($_POST["full_name"]);
      } else {
         $fullName = "";
      }

      if($fullName !== "") {
        if($fullName !== $userName) {
            $updateFetch = $db->prepare("UPDATE users SET full_name=? WHERE id=?");
            $updateFetch->execute([$fullName, $id]);
            $affectedUsers = $updateFetch->rowCount();
            if($affectedUsers>0) {
               $_SESSION["message"] = "Məlumatlar yeniləndilər";
               header("Location: index.php?sayfaKodu=27");
            } 
        } else {
         $_SESSION["message"] = "Heç bir məlumat dəyişdirilmədi.";
         header("Location: index.php?sayfaKodu=27");
        }
      } else {
         $_SESSION["message"] = "Məlumatlar boş göndərilmişdir. Xahiş edirik, bölməni doldurasınız";
         header("Location: index.php?sayfaKodu=27");
      }
     
   }








   if(isset($_POST["emailUpdate"])) {
      if(isset($_POST["email"])) {
         $newEmail = Guvenlik($_POST["email"]);
      } else {
         $newEmail = "";
      }

      if($newEmail !== "") {
        if($newEmail !== $email) {

         $checkUser = $db->prepare("SELECT * FROM users WHERE email = ?");
         $checkUser->execute([$newEmail]);
         $checkCount = $checkUser->rowCount();
         
         if($checkCount<1) {
            $link = $siteAdresi."index.php?sayfaKodu=34&email=".$email."&activationCode=".$code."&newMail=".$newEmail;
            $MailIcerigiHazirla = "Xoş günlər cənab ".$userName.  "</br>".
            "saytımıza maraq göstərdiyiniz üçün sizə təşəkkür edirik". "</br>".
            "öz şifrenizi deyişmek için <a href=\"$link\">tıklayın</a>";
   
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
               $MailGonder->addAddress(DonusumleriGeriDondur($newEmail), DonusumleriGeriDondur($ad));
               $MailGonder->addReplyTo($newEmail, $fullName);
               $MailGonder->isHTML(true);
               $MailGonder->Subject = DonusumleriGeriDondur($ad) . ' Email deyişme linki';
               $MailGonder->MsgHTML($MailIcerigiHazirla);
               $MailGonder->send();
               $_SESSION["message"] = "Email deyişmek linki poçt ünvanınıza gönderildi.";
   
               header("Location:index.php?sayfaKodu=27");
               exit();
            }catch(Exception $e){
               $_SESSION["message"] = "Şifrə sıfırlaması müəyyən problemlər baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";
   
               header("Location:index.php?sayfaKodu=27");
               exit();
            }
         } else {
            $_SESSION["message"] = "Belə bir email ilə istifadəçi artıq mövcuddur.";
            header("Location: index.php?sayfaKodu=27");
         }

        
        } else {
         $_SESSION["message"] = "Heç bir məlumat dəyişdirilmədi.";
         header("Location: index.php?sayfaKodu=27");
        }
      } else {
         $_SESSION["message"] = "Məlumatlar boş göndərilmişdir. Xahiş edirik, bölməni doldurasınız";
         header("Location: index.php?sayfaKodu=27");
      }
     
   }






   if(isset($_POST["phoneUpdate"])) {
      if(isset($_POST["phone"])) {
         $gelenTelefon = Guvenlik($_POST["phone"]);
      } else {
         $gelenTelefon = "";
      }

      if($gelenTelefon !== "") {
        if($gelenTelefon !== $phone) {
               $checkUser = $db->prepare("SELECT * FROM users WHERE phone = ?");
               $checkUser->execute([$gelenTelefon]);
               $checkCount = $checkUser->rowCount();

               if($checkCount<1) {
                  $updateFetch = $db->prepare("UPDATE users SET phone=? WHERE id=?");
                  $updateFetch->execute([$gelenTelefon, $id]);
                  $affectedUsers = $updateFetch->rowCount();
                  if($affectedUsers>0) {
                     $_SESSION["message"] = "Məlumatlar yeniləndilər";
                     header("Location: index.php?sayfaKodu=27");
                  } 
               } else {
                  $_SESSION["message"] = "Bu telefonlu istifadəçi artıq mövcuddur.";
                  header("Location: index.php?sayfaKodu=27");
               }


          
        } else {
         $_SESSION["message"] = "Heç bir məlumat dəyişdirilmədi.";
         header("Location: index.php?sayfaKodu=27");
        }
      } else {
         $_SESSION["message"] = "Məlumatlar boş göndərilmişdir. Xahiş edirik, bölməni doldurasınız";
         header("Location: index.php?sayfaKodu=27");
      }
     
   }





   if(isset($_POST["passUpdate"])) {
      if(isset($_POST["oldPassword"])) {
         $oldPassword = Guvenlik($_POST["oldPassword"]);
      } else {
         $oldPassword = "";
      }
      if(isset($_POST["newPassword"])) {
         $newPassword = Guvenlik($_POST["newPassword"]);
      } else {
         $newPassword = "";
      }
      if(isset($_POST["reNewPassword"])) {
         $reNewPassword = Guvenlik($_POST["reNewPassword"]);
      } else {
         $reNewPassword = "";
      }
 
      if(($oldPassword !== "") or ($newPassword !== "") or ($reNewPassword !== "")) {
         if(md5($oldPassword) == $password) {
            $hash = md5($newPassword);
            $updateFetch = $db->prepare("UPDATE users SET sifre=? WHERE id=?");
            $updateFetch->execute([$hash, $id]);
            $affectedUsers = $updateFetch->rowCount();
            if($affectedUsers>0) {
               unset($_SESSION["userName"]);
               unset($_SESSION["email"]);
               unset($_SESSION["phone"]);
               $_SESSION["message"] = "Məlumatlar güncəlləndilər";
               header("Location: user-enter");
            }
         } else {
            $_SESSION["message"] = "Köhnə şifrə yanlış daxil edilmişdir.";
            header("Location: index.php?sayfaKodu=33&sifre=deyis");
         }
      } else {
         $_SESSION["message"] = "Məlumatlardan biri və ya hamısı boş göndərilmişdir. Xahiş edirik, bölməni doldurasınız";
         header("Location: index.php?sayfaKodu=33&sifre=deyis");
      }
   }



   
   if(isset($_POST["sexUpdate"])) {
      if(isset($_POST["sex"])) {
         $gelenSex = Guvenlik($_POST["sex"]);
      } else {
         $gelenSex = "";
      }

      if($gelenSex !== "") {
        if($gelenSex !== $sex) {
            $updateFetch = $db->prepare("UPDATE users SET sex=? WHERE id=?");
            $updateFetch->execute([$gelenSex, $id]);
            $affectedUsers = $updateFetch->rowCount();
            if($affectedUsers>0) {
               $_SESSION["message"] = "Məlumatlar güncəlləndilər";
               header("Location: index.php?sayfaKodu=27");
            } 
        } else {
         $_SESSION["message"] = "Heç bir məlumat dəyişdirilmədi.";
         header("Location: index.php?sayfaKodu=27");
        }
      } else {
         $_SESSION["message"] = "Məlumatlar boş göndərilmişdir. Xahiş edirik, bölməni doldurasınız";
         header("Location: index.php?sayfaKodu=27");
      }
     
   }
?>

