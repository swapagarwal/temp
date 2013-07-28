<form action='' method='post'>
<table align=center border=2>

<tr>
<td>Username:</td>
<td><input name='username'/></td>
</tr>

<tr>
<td>Password:</td>
<td><input name='password' type='password'/></td>
</tr>

<tr>
<td></td>
<td align=center><input name='submit' type='submit' value='Sign In'/></td>
</tr>

</table>
</form>

<?php
session_start();
if ($_SESSION['user']) header('location:profile.php');
if (isset($_POST['submit']))
{
	mysql_connect('localhost','root','');
	mysql_select_db('network');
	$a=$_POST['username'];
	$b=$_POST['password'];
	$query="select * from users where username='$a' and password='$b'";
	$row=mysql_fetch_array(mysql_query($query));
	if ($row)
	{
		echo "You have signed in successfully.";
		$_SESSION['user']=$a;
		echo "<a href='profile.php'>Profile</a>";
		header('location:profile.php');
	}
	else echo "Please try again.";
}
?>