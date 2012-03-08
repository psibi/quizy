<?php 
require_once('lib/userauth.class.php');
$user->is('ADMIN,USER');

class question
{
	function connect($user,$password,$db)
	{
		$con = mysql_connect("localhost",$user,$password);
		if (!$con)
		{
			die("Could not connect:" . mysql_error());
		}
		$db_selected = mysql_select_db($db,$con);
		if (!$db_selected)
		{
			die("Cannot use $db" . mysql_error());
		}
	}
	
	function get_question($email)
	{
		$result = mysql_query("SELECT point from results where email=\"$email\"");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		$points = $row['0'] + 1;
		
		$result = mysql_query("SELECT question,image from questions where id=\"$points\"");
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		return $row;
	} 
	
	function get_answer($email)
	{
		$result = mysql_query("SELECT point from results where email=\"$email\"");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		$points = $row['0'] + 1;
		
		$result = mysql_query("SELECT answer from questions where id=\"$points\"");
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		return $row['0'];
	}
	
	function check_answer($email,$ans)
	{
		$result = mysql_query("SELECT point from results where email=\"$email\"");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		$points = $row['0'] + 1;
		
		$result = mysql_query("SELECT answer from questions where id=\"$points\"");
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		if ($row['0']==$ans)
		{
			$msg=true;
		}
		else
		{
			$msg = false;
		}
		return $msg;
	}
}

$ques = new question();
$ques->connect("theta12i_sibi","sibitheta","theta12i_log");
#$email=$user->getProperty('email');
//$ques->get_question($email);
#$ques->get_answer($email);

?>