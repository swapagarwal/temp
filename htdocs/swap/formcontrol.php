<?php
include('formmodel.php');
class control
{
	function insertC($a,$b,$c)
	{
		$i=new model();
		$i->insertM($a,$b,$c);
	}
}
?>