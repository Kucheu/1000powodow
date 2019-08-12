<?php
header("Location:1");
session_start();


if(isset($_SESSION['login']) && isset($_POST['reason']))
{
    require_once("connect.php");
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);

    $result = $conn->prepare("INSERT INTO reasons(id_user,data,content,status) VALUES ((SELECT id FROM users WHERE login = :login ),:date,:content,0) ");
    $result -> bindParam(":login",$_SESSION['login']);
    $result -> bindParam(":content",$_POST['reason']);
    date_default_timezone_set('CET');
    $date = date("Y-m-d H:i:s");
    $result -> bindParam(":date",$date);
    $result -> execute();
}
?>