<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body class="Page">
	<form class="left-top" action="index.php" method="get">
	    <input class="button" type="submit" value="Back">
	</form>
	<h2>
	    <?php
	    session_start();
	    echo "Welcome {$_SESSION[UsernameTime]}";
	    ?><br />
	    Please enter work details:
	</h2>
	<form  action="timeChange.php" method="post">
	    Work Order<br />
	    <input type="text" name="Work_order"><br /><br />
	    Task Desc.<br />
	    <input type="text" name="Task" maxlength="20"><br /><br />
	    <input class="button" type="submit" name="Submit" value="Submit"><br /><br />
	    <input class="button" type="submit" name="Time_out" value="Time Out Only">
	</form>
	
	<?php
	Include 'connect.php';

	$sql = "SELECT * FROM TIME_ENTRY WHERE Time_out is NULL AND E_id = '$_SESSION[UserIdTime]'";

	if (!($result = $conn->query($sql)) === TRUE)
	{
	    die($conn->error);
	}

	if ($result->num_rows == 0)
	{
	    echo "Last time entry: None<br />";
	}
	else
	{
	    $row = mysqli_fetch_row($result);
	    echo "Last time entry: {$row[0]} at {$row[1]}<br />";
	}

	if (isset($_POST['Submit']))
	{
	    if ($result->num_rows != 0)
	    {
		$date = date("Y-m-d H:i:s");
		$sql = "UPDATE TIME_ENTRY SET Time_out = '$date' WHERE Time_in = '$row[1]' AND E_id = '$row[3]'";

		if (!$conn->query($sql) === TRUE)
		{
		    die($conn->error);
		}
	    }
	    
	    if ($_POST[Task] == '')
	    {
		die("Please enter a task");
	    }

	    if ($_POST[Work_order] == '')
	    {
		$Work_Order = 'NULL';
	    }
	    else
	    {
		$Work_Order = (is_numeric($_POST['Work_order']) ? (int)$_POST['Work_order'] : -1);
	    }

	    $sql = "SELECT Status FROM WORK_ORDER WHERE `W/o_number` = $Work_Order";

	    if (!($result = $conn->query($sql)) === TRUE)
	    {
		die($conn->error);
	    }

	    if ($result->num_rows == 0)
	    {
		die("W/O Entered Doesn't Exist");
	    }

	    $row = mysqli_fetch_row($result);

	    if ($row[0] != 0)
	    {
		die("W/O Entered Is Closed");
	    }
	    
	    $sql = "INSERT INTO TIME_ENTRY (Task,E_id,Work_order) VALUES ('$_POST[Task]','$_SESSION[UserIdTime]',$Work_Order)";

	    if (!$conn->query($sql) === TRUE)
	    {
		die("Work Order Doesn't Exist");
	    }

	    header("Location:index.php");
	    exit;
	}

	if (isset($_POST[Time_out]))
	{
	    if ($result->num_rows == 0)
	    {
		die();
	    }
	    
	    $date = date("Y-m-d H:i:s");
	    $sql = "UPDATE TIME_ENTRY SET Time_out = '$date' WHERE Time_in = '$row[1]' AND E_id = '$row[3]'";

	    if (!$conn->query($sql) === TRUE)
	    {
		die($conn->error);
	    }

	    header("Location:index.php");
	    exit;
	}
	?>
    </body>
</html>
