<?PHP
session_start();
if(!isset($_POST['login']) || !isset($_POST['password']) || !isset($_POST['passworda']) || !isset($_POST['email']))
{
    $_SESSION['alert'] = "Brak danych";
    header("Location:rejestracja");
    exit();
}
if(!check_password($_POST['password']))
{
    $_SESSION['alert'] = "Hasło nie spełnia wymogów";
    header("Location:rejestracja");
    exit();
}
if($_POST['password'] != $_POST['passworda'])
{
    $_SESSION['alert'] = "Hasła się nie zgadzają";
    header("Location:rejestracja");
    exit();
}

require_once "connect.php";
 $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
 $result = $conn->prepare("SELECT Count(*) FROM users WHERE login = :login OR email = :email");
 $result -> bindParam(":login",$_POST['login']);
 $result -> bindParam(":email",$_POST['email']);
 $result->execute();
if($result->fetchColumn() != 0)
{
    $_SESSION['alert'] = "Taki użytkownik już istnieje";
    header("Location:rejestracja");
    exit();
}
$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
$result = $conn->prepare("INSERT INTO users(login,password,email) VALUES (:login,:password,:email);INSERT INTO permissions(permission,id_user) VALUES ('user',LAST_INSERT_ID())");
$result -> bindParam(":login",$_POST['login']);
$result -> bindParam(":password",$password);
$result -> bindParam(":email",$_POST['email']);
$result -> execute();

header("Location:1");
    exit();

function check_password($pass)
{   
    return true;
}

?>