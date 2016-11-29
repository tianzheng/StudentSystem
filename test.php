<?php
session_start();
session_destroy();
if(isset($_SESSION['views']))
{
    $_SESSION['views']=$_SESSION['views']+1;
}
else
{
    $_SESSION['views']=uniqid();
}
echo "浏览量：". $_SESSION['views'];
?>