<?php 
	session_start();
	$_SESSION["Admin"] = false;
?>
<html>
	<head>
		<title>Anmeldung</title>
		
		<style>
			body {
				background-color: lightblue;
			}
			h1 {
				color: darkred;
				text-align: center;
			}
			h2 {
				color: darkred;
				text-align: center;
			}
			#test {
				margin-top: 15px;
				font-size: 20px;
				width: 200px;
				display: inline-block;
			}
			#all {
				margin-top: 100px;
				margin-left: 40%;
				width: 20%;
				height: 20%;
			}
			#button {
				position: absolute;
				left: 47%;
				padding: 10px 20px;
				font-size: 20px;
				margin-top: 20px;
			}
		</style>
		
	</head>
	
	<body>
		<br/>	
		<h1>Willkommen</h1>
		<h2>Bitte melden Sie sich an!</h2>
			
		<fieldset id="all">
			<legend style="font-size:22px;"><b>Anmeldedaten eintragen</b></legend>
			<form action="main.php" method="post">
				<label id = "test" for = "Username">Benutzername:</label><input type="text" name="Username" required /><br/>
				<label id = "test" for = "Password">Passwort:</label><input type="password" name="Password" required /><br/>					
				
				<input type="submit" value="Anmelden" id = "button"/>
			</form>
		</fieldset>
	</body>
</html>