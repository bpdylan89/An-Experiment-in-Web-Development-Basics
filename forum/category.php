<!-- category.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page">
<h1>CATEGORY</h1>

<?php    

// CATEGORY QUERY

$category_sql="SELECT * FROM category WHERE id = '{$_GET['id']}' ";
$category_set=$conn->query($category_sql);
$category_row= $category_set->fetch(PDO::FETCH_ASSOC);
    echo '"',$category_row['title'], ' -- ', $category_row['description'], '"'; 
?><br /><br />

<?php 

// CREATE TOPIC

if(empty($user)){}else{ ?>
    <a href="/forum/new-topic.php?id=<?php echo $_GET['id'] ?>"><input type="submit" value="Create Topic"></a>
<?php } ?>
<br />

<table cellpadding="15" align="center" width="80%" border="1px solid grey">
  <tr>
    <th width="60%">Topics<pre style="text-align:right;">Posts</pre></th>
    <th width="20%">Date</th>
  </tr>

<?php

// TOPIC QUERY

 $topic_sql="SELECT * FROM topics WHERE topic_cat = '{$_GET['id']}'";
 $topic_set=$conn->query($topic_sql);
 while($topic_row=$topic_set->fetch(PDO::FETCH_ASSOC)) {
    $topic_count_query ="SELECT count(*) AS 'count' FROM posts WHERE posts_topic = '{$topic_row['topic_id']}' ";
    $topic_count_set = $conn->query($topic_count_query);
    $topic_count = $topic_count_set->fetch(PDO::FETCH_ASSOC);
?>

      <tr>
        <td align="left"><a href='/forum/topics.php?id=<?php echo $topic_row['topic_id'] ?>'><?php echo $topic_row['topic_subject'] ?></a> 
        <br /><tag style="margin-left:10px;">- <?php echo $topic_row['topic_auth']?></tag>
        <pre style="text-align:right;"><?php echo $topic_count['count'] ?></pre></td>
        <td><?php echo $topic_row['topic_date'] ?></a></td>
      </tr>

<?php } ?>

</table>

<?php
if( empty($user) ) {
  ?> <br /> <?php 
  echo "<b>-- Login to submit to topics --</b>";
}else{}
?>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
