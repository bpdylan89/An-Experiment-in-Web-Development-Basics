<!-- forum.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page">

<h1>FORUM</h1>
<?php 

// CREATE CATEGORY

if(empty($user)){}else{ ?>
    <a href="cloud/new-category.php"><input type="submit" value="Create Category"></a>
<?php } ?>

<table cellpadding="20" align="center" width="80%" border="1px solid grey">
    <tr>
    <td width="30%">Category</td>
    <td width="50%">Description</td>
    </tr>

<?php

// CATEGORY TABLE

 $category_sql="SELECT * FROM category ORDER BY title ASC";
 $category_set=$conn->query($category_sql);
 while($category_row=$category_set->fetch(PDO::FETCH_ASSOC))
 { ?>
        <tr>
        <td><a href='cloud/category.php?id=<?php echo $category_row['id'] ?>'><?php echo $category_row['title'] ?></a></td>
        <td><?php echo $category_row['description'] ?></td>
        </tr>
<?php } ?>

</table>

<?php
if( empty($user) ) {
  ?> <br /> <?php 
  echo "<b>-- Login to submit to forum --</b>";
}else{}
?>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->
