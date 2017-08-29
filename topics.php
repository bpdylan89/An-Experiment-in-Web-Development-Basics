<!-- topics.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

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

// LIST TOPICS

$topic_sql="SELECT * FROM topics WHERE topic_id = '{$_GET['id']}' ";
$topic_set=$conn->query($topic_sql);
$topic_row= $topic_set->fetch(PDO::FETCH_ASSOC);
    echo '"', $topic_row['topic_subject'], '"';
?><br /><br />

<?php if(empty($user)){}else{ ?>
    <a href="/new-post.php?id=<?php echo $_GET['id'] ?>"><input type="submit" value="Create Post"></a> 
<?php } ?><br />

<table cellpadding="15" align="center" width="90%" border="1px solid grey">
  <tr>
    <th>Post Content<pre style="text-align:right;">Replies</pre></th>
    <th>Date</th>
  </tr>

<?php

// COUNT POSTS

 $posts_sql="SELECT * FROM posts WHERE posts_topic = {$_GET['id']}";
 $posts_set=$conn->query($posts_sql);
 while($posts_row=$posts_set->fetch(PDO::FETCH_ASSOC)) { 
    $posts_count_sql ="SELECT count(*) AS 'count' FROM reply WHERE reply_post = '{$posts_row['posts_id']}' ";
    $posts_count_set = $conn->query($posts_count_sql);
    $posts_count = $posts_count_set->fetch(PDO::FETCH_ASSOC);
  ?>
        
      <tr>
        <td align="left"><a href="posts.php?id=<?php echo $posts_row['posts_id'] ?>"><?php echo $posts_row['posts_content'] ?></a>  
        <br /><tag style="margin-left:10px;">- <?php echo $posts_row['posts_auth']?></tag>
        <pre style="text-align:right;"><?php echo $posts_count['count'] ?></pre></td>
        <td><?php echo $posts_row['posts_date'] ?></td>
      </tr>

<?php } ?>

</table>

<?php
if( empty($user) ) {
  ?> <br /> <?php 
  echo "<b>-- Login to submit to posts --</b>";
}else{}
?>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->