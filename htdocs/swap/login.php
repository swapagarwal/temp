<?php  session_start();

?>
<form action='login1.php' method='post'>
<table border='1' align='center'>
<tR>
<td colspan='2' align='center'>
<?php
if(isset($_SESSION["err"]))
{
	if ($_SESSION["err"]=="")
	{
		$_SESSION["count"]=0;
	}
	else
	{
		echo $_SESSION["err"];
		if(isset($_SESSION["count"]))
			echo $_SESSION["count"];
	}
}
?>
</td>
</tr>
<tr>
<td>User Name:</td>
<td><input type='text' name='unm' value='<?php if(isset($_SESSION["sss"])) echo $_SESSION["sss"];  ?>'><?php if(isset($_SESSION["user"])) echo $_SESSION["user"];  ?>
</td>
</tR>
<tr>
<td>Password:</td>
<td><input type='password' name='pass' value=''><?php if(isset($_SESSION["user"])) echo $_SESSION["pass"] ?>
</td>
</tR>
<tR>
<td colspan='2' align='center'>
<?php
if ($_SESSION["count"])
{
	if ($_SESSION["count"]<3)
	{
		echo "<input type='submit' value='send'>";
	}
	else echo "<input type='submit' value='send' disabled>";
}
else echo "<input type='submit' value='send'>";
?>

</td>
</tR>
</form>
<?php
$_SESSION["err"]="";
$_SESSION["user"]="";
$_SESSION["pass"]="";
?>