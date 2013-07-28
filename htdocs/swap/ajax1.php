<?php
mysql_connect("localhost","root","");
mysql_select_db("swap");

$a=$_GET['a'];
echo "<select name='state' onchange='changeCity(this.value)'>";
$query="select distinct state from ajax where country='$a'";
$handle=mysql_query($query);
while($row=mysql_fetch_array($handle)){
	$a=$row[0];
	echo "<option value='$a'>$a</option>";
}
echo "</select>";
?>