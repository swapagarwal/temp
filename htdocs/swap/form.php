<?php
include('formcontrol.php');
?>
<form action='' method='post'>
<table align='center' border=2>

<tr>
<td align='right'>Username:</td>
<td><input name='username' type='text'></td>
</tr>

<tr>
<td align='right'>Password:</td>
<td><input type='password' name='password'></td>
</tr>

<tr>
<td align='right'>Gender:</td>
<td align='center'>
<input type='radio' name='gender' value='male'>Male</input>
<input type='radio' name='gender' value='female'>Female</input>
</td>
</tr>

<tr>
<td></td>
<td align='center'><input type='submit' value='Sign Up' name='submit'></td>
</tr>

</table>
</form>
<?php
if(isset($_REQUEST["submit"]))
{
$a=$_POST["username"];
$b=$_POST["password"];
$c=$_POST["gender"];
$i=new control();
$i->insertC($a,$b,$c);
}
?>