<!-- index.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/27/2017 -->

<?php

include 'session.php';

if (isset($_GET['del_id'])){
      $del_id = $_GET['del_id'];
      $dquery="DELETE FROM users WHERE id = '{$del_id}' AND username = '{$user['username']}'";
      $stmt = $conn->prepare($dquery);
    if ($stmt->execute()){
      session_unset();
      session_destroy();
      header("Location: /");}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
<title>BPDYLAN89 Web Enthusiast</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width: 1024px)" />
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Righteous|Roboto" />
	<link rel="icon" type="image/x-icon" href="/images/bpdylan89.ico" />
        <link rel="publisher" href="https://plus.google.com/+BenjaminPrescottBDP">
	<meta charset="utf-8" 		  content="text/html" />
	<meta name="keywords"             content="bpdylan89, bpdylan, benjamin dylan prescott, web, full stack, development, app, create, learn, development, android" />
        <meta name="description"          content="bpdylan89.x10host.com was created by internet enthusiast Benjamin Dylan Prescott" />
	<meta name="viewport"             contains="width=device-width, initial-scale=1" />
        <meta property="og:url"           content="http://www.bpdylan89.x10host.com/" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="BPDYLAN89 Web Enthusiast" />
	<meta property="og:description"   content="bpdylan89.x10host.com was created by internet enthusiast Benjamin Dylan Prescott" />
	<meta property="og:image"         content="http://www.bpdylan89.x10host.com/images/bpdylan89.png" />
	<meta itemprop="url" 		  content="http://www.bpdylan89.x10host.com/">
	<meta itemprop="telephone"        content="6033406302">
	<span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
	<meta itemprop="addressRegion"    content="New Hampshire">
	<meta itemprop="addressCountry"   content="United States"></span>
        <meta property="fb:app_id" content="307542716354411"/>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:creator" content="@bpdylan89">
        <meta name="twitter:title" content="BPDYLAN89 Web Enthusiast">
        <meta name="twitter:description" content="bpdylan89.x10host.com was created by internet enthusiast Benjamin Dylan Prescott.">
        <meta name="twitter:image" content="http://www.bpdylan89.x10host.com/images/bpdylan89.png">
        <meta name="woorank" content=”noindex”>
</head>
        
<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page">	

<?php 

// USER PROFILE

if( !empty($user) ){ ?>

    <p class="loggedin">Welcome <?= $user['username']; ?>,<br />
    <br />

<?php

// CHECK IF CHAT ROOM IS AVAILABLE

function url_test($url ) {
  $timeout = 10;
  $check = curl_init();
  curl_setopt ( $check, CURLOPT_URL, $url );
  curl_setopt ( $check, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $check, CURLOPT_TIMEOUT, $timeout );
  $http_respond = curl_exec($check);
  $http_respond = trim( strip_tags( $http_respond ) );
  $http_code = curl_getinfo( $check, CURLINFO_HTTP_CODE );
  if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
    return true;
  } else {
    return false;
  }
  curl_close( $check );
}
 
$website = "bdprescott.ddns.net";
if( !url_test( $website ) ) {
  echo "Chat room unavailable.<br /><br />";
}
else { 
?>

<a href="http://bdprescott.ddns.net:8081/?username=<?php echo $user['username'] ?>" target="_blank" onclick="return confirm('Redirect to BPDYLAN89 Chat Room')" title="chat"><input type="submit" value="Chat now" ></a><br /><br />

<?php } 

// DELETE USER ACCOUNT

?>

	<a href="?del_id=<?php echo $user['id'] ?>" onclick="return confirm('Confirm to Delete Account')" title="delete"><input type="button" value="Delete User Account" ></a><br /><br /></p>
<?php }else{} 

include 'bpdylan89.txt'; ?>

</div>

<?php include 'footer.php'; ?>

</div>

</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/27/2017 -->
