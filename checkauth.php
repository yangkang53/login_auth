<?php

session_start();

//检测是否登录，已登录跳转到后台首页
if(!isset($_SESSION['authenticated'])){
	$_SESSION['userurl'] = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; 
	header("Location:./login_auth/index.html");
}


?>
