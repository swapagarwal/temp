<?php
mysql_connect("localhost","root","");
mysql_select_db("swap");

$a=$_GET['a'];
echo "<select name='city'>";
$query="select * from ajax where state='$a'";
$handle=mysql_query($query);
while($row=mysql_fetch_array($handle)){
	$a=$row[3];
	echo "<option value='$a'>$a</option>";
}
echo "</select>";
?>