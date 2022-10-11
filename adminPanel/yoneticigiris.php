<?php
   if(isset($_SESSION["admin"])) {
      header("Location: index.php?sayfaKoduDis=0");
   }


  

?>
<div class="adminEnter">
   <?php
       if(isset($_SESSION["admmess"])) {
         $mess = $_SESSION["admmess"];
         echo "<div class='alert alert-danger' role='alert'>
            $mess
         </div>";
      }
   ?>
   <form action="index.php?sayfaKoduDis=2" method="post">
      <div><label for="username">admin username</label><input name="username" type="text" id="username"></div>
      <div><label for="pass">admin username</label><input name="pass" type="password" id="pass"></div>
      <button>Giriş Yap</button>
   </form>
</div>