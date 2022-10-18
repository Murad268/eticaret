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
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bebas+Neue&family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Mukta:wght@200;300;400;500;600;700;800&family=Open+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Rubik+Burned&family=Russo+One&display=swap" rel="stylesheet">
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
                        <td class="maviAlanMenusu" width="70"><a  href="user-bilgileri">Hesabım</a></td>       
                        <td width="20"><img src="assets/images/CikisBeyaz16x16.png" alt=""></td>             
                        <td class="maviAlanMenusu" width="85"><a href="index.php?sayfaKodu=32">Çıxış</a></td>  
                  <?php } else {?>
                     <td width="20"><img src="assets/images/KullaniciBeyaz16x16.png" alt=""></td>  
                     <td class="maviAlanMenusu" width="70"><a  href="user-enter">Daxil Ol</a></td>       
                     <td width="20"><img  src="assets/images/KullaniciEkleBeyaz16x16.png" alt=""></td>             
                     <td class="maviAlanMenusu" width="85"><a href="qeydiyyat">Yeni Üzv Ol</a></td>  
                     <?php }
                  ?>
            


                  <td width="20"><img style="margin-top: -1px;" src="assets/images/SepetBeyaz16x16.png" alt=""></td>  
                  <td class="maviAlanMenusu" width="103"><a  href="sepet">Alışveriş Səbəti</a></td>    
               </tr>
            </table>
            <table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0">
               <tr>
                  <td while="192"><a href="anaySehife"><img src="assets/images/<?=DonusumleriGeriDondur($ayarlar["siteLogosu"])?>" alt="" border="0"></a></td>            
                  <td>
                     <table width="873" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                           <td class="anaMenu" width="306">&nbsp;</td>     
                           <td class="anaMenu" width="107"><a href="anaySehife">Ana Səhifə</a></td>    
                           <td class="anaMenu" width="160"><a href="kishi-ayakkabilari"">Kişi Ayaqqabıları</a></td>     
                           <td class="anaMenu" width="160"><a href="qadin-ayakkabilari">Qadın Ayaqqabıları</a></td>   
                           <td class="anaMenu" width="140px"><a href="ushaq-ayakkabilari">Uşaq Ayaqqabıları</a></td>             
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
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250">&nbsp;<b>Qurumsal</b></td>   
                  <td width="22" width="20" width="">&nbsp;</td> 
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250"><b>Üzvlük və Xidmətlər</b></td> 
                  <td width="22" width="20" width="">&nbsp;</td> 
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250"><b>Müqavilələr</b></td> 
                  <td width="21" width="20" width="">&nbsp;</td> 
                  <td style="border-bottom: 1px dashed #CCCCCC;" width="250"><b>Bizi izləyin</b></td>      
               </tr>
               <tr height="30">
                  <td class="footer">&nbsp;<a href="hakkimizda">Haqqımızda</a></td>   
                  <td>&nbsp;</td>
                  <?php
                     if(isset($_SESSION["userName"])) {?>
                        <td class="footer"><a href="user-bilgileri">Hesabım</a></td> 
                     <?php  } else {   ?> 
                        <td class="footer"><a href="user-enter">Daxil Ol</a></td> 
                  <?php }
                  ?> 
                  
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="uyelikSozlezmesi">Üzvlük Müqaviləsi</a></td> 
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
                  <td class="footer">&nbsp;<a href="bankaheshablarimiz">Bank hesablarımız</a></td>   
                  <td>&nbsp;</td> 
                  <?php
                     if(isset($_SESSION["userName"])) {  ?>
                           <td class="footer"><a href="index.php?sayfaKodu=32">Çıxış</a></td> 
                     <?php } else {  ?>
                        <td class="footer"><a href="qeydiyyat">Yeni Üzv Olun</a></td> 
                     <?php  }
                  ?>
                  
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="istifadeqaydalari">İstifadə qaydaları</a></td> 
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
                  <td class="footer">&nbsp;<a href="havaleBildirimleriFormu">Köçürmə bildiriş forması</a></td>   
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="faq">Tez-tez soruşulan suallar</a></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="gizliliksozlesmeshi">Məxfilik müqaviləsi</a></td> 
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
                  <td class="footer">&nbsp;<a href="kargomhardadi">Kargo Haradadır?</a></td>   
                  <td>&nbsp;</td> 
                  <td></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="meshafelisatissozlesmesi">Məsafəli satış müqaviləsi</a></td> 
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
                  <td class="footer">&nbsp;<a href="iletishim">Əlaqə</a></td>   
                  <td>&nbsp;</td> 
                  <td></td> 
                  <td>&nbsp;</td> 
                  <td class="footer"><a href="teslimat">Çatdırılma</a></td> 
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
                  <td class="footer"><a href="iptalIade">İmtina & Qaytarmaq & Dəyişim</a></td> 
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