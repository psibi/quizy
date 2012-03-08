<?php 
require_once('lib/userauth.class.php');
$user->is('ADMIN,USER');
class points
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
	
	function check_registered($email)
	{
		$result = mysql_query("SELECT email from results where email=\"$email\"");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		$row = mysql_fetch_array($result);
		if ($row['0']!=$email)
		{
			//If they are not registered, then register them.
			$result = mysql_query("INSERT INTO results (email,point) VALUES (\"$email\",'0')");
		}		
	}
	
	function get_points($email)
	{
		$result = mysql_query("SELECT point from results where email=\"$email\"");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		return $row['0'];
	}
	
	function update_points($email)
	{
		$result = mysql_query("SELECT point from results where email=\"$email\"");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		$row = mysql_fetch_array($result);
		$newpoint = $row['0'] + 1;
		//echo $newpoint
		
		$result = mysql_query("UPDATE results SET point=\"$newpoint\" WHERE email=\"$email\"");
		if (!result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
	}
	
	function top_ranks()
	{
		$result = mysql_query("SELECT email,point FROM results ORDER BY point DESC");
		
		if (!$result)
		{
			echo "Query Unsuccessful" . mysql_error();
		}
		
		return $result;
	}
	
}

$point = new points();
$point->connect("theta12i_sibi","sibitheta","theta12i_log");
//$email=$user->getProperty('email');
//$point->check_registered($email);
//$point->get_points($email);
//$point->update_points($email);


?>