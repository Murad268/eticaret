<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "freamworks/PHPMailer/src/Exception.php";
require 'freamworks/PHPMailer/src/PHPMailer.php';
require 'freamworks/PHPMailer/src/SMTP.php';


if(isset($_POST["full_name"])){
	$GelenIsimSoyisim		=	Guvenlik($_POST["full_name"]);
}else{
	$GelenIsimSoyisim		=	"";
}

if(isset($_POST["email"])){
	$GelenEmailAdresi		=	Guvenlik($_POST["email"]);
}else{
	$GelenEmailAdresi		=	"";
}

if(isset($_POST["phone"])){
	$GelenTelefonNumarasi	=	Guvenlik($_POST["phone"]);
}else{
	$GelenTelefonNumarasi	=	"";
}

if(isset($_POST["text"])){
	$GelenMesaj				=	Guvenlik($_POST["text"]);
}else{
	$GelenMesaj				=	"";
}

if(($GelenIsimSoyisim!="") and ($GelenEmailAdresi!="") and ($GelenTelefonNumarasi!="") and ($GelenMesaj!="")){
	$MailIcerigiHazirla		=	"İsim Soyisim : " . $GelenIsimSoyisim . "<br />E-Mail Adresi : " . $GelenEmailAdresi . "<br />Telefon Numarası : " . $GelenTelefonNumarasi . "<br />Mesaj : " . $GelenMesaj;
	
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
		$MailGonder->addAddress(DonusumleriGeriDondur($mail), DonusumleriGeriDondur($ad));
		$MailGonder->addReplyTo($GelenEmailAdresi, $GelenIsimSoyisim);
		$MailGonder->isHTML(true);
		$MailGonder->Subject = DonusumleriGeriDondur($ad) . ' İletişim Formu Mesajı';
		$MailGonder->MsgHTML($MailIcerigiHazirla);
		$MailGonder->send();
		
		header("Location: mailtamam");
		exit();
	}catch(Exception $e){
		echo $e->getMessage();
		header("Location: mailhata");
		exit();
	}
}else{
	header("Location: maileksik");
	exit();
}
?>