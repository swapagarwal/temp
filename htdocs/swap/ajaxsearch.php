<script type="text/javascript" language="javascript">
function search(s){
	var xmlHttp;
	if(window.XMLHttpRequest){
		xmlHttp=new XMLHttpRequest();
	}
	else{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlHttp.onreadystatechange=function(){
		if(xmlHttp.readyState==4){
			document.getElementById('result').innerHTML=xmlHttp.responseText;
		}
	}
	xmlHttp.open('GET','ajaxsearch1.php?a='+s,true);
	xmlHttp.send();
}
</script>
<input name='search' onkeyup='search(this.value)'/>
<div id='result'>
No record found
</div>