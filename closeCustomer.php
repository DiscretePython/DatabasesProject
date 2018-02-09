<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css"
    </head>
    <body class="Page">
	<?php
	session_start();
	
	if ($_SESSION[admin_login] != TRUE)
	{
	    header("Location:index.php");
	    exit;
	}
	
	Include('connect.php');

	$sql = "UPDATE WORK_ORDER SET Status = 1 WHERE `W/o_number` = $_POST[numberWO]";

	if (!$conn->query($sql) === TRUE)
    	{
	    die($conn->error);
	}
	?>
	<form class="left-top" action="adminHome.php" method="get">
	    <input class="button" type="submit" name="Submit" value="Homepage"><br />
	</form>
	<h2>Please Process Customer Payment</h2>
    </body>
</html>
