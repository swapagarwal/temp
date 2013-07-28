<?php
include('formviewmodel.php');

class control
{
	function viewC()
	{
		$i=new model();
		return $i->viewM();
	}
}
?>