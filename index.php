<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body class="Page">
	<form class="left-top" action="adminLogin.php" method="post">
	    <input class="button" type="submit" value="Admin Login">
	</form>
	<h2>Time Clock:</h2><br />
	<form action="index.php" method="post">
	    Employee ID<br />
	    <input type="text" name="Id_num"><br /><br />
	    Password<br />
	    <input type="password" name="Passwd"><br /> <br />
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>

	<?php
	include('connect.php');
	session_start();
	$_SESSION[admin_login] = FALSE;

	if (isset($_POST['Submit']))
	{
	    $sql = "SELECT Fname FROM EMPLOYEE WHERE Id_number = '$_POST[Id_num]' AND Password = '$_POST[Passwd]'";

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
		$row = mysqli_fetch_row($result);
		$_SESSION[UsernameTime] = $row[0];
		$_SESSION[UserIdTime] = $_POST[Id_num];
		header("Location:timeChange.php");
		exit;
	    }
	}
	?>
    </body>
</html>
