<form method='post' action=''>
<input name='user'/>
<input type='submit' name='submit' value='submit'/>
</form>
<?php
mysql_connect('localhost','root','');
mysql_select_db('network');
session_start();
if(isset($_REQUEST['submit']))
{
	$_SESSION['user']=$_REQUEST['user'];
	echo $_SESSION['user'];
	header('location:profile.php');
}
?>