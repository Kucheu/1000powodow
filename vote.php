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

if(isset($_SESSION['login']) && isset($_GET['id']))
{
        require_once("connect.php");
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);

        $result = $conn->prepare("Select Count(*) from evaluations where id_user = (Select id from users where login = :login) and id_reasons = :id");
        $result->bindParam(":id",$_GET['id']);
        $result->bindParam(":login",$_SESSION['login']);
        $result->execute();
        if($result->fetchColumn() == 0)
        {
            $result = $conn->prepare("INSERT INTO evaluations (id_user,id_reasons) VALUES ((SELECT id FROM users where login = :login),:id)");
            $result->bindParam(":id",$_GET['id']);
            $result->bindParam(":login",$_SESSION['login']);
            $result->execute();
        }
}


?>