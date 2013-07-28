<?php
include('model.php');
class control
{
function in($a,$b,$c)
{
$m=new model();
$m->insert($a,$b,$c);
}
}
?>