<!-- projectview.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page">

<?php

// GET FILE FROM ID

$path = '/home/bpdylan8/public_html/';
$file = realpath($_GET['id']);
if ($file = false || strncmp($file, $path, strlen($path)) != 0) {
}else{

// HIDE DATABASE

	if (!in_array($_GET['id'], array('db/database.php', './db/database.php', '../html/db/database.php', '//var/www/html/db/database.php'))) { 
?>

<xmp style="text-align:left;float:left;margin-left:50px;margin-right:10px;min-width:90%;white-space:pre-wrap;word-wrap:break-word;">

<?php 

// SHOW FILE TEXT

echo file_get_contents($_GET['id']); ?>

</xmp>

<?php } 
}?>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->