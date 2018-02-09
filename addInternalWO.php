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
	<form action="addInternalWO.php" method="post">
	    Branch ID<br />
	    <input type="text" name="Branch"><br /><br/>
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>
	
	<?php
	include('connect.php');
	session_start();

	if (isset($_POST['Submit']))
	{
	    $sql = "INSERT INTO INTERNAL VALUES ('$_SESSION[wONumber]',
                   '$_POST[Branch]')";

	    if ($conn->query($sql) === TRUE)
	    {
		header("Location:adminHome.php");
		exit;
	    }
	    else if (mysqli_errno($conn) == 1452)
	    {
		echo "Please enter a valid branch ID";
	    }
	    else
	    {
		echo $conn->error;
	    }
	}
	?>
    </body>
</html>
