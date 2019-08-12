<!doctype html>
<html lang="PL">
	<head>
		<base href="http://localhost/1000powodow/" />
		<meta charset="UTF-8">
		<title>1000 powodów</title>
		<link rel="stylesheet"  href="style/style.css">
		<link rel="stylesheet" href="style/menu.css">
	</head>
	<body>
		<div id="main">
			<div id="head">
				<div id="main-head">
						<img src="pictures/logo.png">
						<ol id="menu">
						<a href=""><li>Najnowsze</li></a>
						<a href="poczekalnia"><li>Poczekalnia</li></a>
						<a href="dodaj"><li>Dodaj</li></a>
						<?php
						session_start();
						if(isset($_SESSION['login']))
						{
							echo '<a href="profil"><li>Profil</li></a>';
							echo '<a href="wyloguj"><li>Wyloguj</li></a>';
						}
						?>
						</ol>
				</div>
			</div>
					
			<div id="body">
				<div id="main-body">
					<div id="content-body" >
						<div id="content-body-image">
							<img src="pictures/content-body.png">
						</div>
						
							<?PHP
								require_once "functions.php";	
								if(isset($_SESSION['alert']))
								{
									echo '<div class="alert">'.$_SESSION['alert'].'</div>';
									unset($_SESSION['alert']);
								}
								if(isset($_GET['id']))
								{
									$_SESSION['url']=$_GET['id'];
									$id = explode("/",$_GET['id']);
									
									if(is_numeric($id[0]))
									{
										post($id[0],true);
									}
									else
									{
										switch($id[0])
										{
											case "dodaj":
												if(isset($_SESSION['login']))
												{
													include_once('html/add.html');
												}
												else
												{
													$_SESSION['alert'] = "Nie możesz dodawać będąc niezalogowany!";
													header("Location: 1");
													exit;
												}
												
											break;
											case "poczekalnia":
												if(isset($id[1]))
												{
													if(is_numeric($id[1]))
													{
														post($id[1],false);
													}
													else
													{
														post(1,false);
													}
												}
												else
												{
													post(1,false);
												}
											break;
											case "rejestracja":
												if(isset($_SESSION['login']))
												{
													header("Location:1");
													$_SESSION['alert'] = "Jesteś zalogowany!";
													exit;
												}
												else
												{
													echo "<form method=POST action=register.php >
													<input type=text name=login placeholder=login /><br/>
													<input type=password name=password placeholder=password /><br/>
													<input type=password name=passworda placeholder='Repeat password' /><br/>
													<input type=text name=email placeholder='email' /><br/>
													<input type=submit /><br/>
													</form>";
												}
											break;
											case "wyloguj":
												header("Location:1");
												session_destroy();
												exit;
											break;
											case "profil":
												if(isset($id[1]))
												{
													$profile = $id[1];
												}
												else
												{
													if(isset($_SESSION['login']))
													{
														$profile = $_SESSION['login'];
													}
													else
													{
														header("Location:1");
														exit;
													}
												}

												echo "Użytkownik: ".$profile;
												echo "<br>Najlepsze powody";
												
												$result = bestpost($profile);
												foreach($result as $row) //wyświetla na stronie konretne wpisy
												{
													$a1 = $row['content'];
													$a2 = $row['data'];
													$a3 = $row['id'];
													$a4 = $row['count'];

													echo "<div class='content' id='$a3'>
													
													<div class='date'>$a2</div>
													<p>$a1</p>";
													echo "$a4</div>";
												}
												
												echo "<a href='pdf.php?id=$profile'>EKSPORTUJ DO PDF!</a>"; 

											break;
										}
									}
								}
								else
								{
									post(1,true);

									unset($_SESSION['url']);

								}
							?>
					</div>
							
					<div id="commercial-body">
						<?PHP
						if(!isset($_SESSION['login']))
						{
							echo "<form method=POST action=loginin.php>
							<input type=text placeholder=login name=login /><br>
							<input type=password placeholder=hasło name=password /><br>
							<input type=submit value=zaloguj />
							</form>
							<a href=rejestracja>Zarejestruj Się!</a>
							";
						}
						else
						{
							echo "jesteś zalogowany jako ".$_SESSION['login'];
						}

						?>
						<div class="rekl">
							<!--Place for adv -->
						</div>
						<div class="rekl">
							<!--Place for adv -->
						</div>
					</div>
				</div>
			</div>

			<div id="footer">
				<div id="footer-image">
					<img src="pictures/footer-image.png">
				</div>
			</div>
		</div>
	</body>
</html>