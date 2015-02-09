<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>test application</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="well span4 offset4">
				<legend class="span4">Enter the patient's name </legend>
				<form action="registry.php" method="post">
					Name:<br>
					<input class="span4" type="text" name="name" required ><br>
					Lastname:<br>
					<input class="span4" type="text" name="lastname" required >
					<button class="btn  btn-success" type="submit" name="submit">Ok</button>
				</form>
				<hr>
				<form method="post" align="center" action="registry.php">

					<div><button class="btn btn-block btn-success" type="submit" name="register">New Patient</button></div>

				</form>
			</div>
			
				
			
		</div>
	</div>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/bootstrap.min.js"></script>	
</body>
</html>