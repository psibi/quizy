	<?php

require_once('lib/userauth.class.php');
require_once('lib/validation.class.php');

if(isset($_POST['doLogin'])) {
	// Some cleaning
	$_POST = $inputFilter->process($_POST);

	$validate->username($_POST['user']);
	$validate->password($_POST['pass']);
	
	if($form->numErrors == 0) {
		// If the password has not been sent hashed by javascript, find the sha1 hash now
		if( !isset($_POST['hashed']) || $_POST['hashed'] != 1 )
			$_POST['pass'] = sha1($_POST['pass']);
		if($user->login($_POST['user'], $_POST['pass'], isset($_POST['remember']) ? true: false)) {
			if( empty($_POST['to']) )
				$to = trim(LOGIN_REDIRECT,'/ ');
			else {
				$to = preg_replace('/\.\.\/|\.\/|[\?]|<|>|=|:/','',$_POST['to']);
			}
			$user->redirect($user->getActualPath(true).$to);
		}
	}
	else {
		$_SESSION['valueArray'] = $_POST;
	    $_SESSION['errorArray'] = $form->getErrorArray();
		$user->redirect($_SERVER['PHP_SELF']);
	}
}

else if(isset($_SESSION[SESSION_VARIABLE])) {
echo '<META HTTP-EQUIV="Refresh" Content="1; URL=forms.php">';
/*	echo "Welcome ".$user->getProperty('user');
	echo "<br /> You are already logged in. Click <a href='".$user->actualPath."account.php?do=logout'>here to logout</a>";
	*/
}

else {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=1024, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <title>Theta 12</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/icons.css" />
    <link rel="stylesheet" href="./css/formalize.css" />
    <link rel="stylesheet" href="./css/checkboxes.css" />
    <link rel="stylesheet" href="./css/sourcerer.css" />
    <link rel="stylesheet" href="./css/jqueryui.css" />
    <link rel="stylesheet" href="./css/tipsy.css" />
    <link rel="stylesheet" href="./css/calendar.css" />
    <link rel="stylesheet" href="./css/tags.css" />
    <link rel="stylesheet" href="./css/visualize.css" />
    <link rel="stylesheet" href="./css/fonts.css" />
    <link rel="stylesheet" href="./css/selectboxes.css" />
    <link rel="stylesheet" href="./css/960.css" />
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" media="all and (orientation:portrait)" href="./css/portrait.css" />
    <link rel="apple-touch-icon" href="./apple-touch-icon-precomposed.png" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="inc/form.css" />
    
    <!--[if lt IE 9]>
    <script src="./js/html5shiv.js"></script>
    <script src="./js/excanvas.js"></script>
    <![endif]-->
    
    <!-- JavaScript -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jqueryui.min.js"></script>
    <script src="./js/jquery.cookies.js"></script>
    <script src="./js/jquery.pjax.js"></script>
    <script src="./js/formalize.min.js"></script>
    <script src="./js/jquery.metadata.js"></script>
    <script src="./js/jquery.validate.js"></script>
    <script src="./js/jquery.checkboxes.js"></script>
    <script src="./js/jquery.chosen.js"></script>
    <script src="./js/jquery.fileinput.js"></script>
    <script src="./js/jquery.datatables.js"></script>
    <script src="./js/jquery.sourcerer.js"></script>
    <script src="./js/jquery.tipsy.js"></script>
    <script src="./js/jquery.calendar.js"></script>
    <script src="./js/jquery.inputtags.min.js"></script>
    <script src="./js/jquery.wymeditor.js"></script>
    <script src="./js/jquery.livequery.js"></script>
    <script src="./js/jquery.flot.min.js"></script>
    <script src="./js/application.js"></script>
	<script type="text/javascript" src="inc/sha1.js"></script>
	<script type="text/javascript" src="inc/validation.js"></script>	

  </head>


<body id="login">
    <div id="login_container">
  <div id="login_form">
	<form name="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" autocomplete="off">
<p>		<input type="text" name="user" id="user" placeholder="Username" class="{validate: {required: true}} maxlength="24" value="<? echo $form->value("user"); ?>" tabindex="1" /></p>
		<span class="formError" id="userError"><? echo $form->error("user"); ?></span>

<p>		<input type="password" name="pass" id="pass" value="" tabindex="2"   placeholder="Password" class="{validate: {required: true}}"/> </p>
		<span class="formError" id="passError"><? echo $form->error("pass"); ?></span>
		
	
		<input type="submit" class="button blue" name="doLogin" id="doLogin" onclick = 'return processForm()' value="Login" />


		<br /><br /><a href="<?php echo $user->actualPath; ?>signup.php">Get an account</a>
		<script type="text/javascript">				
		document.write('<input type="hidden" name="hashed" value="1" />');
		</script>
</form>
</div>
<script type="text/javascript">
function processForm() {
	span = document.getElementsByTagName("span");
	for(i=0;i<span.length;i++)
		span[i].innerHTML = '';
		
	pass = document.getElementById('pass').value;
	user = document.getElementById('user').value;
	
	if(username(user) && password(pass,'passError')) {
		hash = hex_sha1(document.getElementById('pass').value);
		document.loginForm.pass.value = hash;
		return true;
	}
	return false;
}
</script>
<?php
}
?>