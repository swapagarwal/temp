<form action='' method='post' enctype='multipart/form-data'>
<table align='center' border=2>

<tr>
<td>Select a file:</td>
<td><input type='file' name='file'></td>
</tr>

<tr>
<td></td>
<td align='center'><input type='submit' name='submit' value='Upload'></td>
</tr>

</table>
</form>

<?php
if (isset($_POST['submit']))
{
	mysql_connect('localhost','root','');
	mysql_select_db('swap');
	if ($_FILES['file']['name']!="")
	{
		$i=move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$_FILES['file']['name']);
		if ($i)
		{
			$a=$_FILES['file']['name'];
			$b=$_FILES['file']['size'];
			$c=$_FILES['file']['type'];
			$query="insert into file(name,size,type)values('$a','$b','$c')";
			$handle=mysql_query($query);
			if ($handle)
			{
				echo "Success";
			}else echo "Database couldn't be updated";
		}else echo "Couldn't be uploaded";
	}else echo "No file selected";
}
?>