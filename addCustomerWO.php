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
	<h2>Work Order Details:</h2><br />
	<form action="addCustomerWO.php" method="post">
	    Customer Name<br />
	    <input type="text" name="Name"><br /><br />
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>
	
	<?php
	include('connect.php');
	session_start();

	if (isset($_POST['Submit']))
	{
	    $sql = "INSERT INTO CUSTOMER VALUES ('$_SESSION[wONumber]',
                   '$_POST[Name]')";

	    if ($conn->query($sql) === TRUE)
	    {
		header("Location:adminHome.php");
		exit;
	    }
	    else
	    {
		echo $conn->error;
	    }
	}
	?>
    </body>
</html>
