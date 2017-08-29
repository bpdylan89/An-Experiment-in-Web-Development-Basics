<!-- posts.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page">
<h1>TOPIC</h1>

<?php    

// POST TABLE TITLE

 $posts_sql="SELECT * FROM posts, topics WHERE posts_id = '{$_GET['id']}' AND posts_topic = topic_id";
 $posts_set=$conn->query($posts_sql);
 $posts_row= $posts_set->fetch(PDO::FETCH_ASSOC);
?>

<h3>"<a href="topics.php?id=<?php echo $posts_row['topic_id']?>"><?php echo $posts_row['topic_subject']?></a>"</h3>
<br /><br />

<table align="center" width="90%" border="1px solid grey">

  <tr>
    <th><p style="text-align:left;margin-left:20px;">
        <?php echo $posts_row['posts_auth'] ?><a href="post-edit.php?id=<?php echo $posts_row['posts_id'] ?>"><?php if ($posts_row['posts_auth'] == $user['username']) { ?> <input type="button" value="Edit"><?php } ?></a></p>
        POST -- "<?php echo $posts_row['posts_content'] ?>"<p style="text-align:right;margin-right:15px;"><?php echo $posts_row['posts_date'] ?>
    </p></th>
  </tr>

<?php 

// REPLY TABLE QUERY

 $reply_sql="SELECT * FROM posts, reply WHERE posts_id = '{$_GET['id']}' AND reply_post = '{$_GET['id']}' ";
 $reply_set=$conn->query($reply_sql);
 while($reply_row=$reply_set->fetch(PDO::FETCH_ASSOC)) {
?>

  <tr>
    <td align="left"><p style="margin-left:20px;text-align:left;">
            <?php echo $reply_row['reply_auth'] ?><a href="reply-edit.php?id=<?php echo $reply_row['reply_id'] ?>"><?php if ($reply_row['reply_auth'] == $user['username']) { ?> <input type="button" value="Edit"><?php } ?></a></p>
            <p style="margin-left:50px;"><?php echo $reply_row['reply_content'] ?></p>
            <p style="text-align:right;margin-right:15px;"><?php echo $reply_row['reply_date'] ?>
    </p></td>
  </tr>

<?php }?>

</table>

<?php 

// CHECK USER

if( empty($user) ) {
  ?> <br /> <?php 
  echo "<b>-- Login to reply --</b>";
}else{
  
// SUBMIT NEW REPLY

  if(!empty($_POST['reply'])){
    $reply = filter_var($_POST['reply'], FILTER_SANITIZE_STRING);
    $reply = str_replace("'", "", $reply);
    $reply_query="INSERT INTO reply(reply_content, reply_date, reply_post, reply_auth) VALUES('{$reply}', '{$datetime}', '{$_GET['id']}', '{$user['username']}')";
    $reply_insert = $conn->prepare($reply_query);
      
      if ($reply_insert->execute()){
        $_POST = NULL;
        header("Location: /posts.php?id=".$_GET['id']);
      }else{}
  }
?>

<form method="POST">
<h2>Reply to Post</h2>
    <textarea type="text" placeholder="Comment to reply" name="reply" /></textarea>
    </br>
    <input type="submit" value="Reply">
</form>

<?php 
} ?>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->