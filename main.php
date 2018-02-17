<?php
	DEFINE("DB_HOST", "localhost");
	DEFINE("DB_USER", "root");
	DEFINE("DB_PW", "");
	DEFINE("DB_DATABASE", "kochbuch");
	
	function createTable($array){
		echo "<table>";
		for($i = 0; $i < count($array); $i++) {
			echo "<tr>";
			for($j = 0; $j < count($array[$i]); $j++) {
				if($i == 0)
					echo "<th style='background-color:tomato;'>{$array[$i][$j]}</th>";
				else if ($j == 1)
					echo "<td style='background-color: #eee;'><a href='main.php?gericht=".$array[$i][$j]."'>".$array[$i][$j]."</a></td>";
				else
					echo "<td style='background-color: #eee;'>{$array[$i][$j]}</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}	
	session_start();

?>
<html>
	<head>
		<title>Kochbuch</title>
		<meta charset = "utf-8">
		<style>
			body {
				background-color: lightblue;
			}
			h1 {
				color: darkred;
				text-align: center;
				font-size: 3.5em;
				margin-top: 0px;
			}
			h2 {
				color: darkred;
				text-align: center;
				font-size: 2.5em;
				margin-top: 0px;
			}
			#test {
				margin-top: 15px;
				width: 180px;
				display: inline-block;
			}
			.kategories {
				float: left;
				width: 13%;
				background-color: #ddd;
				position: fixed;
				font-size: 1.5em;
				text-align: center;
			}
			.data {
				width: 66%;
				background-color: #eee;
				padding: 10px;
				margin-left: 17%;
			}
			td, th {
				border: solid 2px black;
				padding: 3px;
				text-align: center;
				font-size: 1.5em;
				min-width: 200px;
			}

			table {
				border: solid 3px black;
				border-collapse: collapse; 
				margin: 0 auto;
			}
			.bearbeiten{
				position: relative;
				left: 87%;
				top: 35%;
				width: 13%;
				background-color: #ddd;
				position: fixed;
				font-size: 1.5em;
				text-align: center;
			}
		</style>
		
	</head>
	
	<body>
		<?php
			$connection = mysqli_connect(DB_HOST, DB_USER, DB_PW, DB_DATABASE) or die("Verbindung konnte nicht hergestellt werden");
			//echo "Datenbankzugriff erfolgreich!<br/>";
			if(isset($_POST["Username"]))
			{
				$username 	= $_POST["Username"];
				$password 	= $_POST["Password"];
				
				//do any sql operation
				$sqlSelect = "SELECT Passwort, Admin, BenutzerID FROM benutzer WHERE BenutzerName = \"" . $username . "\";";
				$result = mysqli_query($connection, $sqlSelect);
				
				$row 	= mysqli_fetch_array($result);			
				$admin 	= $row["Admin"];
				$ben_id	= $row["BenutzerID"];			
				
				if(!($password == $row["Passwort"])){
					echo "<script> alert('Fehler bei der Eingabe!'); 
					window.location.replace('index.php'); </script>";
				}
				else{
					if($admin == 1){
						$_SESSION["Admin"] = true;
						$_SESSION["ben_id"] = $ben_id;
						$_SESSION["ben_name"] = $username;
					}
					else {
						$_SESSION["Admin"] = false;
						$_SESSION["ben_id"] = $ben_id;
						$_SESSION["ben_name"] = $username;
					}
					echo"<script>window.location.replace('main.php'); </script>";
				}			
				
			}			
			else{
							
				echo "<br/><h1>Marvs Kochbuch</h1>";
				
				echo "<div class='kategories'>
					<br/><a href='main.php'>Neueste Rezepte</a><br/><br/>
					<a href='main.php?kategorie=Vorspeise'>Vorspeise</a><br/><br/>
					<a href='main.php?kategorie=Hauptspeise'>Hauptspeise</a><br/><br/>
					<a href='main.php?kategorie=Beilage'>Beilage</a><br/><br/>
					<a href='main.php?kategorie=Nachspeise'>Nachspeise</a><br/><br/>
					<a href='main.php?kategorie=Snack'>Snack</a><br/><br/>
					</div>";
				
				echo "<div class='bearbeiten'>
					<br/><br/><a href='form_write.php'>Rezept hinzufügen</a><br/><br/>
					<br/><a href='main.php?kategorie=Vorspeise'>eigene Rezepte</a><br/><br/>";
				if($_SESSION["Admin"])
					echo "<br/><a href='main.php?kategorie=Vorspeise'>Adminbereich</a><br/><br/>";
				echo "<br/></div>";
				
				
				if(isset($_GET["kategorie"])){
					$sqlSelect = "SELECT Kategorie, RezeptName, Dauer, Schwierigkeit FROM rezepte WHERE Kategorie = \"". $_GET["kategorie"]."\";";
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$i++;
					}			
					echo "<div class='data'> <h2>Übersicht Gerichte der Kategorie - ".$_GET["kategorie"]."</h2>";
					createTable($array_data);
					echo "</div>";
				}
				else if(isset($_GET["gericht"])){
					$sqlSelect = "SELECT Kategorie, RezeptName, Dauer, Schwierigkeit, Datum, BenutzerName FROM rezepte WHERE RezeptName = \"". utf8_decode($_GET["gericht"])."\";";
					
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit", "eingetragen von", "hinzugefügt am");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$array_data[$i][] = utf8_encode($row["BenutzerName"]);
						$array_data[$i][] = utf8_encode($row["Datum"]);
						$i++;
					}			
					echo "<div class='data'>
							<h2>Details - ".$_GET["gericht"]."</h2>";
					createTable($array_data);
					echo "</div>";
				}
				else {
					//Standardauswahl
					$sqlSelect = "SELECT Kategorie, RezeptName, Dauer, Schwierigkeit FROM rezepte;";
					
					$result = mysqli_query($connection, $sqlSelect);
					$array_data;
					$i = 1;
					$array_data[0] = array("Kategorie", "Gericht", "Dauer(min)", "Schwierigkeit");
					while($row = mysqli_fetch_array($result)){
						$array_data[$i][] = utf8_encode($row["Kategorie"]);
						$array_data[$i][] = utf8_encode($row["RezeptName"]);
						$array_data[$i][] = utf8_encode($row["Dauer"]);
						$array_data[$i][] = utf8_encode($row["Schwierigkeit"]);
						$i++;
					}			
					echo "<div class='data'>
							<h2>Übersicht Gerichte</h2>";
					createTable($array_data);
					echo "</div>";
				}
							
			}			
		?>
		
	</body>
</html>










