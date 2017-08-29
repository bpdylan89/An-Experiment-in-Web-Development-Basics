<!-- post_edit.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

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

<?php include 'header.php'; ?>

<div class="page">
<h2>POSTS</h2>
<br />

<?php    

// SHOW POST TO EDIT

 $posts_sql="SELECT * FROM posts WHERE posts_id = '{$_GET['id']}'";
 $posts_set=$conn->query($posts_sql);
 $posts_row= $posts_set->fetch(PDO::FETCH_ASSOC);
?>

"<a href="forum/posts.php?id=<?php echo $posts_row['posts_id']?>"><?php echo $posts_row['posts_content']?></a>"
<br /><br />

<?php 

// SUBMIT EDITED POST

if(!empty($_POST['post'])){
    $posts = filter_var($_POST['post'], FILTER_SANITIZE_STRING);
    $posts = str_replace("'", "", $posts);
    $post_query = "UPDATE posts SET posts_content = '{$posts}', posts_date = '{$datetime}' WHERE posts_id = '{$_GET['id']}' AND posts_auth = '{$user['username']}'";
    $post_update = $conn->prepare($post_query);
      
      if ($post_update->execute()){
        $_POST = NULL;
        header("Location: /forum/posts.php?id=".$posts_row['posts_id']);
      }else{}
}

// DELETE POST

if (isset($_GET['del_id'])){
      $del_post_query="DELETE FROM posts WHERE posts_id = '{$_GET['del_id']}' AND posts_auth = '{$user['username']}'";
      $del_reply_query="DELETE FROM reply WHERE reply_post = '{$_GET['del_id']}'";
      $post_delete = $conn->prepare($del_post_query);
    if ($post_delete->execute()){
      $reply_delete = $conn->prepare($del_reply_query);
      $reply_delete->execute();
      header("Location: /forum/forum.php");}
}
?>

<form method="POST">
  <h2>Edit Post</h2>
      <a href="?del_id=<?php echo $_GET['id'] ?>" onclick="return confirm('Confirm Delete')">(DELETE)</a>
      <br />
      <textarea type="text" placeholder="Edit post" name="post" /></textarea>
      </br>
      <input type="submit" value="Post">
</form>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
