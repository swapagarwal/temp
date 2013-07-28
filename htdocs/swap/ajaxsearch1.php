<?php
mysql_connect("localhost","root","");
mysql_select_db("swap");

$a=$_GET['a'];
$query="select distinct state from ajax where state like '$a%'";
$handle=mysql_query($query);
if (mysql_num_rows($handle)==0) echo "No record found";
while($row=mysql_fetch_array($handle)){
	$a=$row[0];
	echo "$a<br>";
}
?>