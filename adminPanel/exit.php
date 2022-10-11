<?php

   unset($_SESSION["admin"]);
   session_destroy();
   header("Location: index.php?disSayfaKodu=1");
?>