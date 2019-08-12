<?PHP
header("Location: 1");
if(isset($_POST['login']) && isset($_POST['password']))
{
    session_start();
    require_once "connect.php";
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    $result = $conn->prepare("SELECT * FROM users INNER JOIN permissions on users.id = permissions.id_user WHERE login = :login LIMIT 1");
    $result -> bindParam(":login",$_POST['login']);
    $result->execute();
    $row = $result->fetch();
    if(!$row)
    {
        $_SESSION['alert'] = "Nie ma takiego użytkownika";
        exit();
    }
    if(!password_verify($_POST['password'],$row['password']))
    {
        $_SESSION['alert'] = "Złe hasło";
        exit();
    }
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['permission'] = $row['permission'];

    $file = fopen('logs.txt', 'a');
    fputs($file,'Login: '.$_SESSION['login'].' |date: '.date('Y-m-d H:i:s').' |ip: '.$_SERVER['REMOTE_ADDR']."\n");
    fclose($file);


}

?>