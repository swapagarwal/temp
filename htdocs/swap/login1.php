<?php  session_start();
$a=$_POST["unm"];

if ($_SESSION["sss"] && $_SESSION["sss"]==$a) {}
else {$_SESSION["sss"]=$a;$_SESSION["count"]=0;}

$_SESSION["sss"]=$a;
$b=$_POST["pass"];
if(empty($a) || empty($b))
{
if(empty($a))
$_SESSION["user"]="Please Enter User NAme";

if(empty($b))
$_SESSION["pass"]="Please Enter Password";
header("location:login.php");
}
else
{
if($a=="Admin" && $b=="123")
{
header("location:home1.php");
}
else
{
if ($_SESSION["count"]) $_SESSION["count"]+=1;
else $_SESSION["count"]=1;
$_SESSION["err"]="Invalid UserName or Password ";
header("location:login.php");
}
}