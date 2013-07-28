<?php
class model
{
	function model()
	{
		mysql_connect('localhost','root','');
		mysql_select_db('swap');
	}
	function insertM($a,$b,$c)
	{
	$query="insert into form (username,password,gender)values('$a','$b','$c')";
	$handle=mysql_query($query);
	if ($handle)
	{
		echo "Successful.";
	}
	else
	{
		echo "Please Try Again.";
	}
	}
}


?>