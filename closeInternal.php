<html>
    <head>
    </head>
    <body>
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

	header("Location:adminHome.php");
	exit;
	?>
    </body>
</html>
