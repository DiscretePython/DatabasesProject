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
	<h2>New Work Order Details:</h2>
	<form action="createWorkOrder.php" method="post">
	    Description<br />
	    <input type="text" name="Desc" maxlength="100"><br /><br />
	    Type<br />
	    <fieldset>
		<input class="align-radio" type="radio" name="type" value="Customer"> Customer<br />
		<input class="align-radio" type="radio" name="type" value="Warranty"> Warranty<br />
		<input class="align-radio" type="radio" name="type" value="Internal"> Internal<br /><br/>
	    </fieldset>
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>	
	<?php
	include('connect.php');
	session_start();

	if (isset($_POST['Submit']))
	{
	    $sql = "INSERT INTO WORK_ORDER (Status,Description) VALUES ('0','$_POST[Desc]')";

	    if ($conn->query($sql) === TRUE)
	    {
		$_SESSION[wONumber] = $conn->insert_id;
		
		if (strcmp($_POST[type],"Customer") == 0)
		{
		    header("Location:addCustomerWO.php");
		    exit;
		}
		else if (strcmp($_POST[type],"Warranty") == 0)
		{
		    header("Location:addWarrantyWO.php");
		    exit;
		}
		else
		{
		    header("Location:addInternalWO.php");
		    exit;
		}
	    }
	    else
	    {
		echo $conn->error;
	    }
	}
	?>
    </body>
</html>
