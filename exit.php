<?php
   unset($_SESSION["userName"]);
   unset($_SESSION["email"]);
   unset($_SESSION["phone"]);
   session_destroy();
   header("Location: user-enter")
?>