<!-- logout.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

session_start();

session_unset();

session_destroy();

header("Location: /");

?>
   
<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->