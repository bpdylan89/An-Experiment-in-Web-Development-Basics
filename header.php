<!-- header.php - Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->


<div id="headdrop">

<div id="titlebar">
    <div class="header">
        <a href="/" title="bpdylan89" > BPDYLAN89</a>
    </div>
<div class="titlelist">
        <input type="checkbox" id="navbox" class="navbox" />
        <label for="navbox"></label>
            <ul class="navigation">
                <li><a href="/" title="bpdylan89" >HOME</a></li>
                <li><a href="forum.php" title="forum" >FORUM</a></li>
                <li><a href="cloud.php" title="cloud">CLOUD</a></li>
                <li><a href="contact.php" title="contact">CONTACT</a></li>
                <li>
                <?php // CHECK USER
                	if (empty($user)){?><a href="login.php" title="login">LOGIN</a><?php }else{ ?><a href="logout.php" title="logout">LOGOUT</a><?php } ?></li>
            </ul>
</div>
</div>

<div class="drop">
    <img src="/images/bpdylan89.png" title="bpdylan89" width="300px" alt="bpdylan89" />
    <p style="font-size:28px;margin-top:-15px;">"Things should be made as simple as possible, but not any simpler"</p>
    <p style="text-align:center;padding-left:350px;margin-top:-10px;"><i>-Albert Einstein</i></p>
</div>

</div>


<!-- Benjamin Dylan Prescott - bpdylan89.x10host.com - 1/16/2017 -->