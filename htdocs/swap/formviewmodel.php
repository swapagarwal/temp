<?php
class model
{
	function model()
	{
		mysql_connect('localhost','root','');
		mysql_select_db('swap');
	}
	function viewM()
	{
		$query="select * from form";
		$handle=mysql_query($query);
		return $handle;
	}
}
?>