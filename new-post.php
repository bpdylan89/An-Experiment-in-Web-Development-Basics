<!-- new-posts.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

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

// CREATE NEW POST

if(!empty($_POST['post'])){
  $posts = filter_var($_POST['post'], FILTER_SANITIZE_STRING);
  $posts = str_replace("'", "", $posts);
      $posts_query="INSERT INTO posts(posts_content, posts_date, posts_topic, posts_auth) VALUES('{$posts}', '{$datetime}', '{$_GET['id']}', '{$user['username']}')";
      $posts_insert = $conn->prepare($posts_query);
      
      if ($posts_insert->execute()){
        $_POST = NULL;
        header("Location: /topics.php?id=".$_GET['id']);
      }else{}
}?>

<div class="page">
	<form method="POST">

		 <h1>FORUM</h1>
  		 <h2>Create New Post</h2>
		      Post: <br />
		<textarea type="text" placeholder="Post comments here" name="post" /></textarea>
    </br>
		<input type="submit" value="Create Post">

	</form>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->