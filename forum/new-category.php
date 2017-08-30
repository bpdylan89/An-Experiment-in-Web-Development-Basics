<!-- new-cat.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

// CHECK USER

if( !empty($user) ){
  }else{
  header("Location: /userlogin/login.php");
}

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php 

include 'header.php';

// SUBMIT NEW CATEGORY

if(!empty($_POST['category']) && !empty($_POST['description'])){
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING); 
    $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
    $description = str_replace("'", "", $description); 
    $category = str_replace("'", "", $category);
      
      $category_query="INSERT INTO category(title, description) VALUES('{$category}','{$description}')";
      $category_insert = $conn->prepare($category_query);
      
      if ($category_insert->execute()){
        $_POST = NULL;
        header("Location: /forum/forum.php");
      }else{}
}?>

<div class="page">
	<form method="POST">

		<h1>FORUM</h1>
  	<h2>Create New Category</h2>
		
		Category: <input type="text" placeholder="New Category" name="category"><br />
		Description: <br /><textarea type="text" placeholder="Description" name="description" /></textarea></br>
		<input type="submit" value="Create Category">

	</form>
</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
