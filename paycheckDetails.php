<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body class="Page">
	<form class="left-top" action="paycheck.php" method="get">
	    <input class="button" type="submit" value="Back">
	</form>
	<?php
	session_start();	
	ini_set("precision", 2);
	include('connect.php');
	
	if (($_SESSION[admin_login] != TRUE) || (!isset($_POST['Submit'])))
	{
	    header("Location:index.php");
	    exit;
	}

	$sql = "SELECT * FROM EMPLOYEE WHERE Id_number = '$_POST[Id_num]'";

	if (!($result = $conn->query($sql)) === TRUE)
	{
	    die($conn->error);
	}

	if ($result->num_rows == 0)
	{
	    die("Employee ID not valid");
	}

	if ($_POST[Start_date] > $_POST[End_date])
	{
	    die("The end date cannot come before the start date");
	}
	
	if (date('Y', strtotime($_POST[Start_date])) != date('Y', strtotime($_POST[End_date])))
	{
	    die("The dates entered cannot be across multiple years");
	}

	$sql = "SELECT SUM(TIMESTAMPDIFF(MINUTE, Time_in, Time_out)) FROM TIME_ENTRY WHERE E_id = '$_POST[Id_num]' AND Time_in >= '$_POST[Start_date]' AND Time_out <= '$_POST[End_date] 23:59:59'";

	if (!($result = $conn->query($sql)) === TRUE)
	{
	    die($conn->error);
	}

	$row = mysqli_fetch_array($result);
	$time = $row[0] == 'NULL' ? 0 : $row[0] / 60;

	echo "<h2>Pay Details</h2>Employee $_POST[Id_num] has worked ";
	echo $time . " hours from $_POST[Start_date] to $_POST[End_date]<br /><br />";

	$sql = "SELECT Salary FROM SALARY_EMPL WHERE E_id = '$_POST[Id_num]'";

	if (!($result = $conn->query($sql)) === TRUE)
	{
	    die($conn->error);
	}

	if ($result->num_rows == 0) // Hourly
	{
	    $sql = "SELECT Wage FROM HOURLY_EMPL WHERE E_id = $_POST[Id_num]";

	    if (!($result = $conn->query($sql)) === TRUE)
	    {
		die($conn->error);
	    }

	    $row = mysqli_fetch_array($result);
	    $amount = $row[0] * $time;
	}
	else // Salary
	{
	    $row = mysqli_fetch_array($result);
	    $year = date('Y', strtotime($_POST[End_date]));

	    if ((($year % 4) == 0) && ((($year % 100) != 0) ||
				       (($year % 400) == 0)))
	    {
		$amount = ($row[0] / 366) * (strtotime($_POST[End_date]) - strtotime($date) + 86399);
	    }
	    else
	    {
		$amount = ($row[0] / 365) * ((strtotime($_POST[End_date])) - strtotime($_POST[Start_date]) + 86399);
	    }

	    $amount = floor($amount / (60 * 60 * 24));
	}

	echo "This employee will recieve $" . number_format($amount,2) . " base pay<br />Please use this to calculate the following:<br />";
	?>
	<form action="finalPaycheck.php" method="post">
	    Tax<br />
	    <input type="text" name="Taxes" required><br />
	    Medical<br />
	    <input type="text" name="Medical" required><br />
	    Productivity Bonus<br />
	    <input type="text" name="Prod" required><br />
	    Commission<br/>
	    <input type="text" name="Comm" required><br /><br />
	    <input type="hidden" name="Id_num" value="<?php echo $_POST[Id_num];?>">
	    <input type="hidden" name="Start_date" value="<?php echo $_POST[Start_date];?>">
	    <input type="hidden" name="End_date" value="<?php echo $_POST[End_date];?>">
	    <input type="hidden" name="Base" value="<?php echo number_format($amount,2);?>">
	    <input class="button" type="submit" name="Submit" value="Submit">
	</form>
    </body>
</html>
