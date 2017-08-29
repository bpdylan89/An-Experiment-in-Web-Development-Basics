<!-- new_topic.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

// CHECK USER

if( !empty($user) ){
  }else{
  header("Location: /login.php");
}

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; 

// CREATE NEW TOPIC

$id=$_GET['id'];
if(!empty($_POST['topic'])){
  $topic = filter_var($_POST['topic'], FILTER_SANITIZE_STRING);
  $topic = str_replace("'", "", $topic);
      $topic_query="INSERT INTO topics(topic_subject, topic_date, topic_cat, topic_auth) VALUES('{$topic}', '{$datetime}', '{$_GET['id']}', '{$user['username']}')";
      $topic_insert = $conn->prepare($topic_query);
      if ($topic_insert->execute()){
        $_POST = NULL;
        header("Location: /category.php?id=".$id);
      }else{}
}?>

<div class="page">
	<form method="POST">

		 <h1>FORUM</h1>
  		 <h2>Create New Topic</h2>
		Topic: <br />
		<textarea type="text" placeholder="New topic" name="topic" /></textarea>
    </br>

		<input type="submit" value="Create Topic">

	</form>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->