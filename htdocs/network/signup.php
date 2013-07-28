<form action='' method='post'>
<table align=center border=2>

<tr>
<td>Name:</td>
<td><input name='name'/></td>
</tr>

<tr>
<td>Desired Username:</td>
<td><input name='username'/></td>
</tr>

<tr>
<td>Email:</td>
<td><input name='email' type='email'/></td>
</tr>

<tr>
<td>Password:</td>
<td><input name='password' type='password'/></td>
</tr>

<tr>
<td>Birthday:</td>
<td>
<select name='date'><?php for($i=1;$i<=31;$i++) echo "<option>",$i,"</option>"; ?></select>
<select name='month'><?php for($i=1;$i<=12;$i++) echo "<option>",$i,"</option>"; ?></select>
<select name='year'><?php for($i=2013;$i>=1900;$i--) echo "<option>",$i,"</option>"; ?></select>
</td>
</tr>

<tr>
<td>Gender:</td>
<td>
<input name='gender' type='radio' value='Male'>Male</input>
<input name='gender' type='radio' value='Female'>Female</input>
</td>
</tr>

<tr>
<td></td>
<td align=center><input name='submit' type='submit' value='Sign Up'/></td>
</tr>

</table>
</form>

<?php
if (isset($_POST['submit']))
{
	mysql_connect('localhost','root','');
	mysql_select_db('network');
	$a=$_POST['name'];
	$b=$_POST['username'];
	$c=$_POST['email'];
	$d=$_POST['password'];
	$e=$_POST['date'].'/'.$_POST['month'].'/'.$_POST['year'];
	$f=$_POST['gender'];
	$query="insert into users(name,username,email,password,birthday,gender)values('$a','$b','$c','$d','$e','$f')";
	$handle=mysql_query($query);
	if ($handle)
	{
		$query="select * from users where username='$b' and password='$d'";
		$row=mysql_fetch_array(mysql_query($query));
		$query="create table $row[2]__posts(post char(160),postedby char(160),time int)";
		mysql_query($query);
		$query="create table $row[2]__friends(name char(160),status int)";
		mysql_query($query);
		$query="create table $row[2]__messages(message char(160),sender char(160),time int)";
		mysql_query($query);
		//$query="create table $row[2]__friends(name char(160),status int)";
		//mysql_query($query);
		//$query="create table $row[2]__posts(post char(160),postedby int)";
		//mysql_query($query);
		echo "You have signed up successfully.";
		//echo "<a href='profile.php?a=$b'>Profile</a>";
	}
	else echo "Please try again.";
}
?>