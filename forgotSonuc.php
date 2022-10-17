<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require "freamworks/PHPMailer/src/Exception.php";
   require 'freamworks/PHPMailer/src/PHPMailer.php';
   require 'freamworks/PHPMailer/src/SMTP.php';
   if(isset($_POST["phoneOrEmail"])) {
      $phoneOrEmail = Guvenlik($_POST["phoneOrEmail"]);
   } else {
      $phoneOrEmail = "";
   }


   if($phoneOrEmail !== "") {
      $fetchNull = $db->prepare("SELECT * FROM users WHERE (email = ? OR phone = ?) AND SilinmeDurumu = 0");
      $fetchNull->execute([$phoneOrEmail, $phoneOrEmail]);
      $fetchNullRow = $fetchNull->rowCount();
      $users = $fetchNull->fetch(PDO::FETCH_ASSOC);
      if($fetchNullRow > 0) {
         $link = $siteAdresi."index.php?sayfaKodu=30&email=".$users["email"]."&activationCode=".$users["activationCode"];
         $MailIcerigiHazirla = "Xoş günlər cənab ".$users["full_name"].  "</br>".
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
            $MailGonder->addAddress(DonusumleriGeriDondur($users["email"]), DonusumleriGeriDondur($ad));
            $MailGonder->addReplyTo($users["email"], $users["full_name"]);
            $MailGonder->isHTML(true);
            $MailGonder->Subject = DonusumleriGeriDondur($ad) . ' Şifre deyişme linki';
            $MailGonder->MsgHTML($MailIcerigiHazirla);
            $MailGonder->send();
            $_SESSION["enterMess"] = "Şifreni deyişmek linki poçt ünvanınıza gönderildi.";

            header("Location: user-enter");
         }catch(Exception $e){
            $_SESSION["message"] = "Parol sıfırlaması müəyyən problemlər baş verdi. Xahiş edirik bir az sonra cəhd edəsiniz";

            header("Location: user-enter");
            exit();
         }
      } else {
         $_SESSION["message"] = "Belə bir hesab mövcud deyil";
         header("Location: index.php?sayfaKodu=28");
      }
   } else {
      $_SESSION["message"] = "Xahiş edirik nörmənizi və ya poçt ünvanınızı daxil edəsiniz.";
      header("Location: index.php?sayfaKodu=28");
   }
?>