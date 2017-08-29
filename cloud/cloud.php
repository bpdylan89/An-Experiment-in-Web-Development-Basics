<!-- cloud.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 8/26/2017 -->

<?php

include 'session.php';

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page"> 

<?php 

// DEFINE USER

if(empty($user) ){ 
  include 'forum/cloud-bio.html'; 
}else{

// SET PAGE

//$page_files = $_GET['per_page'];   --   PER PAGE SELECT
$page_files = 4;
$file_count_query="SELECT Count(*) AS 'count' FROM cloud WHERE cloud_id = '{$user['id']}'";
$file_count_set = $conn->query($file_count_query);
$file_count = $file_count_set->fetch(PDO::FETCH_ASSOC);
$file_total = $file_count['count'];
$page_total = ceil($file_total / $page_files);

if(empty($_GET['page'])) {
    $_GET['page'] = 1;
    } else {
    $_GET['page'] = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
}

// FILE SELECT

if(!empty($_FILES['files'])){
  $errors= array();
  $path_to_cloud = "/home/bpdylan8/public_html/cloud/";
  
  foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
    $file_name =$_FILES['files']['name'][$key];
    $file_size =$_FILES['files']['size'][$key];
    $file_tmp =$_FILES['files']['tmp_name'][$key];
    $file_type=$_FILES['files']['type'][$key]; 
        
        if($file_size > 20971520){
          $errors[]='File size must be less than 20 MB';
        }   

// CHECK DUPLICATES

	if (file_exists("$path_to_cloud/$file_name")) { 
	$rename = pathinfo($file_name,PATHINFO_FILENAME);
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);

	$copy = 1;
	while(file_exists("$path_to_cloud/$rename($copy).$ext")) $copy++;
	$file_name = "$rename($copy).$ext";
	}

// UPLOAD

      $upload_query = "INSERT INTO cloud(cloud_id, name, type, size, cloud_date) VALUES('{$user['id']}','$file_name','$file_type','$file_size','$datetime')";
      $cloud_insert = $conn->prepare($upload_query);
      
      if ($cloud_insert->execute()){
        move_uploaded_file($file_tmp,$path_to_cloud.$file_name); 
        sleep(6);
        header('Location: /forum/cloud.php?page='.$page_total);
      }
    }
  $_FILES = NULL;
}

// DELETE

if (isset($_GET['del_id'])){
      $delete_id = $_GET['del_id'];
      $delete_query="DELETE FROM cloud WHERE name = '{$_GET['del_id']}' AND cloud_id = '".$user['id']."'";
      $cloud_delete = $conn->prepare($delete_query);
    if ($cloud_delete->execute()){
      unlink("/home/bpdylan8/public_html/cloud/$delete_id");
      sleep(3);
      header('Location: /forum/cloud.php?page='.$_GET['page']);
      }
}
  
?>

<!-- PER PAGE SELECT -- in progress
<form method="GET" action="forum/cloud.php" style="float:left;margin-left:50px;">
<select name="per_page">
	<option name="4" value="4" selected="selected">4</option>
	<option name="6" value="6">6</option>
	<option name="8" value="8">8</option>
</select>
<a href="/forum/cloud.php?page=<?php echo $_GET['page'].'&per_page='.$_GET['per_page'] ?>">
<input type="button" value="per page" /> </a>
</form>
-->

<form action="forum/cloud.php" method="POST" enctype="multipart/form-data">
  <h1> Cloud Storage</h1>
  <h2>Upload files to cloud</h2>
      <input type="file" multiple="multiple" name="files[]" id="file"/>
      <br /><br />
      <input type="submit" name="upload" value="Upload"/>
</form>

<br />

<table cellspacing="10" cellpadding="5" align="center" width="80%" border="1px solid grey">
  <tr>
    <td>Name</td>
    <td>Size(KB)</td>
    <td>Date</td>
  </tr>

<?php

// LIMITED FILE QUERY and PAGE SELECT

$offset = ($_GET['page'] - 1) * $page_files;
$cloud_set=$conn->query('SELECT * FROM cloud WHERE cloud_id = '.$user['id'].' LIMIT '.$offset.','.$page_files.' ');
$cloud_set->execute();

while($cloud_row=$cloud_set->fetch(PDO::FETCH_ASSOC)){ 
?>
  
      <tr>
        <td width="30%"><a href="cloud/secure.php?file=<?php echo $cloud_row['name'] ?>" download="<?php echo $cloud_row['name'] ?>" >
        	<?php if (strpos($cloud_row['type'], 'image' ) !== false) { ?>
			<img <?php echo 'src="cloud/'. $cloud_row['name']. '" alt="'. $cloud_row['name']. '" height="75"' ?> >
        	<div style="overflow: hidden; text-overflow: ellipsis; max-width: 200px;">&nbsp<?php } echo $cloud_row['name'] ?></div></td>
        <td><?php echo $cloud_row['size'] ?><a href="?del_id=<?php echo $cloud_row['name'] ?>&page=<?php echo $_GET['page'] ?>" onclick="return confirm('Confirm Delete')"> <input type="button" value="Delete"></a></td>
        <td><?php echo $cloud_row['cloud_date'] ?></td>
      </tr>

<?php }
} ?>

</table>

<br>

<?php 

// PAGE LIST << >>

if(isset($_GET['page'])){

  $prev_ellipse = false;
  $next_ellipse = false;
  
  $next_page = $_GET['page'] + 1;
  $previous_page = $_GET['page'] - 1;

  if ($_GET['page'] != 1) {
  ?><a href="forum/cloud.php?page=<?php echo $previous_page ?>" > PREVIOUS << </a> &nbsp 

  <?php }
  if ($file_total>4) { 

	for ($page_number=1;$page_number<=$page_total;$page_number++) { 
	
	if ($page_number < $previous_page && !$prev_ellipse && $_GET['page'] != 3){
		$prev_ellipse = true;
		?>
		<a href="cloud.php?page=1"> (FIRST) </a>
		<?php
		echo "...";
		$page_number = $previous_page - 1;
		} ?>
  <a href="cloud.php?page=<?php echo $page_number ?>" > <?php echo $page_number ?> </a>

  <?php  
  	if ($page_number > $next_page && !$next_ellipse && $_GET['page'] != ($page_total - 2)) {
		$next_ellipse = true;
		$page_number = max(0, $_GET['page'] + 2);
		echo "...";
		?>
		<a href="cloud.php?page=<?php echo $page_total ?>" > (LAST) </a>
		<?php
		break;
		} 
     }
  }
  
  if($next_page<=$page_total){  
  ?>

  &nbsp <a href="forum/cloud.php?page=<?php echo $next_page ?>" > >> NEXT </a>

<?php  }
} 

if ($_GET['page'] > ($page_total)) {
    header('Location: /forum/cloud.php?page='.$page_total);
}
?>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 12/20/2016 -->
