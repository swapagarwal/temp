<script type="text/javascript" language="javascript">
function changeState(s){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp=new XMLHttpRequest();
	}
	else{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			document.getElementById('state').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open('GET','ajax1.php?a='+s,true);
	xmlHttp.send();
}
function changeCity(s){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp=new XMLHttpRequest();
	}
	else{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			document.getElementById('city').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open('GET','ajax2.php?a='+s,true);
	xmlHttp.send();
}
</script>
<?php
mysql_connect("localhost","root","");
mysql_select_db("swap");

echo "<select name='country' onchange='changeState(this.value)'>";
$query="select distinct country from ajax";
$handle=mysql_query($query);
while($row=mysql_fetch_array($handle)){
	$a=$row[0];
	echo "<option value='$a'>$a</option>";
}
echo "</select>";
?>

<div id='state'>
</div>
<div id='city'>
</div>