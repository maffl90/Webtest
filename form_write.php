<?php 
	session_start();
?>
<html>
	<head>
		<title>Neues Rezept</title>
		<!--- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
		<script src="Zutaten_func.js"></script>
		<!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
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
				text-align: center;
			}
			#all {
				margin-top: 50px;
				margin-left: 10%;
				width: 80%;
				height: 80%;
			}
			#button {
				padding: 10px 20px;
				margin-top: 20px;
				font-size: 20px;
				position: absolute;
				left:47%;
				top: 86%;
			}
			.form-group{
				height:30px;
				line-height:30px;
				display:inline-block;
				margin-bottom: 7px;
				margin-left: 8px;
				vertical-align:middle;
			}
			.form-control{
				display:inline-block;
				vertical-align:middle;
				display:block;
				height:34px;
				padding:1px 7px;
				font-size:14px;
				border:1px solid #ccc;
				border-radius:4px;
			}
			#button_plus{
				display:inline-block;
				padding: 1px 7px;
				font-size: 20px;
				vertical-align:middle;
				float: right;
			}
			#zutatenlist {
				position: absolute;
				width: 40%;
				top: 20%;
				left: 34%;
				float: left;
			}
			#anleitung{
				position: absolute;
				width: 20%;
				top: 20%;
				left: 62%;
				float: left;				
			}
		</style>
		
	</head>
	
	<body>
		<br/>	
		<h1>Neues Rezept hinzufügen</h1>
			
		<fieldset id="all">
			<legend style="font-size:22px;"><b>Daten eingeben</b></legend>
			<form action="insert.php" method="post">
				<br/><label id = "test" for = "Rezeptname">Name des Gerichts:</label><input type="text" name="Rezeptname" style="width: 200px;" required /><br/><br/>
				<label id = "test" for = "Kategorie" style="width: 196px;">Kategorie:</label><!--<input type="text" name="Kategorie" required /><br/><br/>-->
				<select name="Kategorie" style="width:110px; height:25px; display:inline-block;">			
							<option value="Vorspeise">Vorspeise</option>
							<option value="Hauptspeise">Hauptspeise</option>
							<option value="Beilage">Beilage</option>
							<option value="Nachspeise">Nachspeise</option>
							<option value="Snack">Snack</option>
				</select><br/><br/>
				<label id = "test" for = "Dauer">Dauer:</label><input style="text-align:center; width: 110px;" type="number" name="Dauer" required /><br/><br/>
				<label id = "test" for = "Schwierigkeit">Schwierigkeit:</label><input style="text-align:center; width: 110px;" type="number" min=1 max=5 name="Schwierigkeit" required /><br/><br/>

				<div id="zutatenlist">
					<p style="font-size:22px; margin-top: 0px; margin-bottom: 7px;">&emsp;&emsp;Zutaten eintragen:</p>
					<div class="form-group">
						<input type="number" class="form-control" id="Menge" name="Menge[]" value="" placeholder="Menge" style="width:100px;">
					</div>
					
					<div class="form-group">
						<div class="input-group">
						<select class="form-control" id="Einheit" name="Einheit[]" style="width:110px;">			
							<option value="Stück">Stück</option>
							<option value="g">g</option>
							<option value="dg">dg</option>
							<option value="kg">kg</option>
							<option value="TL">TL</option>
							<option value="ml">ml</option>
						</select>
						</div>
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" id="Zutat" name="Zutat[]" value="" placeholder="Zutat" style="width:200px;">
					</div>			
					<div class="form-group">
						<button type="button" id = "button_plus" onclick="zutaten();">+</button>
					</div>
				</div>
						
				<div id="anleitung">
					<p style="font-size:22px; margin-top: 0px; margin-bottom: 7px;">&emsp;&emsp;Anleitung hier eintragen:</p>
					<textarea style="resize: none;" name="anleitung" rows="30" cols="60"></textarea>
				</div>
				
				<input type="submit" value="einfügen" id = "button"/>
			</form>
		</fieldset>
	</body>
</html>