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
	<form class="left-top" action="adminHome.php" method="post">
	    <input class="button" type="submit" name="Submit" value="Logout"><br /><br />
	</form>
	<h2>Admin Homepage</h2>
	<form action="adminHome.php" method="post">
	    <input class="button" type="submit" name="Submit" value="Add Employee"><br /><br />
	    <input class="button" type="submit" name="Submit" value="Create Work Order"><br /><br />
	    <input class="button" type="submit" name="Submit" value="View Work Orders"><br /><br />
	    <input class="button" type="submit" name="Submit" value="Calculate Pay"><br /><br />
	</form>
	
	<?php
	Include 'connect.php';

	if (isset($_POST['Submit']))
	{
	    switch ($_POST[Submit])
	    {
		case 'Add Employee':
		header("Location:addEmployee.php");
		exit;
		case 'Create Work Order':
		header("Location:createWorkOrder.php");
		exit;
		case 'View Work Orders':
		header("Location:viewWorkOrders.php");
		exit;
		case 'Calculate Pay':
		header("Location:paycheck.php");
		exit;
		case 'Logout':
		header("Location:index.php");
		exit;
		default:
		echo "Something strange is happening...";
	    } 
	}
	?>
    </body>
</html>
