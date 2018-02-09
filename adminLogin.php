<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body class="Page">
	<form class="left-top" action="index.php" method="get">
	    <input class="button" type="submit" value="Back">
	</form>
	<h2>Admin Login:</h2><br />
	<form action="adminLogin.php" method="post">
	    Admin ID<br />
	    <input type="text" name="Id_num"><br /><br />
	    Password<br />
	    <input type="password" name="Passwd"><br /><br />
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>

	<?php
	include('connect.php');
	session_start();

	if (isset($_POST['Submit']))
	{
	    $sql = "SELECT Fname FROM EMPLOYEE WHERE Id_number = '$_POST[Id_num]' AND Password = '$_POST[Passwd]' AND Admin_status = 1";

	    if (!($result = $conn->query($sql)) === TRUE)
	    {
		die($conn->error);
	    }

	    if ($result->num_rows == 0)
	    {
		die("ID or Password Invalid");
	    }
	    else
	    {
		$_SESSION[admin_login] = TRUE;
		header("Location:adminHome.php");
		exit;
	    }
	}
	?>
    </body>
</html>
