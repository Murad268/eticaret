<?php
   $ipAdresi = $_SERVER["REMOTE_ADDR"];
   $unix = time();
   $tarihSaat = date("d.m.Y H:i:s", $unix);
   function registrDate($deger) {
      return date("d.m.Y H:i:s", $deger);
   }
   function ucGunIreli() {
      global $unix;
      $birGun = 86400;
      $hesapla = $unix +(3*$birGun);
      $cevir = date("d.m.Y", $hesapla);
      return $cevir;
   }
   function rakamlarHaricTumKarakterleriSil($deger) {
      $islem = preg_replace("/[^0-9]/", "", $deger);
      return $islem;
   }
   function butunBosluklariSil($deger) {
      $islem = preg_replace("/\s|&nbsp;/", "", $deger);
      return $islem;
   }
   function DonusumleriGeriDondur($deger) {
      $geriDondur = htmlspecialchars_decode($deger, ENT_QUOTES);
      return $geriDondur;
   }
   function Guvenlik($deger) {
      $bir = trim($deger);
      $iki = strip_tags($bir);
      $uc = htmlspecialchars($iki, ENT_QUOTES);
      return $uc;
   }

   function sayiliIcerikleriFiltrele($deger) {
      $bir = trim($deger);
      $iki = strip_tags($bir);
      $uc = htmlspecialchars($iki, ENT_QUOTES);
      $temizle = rakamlarHaricTumKarakterleriSil($uc);
      return $temizle;
   }

   function iban($deger) {
      $bir = trim($deger);
      $iki = butunBosluklariSil($bir);
      $birinciBlok = substr($iki, 0, 4);
      $ikinciBlok = substr($iki, 4, 4);
      $ucuncuBlok = substr($iki, 8, 4);
      $dorduncuBlok = substr($iki, 12, 4);
      $besinciBlok = substr($iki, 16, 4);
      $altinciBlok = substr($iki, 20, 4);
      $yeddinciBlok = substr($iki, 24, 2);
      $duzenle = $birinciBlok . " ". $ikinciBlok . " ". $ucuncuBlok . " ". $dorduncuBlok . " " . $besinciBlok . " " . $altinciBlok . " " . $yeddinciBlok;
      return $duzenle;
   }

   function activationCode() {
      return rand(1000, 9000000);
   }

   function fiyatBitimlerndir($deger) {
      $bicimlerndir = number_format($deger, "2", ",", ".");
      return $bicimlerndir;
   }
?>