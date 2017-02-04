<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css" />
		
	<style type="text/css">
	<!--
	-->
	</style>
</head>

<body onLoad="document.login.key.focus();">

	  <div id="stripe">
	  &nbsp;
	  </div>
	  	
	  <div id="container">
	  
		<div id="logoArea">
           <img src="yubicoLogo.jpg" alt="Yubico Logo" width="150" height="75"/>
		</div>
		
		<div id="greenBarContent">
			<div id="greenBarImage">
				<img src="yubikey.jpg" alt="yubikey" width="150" height="89"/>
			</div>
			<div id="greenBarText">
				<h3>Basic Login Page</h3>
			</div>
		</div>
		<div id="bottomContent">

<?php include 'authenticate.php';
if ($authenticated == 0) { ?>
	<h1 class="ok">Congratulations</h1>
	<p>You have been successfully authenticated with the YubiKey.
	
<?php	
	session_start();

    $_SESSION['authenticated'] = '0';
	
	if(isset($_SESSION['userurl'])){ 
//会话中有要跳转的页面 
$url2 = $_SESSION['userurl']; 
} 

//0.5s后跳转 
echo "<meta http-equiv=\"refresh\" content=\"1;url=$url2\">"; 

exit;

 } else { ?>
	<ol style="list-style-position: outside;">
	<li>Place your YubiKey in the USB-port.</li>
	<li>Touch YubiKey button.</li>
	</ol>
	<br />

<?php if ($authenticated > 0) { ?>
		<h1 class="fail">Login failure. Please try again. </h1>
<?php } ?>

	<form name="login" method="post" style="border: 1px solid #e5e5e5; background-color: #f1f1f1; padding: 10px; margin: 0px; font-size:12px;"
	onSubmit="key.value = (key.value).toLowerCase(); return true;">
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr>
			<td>
					<b>YubiKey</b>
			</td>
			<td>
				  <input autocomplete="off" type="text" name="key" class="yubiKeyInput">
			</td>
		</tr>
	</table>
	</form>

<?php } ?>

	<br /><br />
	<!--<p>&raquo; <a href="one_factor.php">Try again</a></p>-->
	<br /><br />



</div>
</body>
</html>
