<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require "freamworks/PHPMailer/src/Exception.php";
   require 'freamworks/PHPMailer/src/PHPMailer.php';
   require 'freamworks/PHPMailer/src/SMTP.php';
   if(isset($_POST["email"])) {
      $email = Guvenlik($_POST["email"]);
   } else {
      $email = "";
   }

   if(isset($_POST["password"])) {
      $password = Guvenlik($_POST["password"]);
   } else {
      $password = "";
   }


   if(($email !== "") or ($password !== "")) {
      $enterFetch = $db->prepare("SELECT * FROM users WHERE email = ? AND sifre = ? AND SilinmeDurumu = 0");
      $hash = md5($password);
      
      $enterFetch->execute([$email, $hash]);
      $enterRows = $enterFetch->rowCount();
      $users = $enterFetch->fetch(PDO::FETCH_ASSOC);
    
      if($enterRows > 0) {
         // echo $enterRows;
         // exit();
         if($users["status"] == 0) {

            $link = $siteAdresi."activation.php?email=".$users["email"]."&activationCode=".$users["activationCode"];
            $MailIcerigiHazirla = "Xoş günlər cənab ".$users["full_name"].  "</br>".
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
               $MailGonder->addReplyTo($email, $users["full_name"]);
               $MailGonder->isHTML(true);
               $MailGonder->Subject = DonusumleriGeriDondur($ad) . ' Aktivasiyon linki';
               $MailGonder->MsgHTML($MailIcerigiHazirla);
               $MailGonder->send();
               $_SESSION["message"] = "Hesab aktivləşdirilməyib. Sizə aktivasiya kodu yeniden göndərildi.";
               header("Location: index.php?sayfaKodu=25");
            }catch(Exception $e){
               $_SESSION["message"] = "Qeydiyyat zamanı müəyyən problemlər baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";
   
               header("Location:index.php?sayfaKodu=25");
               exit();
            }
    
   
   
         } else {
            unset($_SESSION["message"]);
            $_SESSION["userName"] = $users["full_name"];
            $_SESSION["email"] = $users["email"];
            $_SESSION["phone"] = $users["phone"];
            header("Location: index.php?sayfaKodu=27");
         }
      } else {
         $_SESSION["message"] = "Belə bir hesab mövcud deyil.";
    
         header("Location:index.php?sayfaKodu=25");
      }
   } else {
      $_SESSION["message"] = "Daxil edilən məlumatlar tam deyil. Xahiş edirik həm poçt unvanını, həm də parolu daxil edin";
      header("Location: index.php?sayfaKodu=25");
   }
?>