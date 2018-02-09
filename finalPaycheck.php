<html>
    <head>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<script src="../scripts/script.js"></script>
    </head>
    <body class="Page">
	<form class="left-top" action='adminHome.php' method='get'>
	    <input class="button" type='submit' value='Home'>
	</form>
	<?php
	session_start();
	
	if ($_SESSION[admin_login] != TRUE)
	{
	    header("Location:index.php");
	    exit;
	}
	
	include('connect.php');
	ini_set("precision", 2);

	$FinalPay = str_replace(",","", $_POST[Base]) - $_POST[Taxes] - $_POST[Medical] + $_POST[Prod] + $_POST[Comm];
	$sql = "INSERT INTO PAYCHECK VALUES ('$_POST[Prod]','$_POST[Start_date]','$_POST[Id_num]','$_POST[End_date]','" . str_replace(",", "", $_POST[Base]) . "','$_POST[Taxes]','$_POST[Medical]','$_POST[Comm]')";

	if (!(($result = $conn->query($sql)) === TRUE) && (mysqli_errno($conn) == 1062))
	{
	    echo "This pay date has already been added for this employee";
	    exit;
	}
	else if (!$result === TRUE)
	{
	    die($conn->error);
	}
	
	echo "It has been recorded that employee " . $_POST[Id_num] . " has recieved $" . number_format($FinalPay,2) . " for the date range " . $_POST[Start_date] . " to " . $_POST[End_date];
	?>
    </body>   
</html>
