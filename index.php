<?php
   session_start(); ob_start();
   require_once("ayarlar/ayar.php");
   require_once("ayarlar/functions.php");
   require_once("ayarlar/siteSayfalari.php");


  
   if(isset($_REQUEST["sayfaKodu"])) {
      $sayfaKodu = sayiliIcerikleriFiltrele($_REQUEST["sayfaKodu"]);
   } else {
      $sayfaKodu = 0;
   }
   if(isset($_REQUEST["sayfalama"])) {
      $sayfalama = sayiliIcerikleriFiltrele($_REQUEST["sayfalama"]);
   } else {
      $sayfalama = 1;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta http-equiv="Content-Language" content="tr">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta charset="UTF-8">
   <meta name="Robots" content="index, follow">
   <meta name="googlebot" content="index, follow">
   <meta name="revisit-after" content="7 Days">
   <meta name="description" content="<?=DonusumleriGeriDondur($desc)?>">
   <meta name="keywords" content="<?=DonusumleriGeriDondur($keywords)?>">
   <base href="/eticaret/">
   <link rel="shortcut icon" href="assets/images/Favicon.png" type="image/x-icon">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
   <link rel="stylesheet" href="ayarlar/style.css">
   <title><?=$title?></title>

</head>
<body>

   <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
      <tr height="40" bgcolor="#353745">
         <td><img src="assets/images/HeaderMesajResmi.png" alt="" border="0"></td>
      </tr>
      <tr height="110">
         <td>
            <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
               <tr bgcolor="#0088CC">
                  <td>&nbsp;</td>       
                  
                  <?php
                     if(isset($_SESSION["userName"])) {     ?>
                        <td width="20"><img  src="assets/images/KullaniciBeyaz16x16.png" alt=""></td>  
                        <td class="maviAlanMenusu" width="70"><a  href="index.php?sayfaKodu=27">Hesabım</a></td>       
                        <td width="20"><img src="assets/images/CikisBeyaz16x16.png" alt=""></td>             
                        <td class="maviAlanMenusu" width="85"><a href="index.php?sayfaKodu=32">Çıkış Yap</a></td>  
                  <?php } else {?>
                     <td width="20"><img src="assets/images/KullaniciBeyaz16x16.png" alt=""></td>  
                     <td class="maviAlanMenusu" width="70"><a  href="user-enter">Giriş Yap</a></td>       
                     <td width="20"><img  src="assets/images/KullaniciEkleBeyaz16x16.png" alt=""></td>             
                     <td class="maviAlanMenusu" width="85"><a href="index.php?sayfaKodu=22">Yeni üye ol</a></td>  
                     <?php }
                  ?>
            


                  <td width="20"><img style="margin-top: -1px;" src="assets/images/SepetBeyaz16x16.png" alt=""></td>  
                  <td class="maviAlanMenusu" width="103"><a  href="index.php?sayfaKodu=56">Alışveriş Sepeti</a></td>    
               </tr>
            </table>
            <table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td while="192"><a href="index.php?sayfaKodu=0"><img src="assets/images/<?=DonusumleriGeriDondur($ayarlar["siteLogosu"])?>" alt="" border="0"></a></td>            
                  <td>
                     <table width="873" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="anaMenu" width="306">&nbsp;</td>     
                           <td class="anaMenu" width="107"><a href="index.php?sayfaKodu=0">Ana Sayfa</a></td>    
                           <td class="anaMenu" width="160"><a href="index.php?sayfaKodu=49"">Erkek Ayakkabıları</a></td>     
                           <td class="anaMenu" width="160"><a href="index.php?sayfaKodu=50">Kadın Ayakkabıları</a></td>   
                           <td class="anaMenu" width="140px"><a href="index.php?sayfaKodu=51">Çocuk Ayakkabıları</a></td>             
                        </tr>
                     </table>
                  </td>        
               </tr>
            </table>
         </td>
      </tr>

      
      <tr>
         <td valign="top">
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td align="center">
                     <?php
                        if((!$sayfaKodu) OR ($sayfaKodu == "") or ($sayfaKodu == 0)) {
                           include($sayfa[0]);
                        } else {
                           include($sayfa[$sayfaKodu]);
                        }
                     ?> <br>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
      



      <tr height="210">
         <td> 


            <table bgcolor="#F9F9F9" width="1065"  align="center" border="0" cellpadding="0" cellspacing="0">
               <tr height="30">
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250">&nbsp;<b>Kurumsal</b></td>   
                  <td width="22" width="20" width="">&nbsp;</td> 
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250"><b>Üyelik & Hizmetler</b></td> 
                  <td width="22" width="20" width="">&nbsp;</td> 
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250"><b>Sözleşmeler</b></td> 
                  <td width="21" width="20" width="">&nbsp;</td> 
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250"><b>Bizi takib edin</b></td>      
               </tr>
               <tr height="30">
                  <td class="footer">&nbsp;<a href="index.php?sayfaKodu=1">Hakkımızda</a></td>   
                  <td>&nbsp;</td>
                  <?php
                     if(isset($_SESSION["userName"])) {?>
                        <td class="footer"><a href="index.php?sayfaKodu=27">Hesabım</a></td> 
                     <?php  } else {   ?> 
                        <td class="footer"><a href="user-enter">Giriş Yap</a></td> 
                  <?php }
                  ?> 
                  
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=2">Üyelik Sözleşmesi</a></td> 
                  <td>&nbsp;</td> 
                  <td>

                     <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="footer"width="20">
                              <a href=""><img src="assets/images/Facebook16x16.png" alt=""></a>
                           </td>
                           <td class="footer" width="230"><a target="_blank" href="<?=$SosyalLinkFacebook?>">Facebook</a></td>
                        </tr>
                     </table>
                  </td>      
               </tr>
               <tr height="30">
                  <td class="footer">&nbsp;<a href="index.php?sayfaKodu=8">Banka Hesaplarımız</a></td>   
                  <td>&nbsp;</td> 
                  <?php
                     if(isset($_SESSION["userName"])) {  ?>
                           <td class="footer"><a href="index.php?sayfaKodu=32">Çıkış Yap</a></td> 
                     <?php } else {  ?>
                        <td class="footer"><a href="index.php?sayfaKodu=22">Yeni Üye Ol</a></td> 
                     <?php  }
                  ?>
                  
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=3">Kullanım Koşulları</a></td> 
                  <td>&nbsp;</td> 
                  <td>
                     
                     <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="footer" width="20">
                              <a href=""><img src="assets/images/Twitter16x16.png" alt=""></a>
                           </td>
                           <td class="footer" width="250"><a target="_blank"  href="<?=$SosyalLinkTwitter?>">Twitter</a></td>
                        </tr>
                     </table>
                  </td>      
               </tr>
               <tr height="30">
                  <td class="footer">&nbsp;<a href="index.php?sayfaKodu=9">Havale Bildirim Formu</a></td>   
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=21">Sık Sorulan Sorular</a></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=4">Gizlilik Sözleşmesi</a></td> 
                  <td>&nbsp;</td> 
                  <td>
                     <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="footer" width="20">
                              <a href=""><img src="assets/images/LinkedIn16x16.png" alt=""></a>
                           </td>
                           <td class="footer" width="250"><a target="_blank" href="<?=$SosyalLinkLinkedin?>">Linkedin</a></td>
                        </tr>
                     </table>
                  </td>      
               </tr>
               <tr height="30">
                  <td class="footer">&nbsp;<a href="index.php?sayfaKodu=14">Kargo Nerede?</a></td>   
                  <td>&nbsp;</td> 
                  <td></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=5">Mesafeli Satış Sözleşmesi</a></td> 
                  <td>&nbsp;</td> 
                  <td>
                     <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="footer" width="20">
                              <a href=""><img src="assets/images/Instagram16x16.png" alt=""></a>
                           </td>
                           <td class="footer" width="250"><a target="_blank" href="<?=$SosyalLinkInstagram?>">Instagram</a></td>
                        </tr>
                     </table>
                  </td>      
               </tr>
               <tr height="30">
                  <td class="footer">&nbsp;<a href="index.php?sayfaKodu=16">İletişim</a></td>   
                  <td>&nbsp;</td> 
                  <td></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=6">Teslimat</a></td> 
                  <td>&nbsp;</td> 
                  <td>
                     <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="footer" width="20">
                              <a href=""><img src="assets/images/YouTube16x16.png" alt=""></a>
                           </td>
                           <td class="footer" width="250"><a target="_blank" href="<?=$SosyalLinkYoutube?>">Youtube</a></td>
                        </tr>
                     </table>
                  </td>      
               </tr>
               <tr height="30">
                  <td>&nbsp;</td>   
                  <td>&nbsp;</td> 
                  <td></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="index.php?sayfaKodu=7">İptal & İyade & Deyişim</a></td> 
                  <td>&nbsp;</td> 
                  <td>
                     <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="footer" width="20">
                              <a href=""><img src="assets/images/Pinterest16x16.png" alt=""></a>
                           </td>
                           <td class="footer" width="250"><a target="_blank" href="">Printerest</a></td>
                        </tr>
                     </table>
                  </td>      
               </tr>
            </table>


         </td>
      </tr>


      <tr height="30">
         <td>
            <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td align="center"><?=DonusumleriGeriDondur($copyWriteMetni)?></td>
               </tr>
            </table>
         </td>
      </tr>
      <tr height="30">
         <td>
            <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td align="center">
                     <img style="margin-right: 5px;" src="assets/images/RapidSSL32x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/InternetteGuvenliAlisveris28x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/3DSecure14x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/MaximumCard46x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/CardFinans78x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/AxessCard46x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/ParafCard19x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/VisaCard37x12.png" alt=""><img style="margin-right: 5px;" src="assets/images/MasterCard21x12.png" alt=""><img style="margin-right: 5px;"src="assets/images/AmericanExpiress20x12.png" alt="">
                  </td>
               </tr>
            </table>
         </td>
      </tr>

      
   </table>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   <script type="text/javascript" src="ayarlar/function.js" language="javascript"></script>
   <script type="text/javascript" src="freamworks/jquery/jquery-3.6.1.min.js" language="javascript"></script>
  
</body>
<script>
   const links = document.querySelectorAll(".deleteDiv");
   const upLinks = document.querySelectorAll(".updateDiv");
   const deleteFavoriteLinks = document.querySelectorAll(".deleteFavorite");
   links.forEach((link, i) => {
      link.addEventListener("click", () => {
        if(confirm("Siz doğurdan bu adresi silmek isəyirsiniz?")) {
            document.querySelectorAll(".deleteLink")[i].click();
        }
      })
   })

   upLinks.forEach((link, i) => {
      link.addEventListener("click", () => {
        if(confirm("Siz doğurdan bu adresi güncəlləmək isəyirsiniz?")) {
            document.querySelectorAll(".updateLink")[i].click();
        }
      })
   })

   deleteFavoriteLinks.forEach((link, i) => {
      link.addEventListener("click", () => {
        if(confirm("Siz bu məhsulu favorilerdən silmık istədiyinizə əminsiniz?")) {
            document.querySelectorAll(".favoriteDelete")[i].click();
        }  else {
       
        }
      })
   })


</script>
</html>
<?php 
   $db = null;
   ob_flush();
?>