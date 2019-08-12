<?PHP

function post($page , $homepage)
{
    require_once "connect.php";
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
    
    if($homepage)
    {
        $result = $conn->prepare("Select reasons.id,reasons.content,reasons.data,Count(evaluations.id) as 'count' from reasons left join evaluations ON reasons.id = evaluations.id_reasons WHERE status = :status GROUP BY reasons.id ORDER BY date_verify DESC LIMIT 10 OFFSET :number");
        $result->bindValue(":status",true); //Jeżeli strona główna
    }
    else
    {
        $result = $conn->prepare("Select reasons.id,reasons.content,reasons.data,Count(evaluations.id) as 'count' from reasons left join evaluations ON reasons.id = evaluations.id_reasons WHERE status = :status GROUP BY reasons.id ORDER BY data DESC LIMIT 10 OFFSET :number");
        $result->bindValue(":status",false); //jeżeli poczekalnia
    }
    
    $result->bindValue(":number",10*($page-1), PDO::PARAM_INT); //określa, od którego rekordu ma wybierać
        
    $result->execute();
    foreach($result as $row) //wyświetla na stronie konretne wpisy
    {
        $a1 = $row['content'];
        $a2 = $row['data'];
        $a3 = $row['id'];
        $a4 = $row['count'];
        echo "<div class='content' id='$a3'>
        
        <div class='date'>$a2</div>
        <p>$a1</p>";
        if(!$homepage && isset($_SESSION['permission']))
            if($_SESSION['permission'] == 'moder' || $_SESSION['permission'] == 'admin')
                echo "<a href='verify.php?id=$a3'><img class='check-img' src='pictures/check.png' /></a>";
        if(isset($_SESSION['login']))
        {
            echo "<div class=voteimg><a href=vote.php?id=$a3><img src='pictures/plus.png'></a>$a4</div>";
        }
        echo "</div>";
    }
    $result = $conn->prepare("SELECT COUNT(*) FROM reasons WHERE status = :status "); // pobiera liczbę rekordów pasujących do tego działu
    if($homepage)
    {
        $result->bindValue(":status",TRUE);
        $link = ''; //Potrzebne, do ustalenia gdzie mają prowadzić odnośniki
    }
    else
    {
        $result->bindValue(":status",FALSE);
        $link = 'poczekalnia/'; //Potrzebne, do ustalenia gdzie mają prowadzić odnośniki
    }
    $result->execute();
    foreach($result as $row)
    {
        $nrows = $row[0];
    }
     $npage = ceil($nrows/10); // ilość wierszy podzielone przez ilość wpisów na jednej stronie i zaokrąglone w góre daje liczbę stron
     
    echo "<div id='change-page'>";
    for($i = $page-3;$i < $page;$i++) // wyświetla 3 strony poniżej obecnej w menu
    {
        if($i >= 1) // sprawdza czy nie jest poniżej pierwszej strony
        {
            echo "
				<a href='$link$i'><div class='page' >$i</div></a>";
        }
    }
    echo "<div class='page' id='active'>".($page)."</div>"; //obecna strona
    for($i = $page + 1; $i < $page+3; $i++) // wyświetla 3 kolejne
    {
        if($i <= $npage) //sprawdza czy nie wyświetla w menu za dużo możliwości
        {
            echo "<a href='$link$i'><div class='page' >$i</div></a>";
        }
    }

    echo "</div>";
			echo "<div id='number_of_pages'>/$npage</div>"; // wyświetla ilość podstron
}

function bestpost($profile)
{
	require_once "connect.php";
	$conn = new PDO("mysql:host=$host;dbname=$db_name", $db_user, $db_password);
	$result = $conn->prepare("Select reasons.id,reasons.content,reasons.data,Count(evaluations.id) as 'count' from reasons left join evaluations ON reasons.id = evaluations.id_reasons where reasons.id_user = (Select id from users where login = :login) GROUP BY reasons.id ORDER BY Count(evaluations.id) DESC LIMIT 10");
	$result->bindParam(":login",$profile);
	$result->execute();
	return $result;
}
?>