<?php

session_start();
require_once "functions.php";
require_once "fpdf.php";


if(isset($_GET['id']))
{
$profile = $_GET['id'];
$rdf = new FPDF();
$rdf->AddPage();
$rdf->SetFont('Arial','B',20);

$result = bestpost($profile);
$rdf->Cell(190,23,"Najlepsze powody użytkownika: $profile",1,1,'C');
$rdf->SetFont('Arial','',20);
foreach($result as $row) //wyświetla na stronie konretne wpisy
{
	$a1 = $row['content'];
	$a2 = $row['data'];
	$rdf->Cell(190,23,"$a1 ~ $a2",1,1,'C');
}
$rdf->Output();
}
else
{
	if(isset($_SESSION['url']))
	{
	$url = $_SESSION['url'];
	header("Location:$url");
	}
	else
	{
	header("Location:1");
	}
}

?>