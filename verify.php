<?php
session_start();
if(isset($_SESSION['url']))
{
$url = $_SESSION['url'];
header("Location:$url");
}
else
{
header("Location:1");
}
if(isset($_SESSION['permission']) && isset($_GET['id']))
{
    if($_SESSION['permission'] == 'moder' || $_SESSION['permission'] == 'admin')
    {
        require_once("connect.php");
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);

        $result = $conn->prepare("UPDATE `reasons` SET `status` = '1', date_verify=:date  WHERE `reasons`.`id` = :id;");
        $result->bindParam(":id",$_GET['id']);
        date_default_timezone_set('CET');
        $date = date("Y-m-d H:i:s");
        $result->bindParam(":date",$date);
        $result->execute();
    }
}


?>