<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body class="Page">
	<?php
	session_start();
	
	if ($_SESSION[admin_login] != TRUE)
	{
	    header("Location:index.php");
	    exit;
	}
	?>
	<form class="left-top" action="adminHome.php" method="get">
	    <input class="button" type="submit" value="Back">
	</form>
	<h2>Create Paycheck:</h2><br />
	<form action="paycheckDetails.php" method="post">
	    Employee ID: <input type="text" name="Id_num" required><br /><br />
	    Please enter the date range for the payment:<br /><br />
	    Start  <input type="date" name="Start_date" required><br /><br />
	    End  <input type="date" name="End_date" required><br /><br />
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>
    </body>
</html>
