<?php
require_once('lib/userauth.class.php');
require_once('question.php');
require_once ('points.php');
$user->is('ADMIN,USER');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=1024, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <title>Enigma</title>
    
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
   </head>
  <body>
<?php 
$ans = $_POST["textarea"];
$email=$user->getProperty('email');
$check = $ques->check_answer($email,md5($ans));
if ($check==true)
{
	echo "<img src=\"wimages/right.jpg\" />"; 
	$point->update_points($email);
	echo '<META HTTP-EQUIV="Refresh" Content="1; URL=forms.php">';
}
else 
{$total = "6"; 

// Change to the type of files to use eg. .jpg or .gif 
$file_type = ".jpg"; 

// Change to the location of the folder containing the images 
$image_folder = "wimages/"; 

// You do not need to edit below this line 

$start = "1"; 

$random = mt_rand($start, $total); 

$image_name = $random . $file_type; 

echo "<img src=\"$image_folder/$image_name\" alt=\"$image_name\" />"; 
	
echo "<br/> Incorrect Answer, Press back button in your browser.";
}
?>  
  </body>
  </html>