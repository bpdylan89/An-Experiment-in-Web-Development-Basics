<!-- reply_edit.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

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
<h2>REPLY</h2>
<br />

<?php    

// REPLY TO EDIT

 $reply_sql="SELECT * FROM reply WHERE reply_id = '{$_GET['id']}' ";
 $reply_set=$conn->query($reply_sql);
 $reply_row= $reply_set->fetch(PDO::FETCH_ASSOC);
?>

"<a href="forum/posts.php?id=<?php echo $reply_row['reply_post']?>"><?php echo $reply_row['reply_content']?></a>"
 <br /><br />

<?php 

// SUBMIT EDITED REPLY

if(!empty($_POST['reply'])){
    $reply = filter_var($_POST['reply'], FILTER_SANITIZE_STRING);
    $reply = str_replace("'", "", $reply);
    $reply_query = "UPDATE reply SET reply_content = '{$reply}', reply_date = '{$datetime}' WHERE reply_id = '{$_GET['id']}' AND reply_auth = '{$user['username']}'";
    $reply_update = $conn->prepare($reply_query);
      
      if ($reply_update->execute()){
        $_POST = NULL;
        header("Location: /forum/posts.php?id=".$reply_row['reply_post']);
      }else{}
}

// DELETE REPLY

if (isset($_GET['del_id'])){
      $delete_query="DELETE FROM reply WHERE reply_id = '{$_GET['del_id']}' AND reply_auth = '{$user['username']}'";
      $reply_delete = $conn->prepare($delete_query);
    if ($reply_delete->execute()){
      header("Location: /forum/forum.php");
    }
}
?>

<form method="POST">
  <h2>Edit reply</h2>
      <a href="?del_id=<?php echo $_GET['id'] ?>" onclick="return confirm('Confirm Delete')">(DELETE)</a>
      <br />
      <textarea type="text" placeholder="Edit reply" name="reply" /></textarea>
      </br>
      <input type="submit" value="Edit reply">
</form>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
