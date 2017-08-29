<!-- projects.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->

<?php

include 'session.php';

include 'head.html'; 

?>

<body>
<div id="wrap">

<?php include 'header.php'; ?>

<div class="page">	

<div class="bio">

<h2>Projects
</h2>

</div>

<div class="skills">

<p style="text-align:left;"><b><u>Web Development
</u></b></p>

<p>bpdylan89.x10host.com is hosted through x10hosting.com's free managed services. Using the tools provided in the online integrated control panel(cpanel) I can easily log on from any browser to manage my websites and databases.<br />
<br />
In simple x10hosting.com server computers are hosting this website. I am able to log onto x10hosting.com and modify my website using the cpanel to create and alter files. 
</p>

<p>Below is a list of the files that make up bpdylan89.x10host.com
</p><br /><br />

<?php 

// LIST FILES FROM html FOLDER

$files = array_diff(scandir('/home/bpdylan8/public_html/'), array('.', '..', '.ftpquota', '.htaccess', 'sitemap.xml', 'robots.txt', 'visitors.log'));

foreach($files as $file){

	if(!is_dir($file)){
?>	

<ul style="margin-left:0px;">
	<li style="margin-top:-50px;width:360px"><a href="/project-view.php?id=<?php echo $file ?>"><?php echo $file ?></a></li>
</ul>

<?php } 

} ?>

<p id="app_open" style="text-align:left;"><b><u>Android App Development
</u></p></b>
      
<p>I have been working with various integrated development environments(IDE), mostly Netbeans and Android Studio, to create, edit, and compile Java code. 
Using both the Java Development Kit(JDK) and Android Software Development Kit(SDK) to properly configure the IDE to make a project template.  
Tested either via virtual machine on my PC or Android Debug Bridge(ADB) using my device.<br />
<br />
Through the creation of a basic Ouija Board I was able to learn about the construct and lifecycle of a Java based Android App. 
Download and install the .apk <a href="/uploads/Ouija_Java_Android.apk" download="Ouija_Java_Android.apk">here</a>.<br />

</p>

<p>The whole project folder is available for download in .zip form <a href="/uploads/ouija(javatest).zip" download="ouija(javatest).zip">here</a>.
</p>

</div>

</div>

<?php include 'footer.php'; ?>

</div>
</body>
</html>

<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->