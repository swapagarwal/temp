<table align='center' border=2>

<tr>
<td></td><td>Name</td><td>Size</td><td>Type</td>
</tr>

<?php
mysql_connect('localhost','root','');
mysql_select_db('swap');
$query="select * from file where type like 'image/_%'";
$handle=mysql_query($query);
while ($row=mysql_fetch_array($handle))
{
	$a=$row[1];
	$path='upload/'.$a;
	$b=$row[2];
	$c=$row[3];
	echo "<tr>";
	echo "<td><a href='$path'>Open</a></td>";
	echo "<td>",$a,"</td>";
	echo "<td>",$b,"</td>";
	echo "<td>",$c,"</td>";
	echo "</tr>";
}
?>

</table>