<script type="text/javascript" language="javascript">
function check(s){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp=new XMLHttpRequest();
	}
	else{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			document.getElementById('name').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open('GET','ajaxlogin1.php?a='+s,true);
	xmlHttp.send();
}
</script>
<form>
<table>

<tr>
<td>Username :</td>
<td><input name='username' onkeydown='check(this.value)' onkeyup='check(this.value)'/></td>
<td id='name'></td>
</tr>

<tr>
<td>Password :</td>
<td><input type='password' name='password'/></td>
</tr>

<tr>
<td></td>
<td align=center><input type='submit' value='login' name='Slogin'/></td>
</tr>

</table>
</form>

<div id='error'/>