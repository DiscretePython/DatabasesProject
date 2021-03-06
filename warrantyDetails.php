<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<script src="../scripts/script.js"></script>
    </head>
    <body class="Page">
	<?php
	session_start();
	
	if ($_SESSION[admin_login] != TRUE)
	{
	    header("Location:index.php");
	    exit;
	}
	
	include('connect.php');
	ini_set("precision", 2);

	$sql = "SELECT * FROM WORK_ORDER,WARRANTY WHERE WARRANTY.`W/o_number` = '$_POST[numberWO]' AND WORK_ORDER.`W/o_number` = '$_POST[numberWO]'";
	
	if (!($result = $conn->query($sql)) === TRUE)
    	{
	    die($conn->error);
	}

	$row = mysqli_fetch_array($result);

	if ($row[1] == 0)
	{
	    $status = "Open";
	}
	else
	{
	    $status = "Closed";
	}

	$workOrder = $row[0];
	echo "<form class='left-top' action='adminHome.php' method='get'>
	    <input class='button' type='submit' name='home' value='Homepage'>
	    </form>";
	?>
	<h1>Work Order Details</h1>
	<?php echo "<fieldset class='details'>"; ?>
	<div class="details-text">
	    W/O Number: <?php echo $row[0];?><br />
	    Warranty Account: <?php echo $row[4];?><br />
	    Description: <?php echo $row[2];?><br />
	    Status: <?php echo $status;?><br />
	    Time:<br />
	<?php
	$sql = "SELECT TIMESTAMPDIFF(MINUTE, Time_in, Time_out), Id_number FROM TIME_ENTRY, EMPLOYEE WHERE Work_order = $row[0] AND E_id = Id_number";

	if (!($result = $conn->query($sql)) === TRUE)
    	{
	    die($conn->error);
	}

	$total = 0;
	
	while ($row = mysqli_fetch_array($result))
	{
	    if ($row[0] != '')
	    {
		echo $row[0] / 60 . " HRS from ID " . $row[1] . "<br />";
		$total = $total + ($row[0] / 60);
	    }
	    else
	    {
		echo "ID $row[1] timed in now<br />";
	    }
	}

	echo "Total Time: <b>" . $total . " HRS</div></fieldset></b><br /><br />";

	if ($status == 'Open')
	{
	    echo "<form action='closeWarranty.php' method='post'>
            <input type='hidden' name='numberWO' value='" . $workOrder . "' />
	    <input class='button' type='submit' name='close' value='Close Work Order'>
	    </form>";
	}
	?>
    </body>   
</html>
