<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<script src="../scripts/script.js"></script>
    </head>
    <body class="Page">
	<form class="left-top" action="adminHome.php" method="get">
	    <input class="button" type="submit" value="Back">
	</form>
	<?php
	session_start();
	
	if ($_SESSION[admin_login] != TRUE)
	{
	    header("Location:index.php");
	    exit;
	}
	
	?>
	<h1>Work Orders</h1>
	<?php
	include('connect.php');

	$sql = "SELECT WORK_ORDER.`W/o_number`,Name,Description,Status FROM WORK_ORDER,CUSTOMER WHERE WORK_ORDER.`W/o_number` = CUSTOMER.`W/o_number`";
	
	if (!($result = $conn->query($sql)) === TRUE)
    	{
	    die($conn->error);
	}

	echo "<b>Customer</b><br />";
	echo "<table>";
	echo "<form action='customerDetails.php' method='post'>";
	echo "<tr><td>W/O Num</td><td>Status</td><td>Cust. Name</td><td>Description</td></tr>";
	
	while($row = mysqli_fetch_array($result))
	{
	    $status = $row['Status'] == 0 ? "Open" : "Closed";
	    echo "<tr><td><input class='buttonWO' type='submit' name='numberWO' value='" . $row['W/o_number'] . "'></td><td>" . $status  . "</td><td>" . $row['Name'] . "</td><td>" . $row['Description']  . "</td></tr>";
	}

	echo "</form>";
	echo "</table>";
	$sql = "SELECT WORK_ORDER.`W/o_number`,Account,Description,Status FROM WORK_ORDER,WARRANTY WHERE WORK_ORDER.`W/o_number` = WARRANTY.`W/o_number`";
	
	if (!($result = $conn->query($sql)) === TRUE)
    	{
	    die($conn->error);
	}

	echo "<b>Warranty</b><br />";
	echo "<table>";
	echo "<form action='warrantyDetails.php' method='post'>";
	echo "<tr><td>W/O Num</td><td>Status</td><td>Account</td><td>Description</td></tr>";
	
	while($row = mysqli_fetch_array($result))
	{
	    $status = $row['Status'] == 0 ? "Open" : "Closed";
	    echo "<tr><td><input class='buttonWO' type='submit' name='numberWO' value='" . $row['W/o_number'] . "'></td><td>" . $status  . "</td><td>" . $row['Account'] . "</td><td>" . $row['Description']  .  "</td></tr>";
	}

	echo "</form>";
	echo "</table>";
	$sql = "SELECT WORK_ORDER.`W/o_number`,Bran_id,Description,Status FROM WORK_ORDER,INTERNAL WHERE WORK_ORDER.`W/o_number` = INTERNAL.`W/o_number`";
	
	if (!($result = $conn->query($sql)) === TRUE)
    	{
	    die($conn->error);
	}

	echo "<b>Internal</b><br />";
	echo "<table>";
	echo "<form action='internalDetails.php' method='post'>";
	echo "<tr><td>W/O Num</td><td>Status</td><td>Branch</td><td>Description</td></tr>";
	
	while($row = mysqli_fetch_array($result))
	{
	    $status = $row['Status'] == 0 ? "Open" : "Closed";
	    echo "<tr><td><input class='buttonWO' type='submit' name='numberWO' value='" . $row['W/o_number'] . "'></td><td>" . $status  . "</td><td>" . $row['Bran_id'] . "</td><td>" . $row['Description']  .  "</td></tr>";
	}

	echo "</form>";
	echo "</table>";
	?>
    </body>
</html>
