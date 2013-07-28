<?php
class model
{
function model()
{
mysql_connect("localhost","root","");
mysql_select_db("swap")or die("DataBase Not Found".mysql_error());
}

function insert($a,$b,$c)
{
$sql="insert into form(username,password,gender)values('$a','$b','$c')";
$r=mysql_query($sql);
if($r)
echo "Insert";
else
echo "not";
}
}
?>