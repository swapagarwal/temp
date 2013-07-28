<?php
include('formviewcontrol.php');
?>
<table align='center' border=2>

<tr>
<td>Username</td><td>Password</td><td>Gender</td>
</tr>

<?php
$i=new control();
$handle=$i->viewC();
while ($row=mysql_fetch_array($handle))
{
	$a=$row[1];
	$b=$row[2];
	$c=$row[3];
	echo "<tr>";
	echo "<td>",$a,"</td>";
	echo "<td>",$b,"</td>";
	echo "<td>",$c,"</td>";
	echo "</tr>";
}
?>

</table>