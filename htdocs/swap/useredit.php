<?php
session_start();
if ($_SESSION['id']==0) header('location:usersigninform.php');
$id=$_SESSION['id'];
$p=$_GET['p'];
mysql_connect('localhost','root','');
mysql_select_db('swap');
$query="select * from profile where id='$id'";
$r=mysql_query($query);
$i=mysql_fetch_array($r);
$a=$i[1];
$b=$i[2];
$c=$i[3];
$d=$i[4];
$e=$i[5];
$f=$i[6];
$g='upload/'.$f;
?>

<form action=
<?php
if ($p) echo "'userupdate.php?p=1'";
else echo "'userupdate.php?p=0'";
?>
method='post' enctype='multipart/form-data'>
<table align='center' border=2>

<tr>
<td>Username:</td>
<td><input name='username' value=<?php echo $a; ?>></td>
</tr>

<tr>
<td>First Name:</td>
<td><input name='firstname' value=<?php echo $b; ?>></td>
</tr>

<tr>
<td>Last Name:</td>
<td><input name='lastname' value=<?php echo $c; ?>></td>
</tr>

<tr>
<td>Email:</td>
<td><input type='email' name='email' value=<?php echo $d; ?>></td>
</tr>

<tr>
<td>Password:</td>
<td><input type='password' name='password' value=<?php echo $e; ?>></td>
</tr>

<tr>
<td>Photo:</td>
<td>
<?php
if ($p) echo "<input type='file' name='photo'>";
else echo "<img height=200 width=200 src='$g'><a href='useredit.php?p=1'>Change Photo</a>";
?>
</td>
</tr>

<tr>
<td></td>
<td align='center'><input type='submit' value='Update'></td>
</tr>

</table>
</form>