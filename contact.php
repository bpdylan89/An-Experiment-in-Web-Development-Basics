<!-- contact.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

// SUBMIT EMAIL

if (isset($_POST['email']))  {
  
  $admin_email = "bpdylan89@bpdylan89.x10host.com";
  $email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
  $subject = filter_var($_REQUEST['subject'], FILTER_SANITIZE_STRING);
  $comment = filter_var($_REQUEST['comment'], FILTER_SANITIZE_STRING);
  $reply_subject = "Thank you for contacting BPDYLAN89!";
  $reply_comment = "This is an automated reply to your message: " . $comment;
  $message = "Thank you for contacting me!";

  mail($admin_email, $subject, $comment, "From:" . $email);
  mail($email, $reply_subject, $reply_comment, "From:" . $admin_email);
  
}else{}

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>
  
<div class="page">
<h1>Contact</h1>
  
<?php if(!empty($message)){ ?>
  <p><?= $message ?></p>
<?php } ?>

<form method="post">
  Email: <input name="email" placeholder="Enter your Email" type="text" /><br />
  Subject: <input name="subject" placeholder="Subject" type="text" /><br />
  Message:<br />
<textarea name="comment" placeholder="Comment" rows="10" cols="40"></textarea><br />
<input type="submit" value="Submit" />
</form>
  
</div>

<?php include "footer.php" ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->