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
	
	?>
	<form class="left-top" action="adminHome.php" method="get">
	    <input class="button" type="submit" value="Back">
	</form>
	<h1>Add Employee</h1>
	<fieldset class="fieldset">
	    <div class="details-text">
		<form action="addEmployee.php" method="post">
		    First Name<br />
		    <input type="text" name="Fname"><br />
		    Last Name<br />
		    <input type="text" name="Lname"><br />
		    Phone Number<br />
		    <input type="text" name="Phone_number"><br />
		    Birth Date<br />
		    <input type="date" name="Birth_date"><br />
		    Id Number<br />
		    <input type="text" name="Id_number"><br />
		    Password<br />
		    <input type="password" name="Password"><br />
		    Job Title<br />
		    <input type="text" name="Job_title"><br />
		    Admin Status <input type="checkbox" name="Admin_Status"><br />
		    Mechanic <input id="mechCheck" type="checkbox" name="Mechanic" onClick="showMechText();"><br />
		    <span id="mechCertHidden" style="display:none">Certification <input type="text" name="Certif"></span><br />
		    Pay Type<br />
		    <input id="Pay_type" type="radio" name="Pay_type" value="Salary" onClick="showSalText();" checked> Salary<br />
		    <span id="salBoxHidden" style="display:block">Amount <input type="text" name="Salary_amount"></span><br />
		    <input id="Pay_type" type="radio" name="Pay_type" value="Wage" onClick="showWageText();"> Wage<br />
		    <span id="wageBoxHidden" style="display:none">Amount <input type="text" name="Wage_amount"></span><br />
		    <input class="button" type="submit" name="Submit" value="Submit">
		</form>
	    </div>
	</fieldset>
    </body>
    
    <?php
    include('connect.php');

    if (isset($_POST['Submit']))
    {
	if (isset($_POST[Admin_Status]))
	{
	    $Admin = 1;
	}
	else
	{
	    $Admin = 0;
	}

	if ($_POST[Fname] == '')
	{
	    die("The \"First Name\" field cannot be blank.");
	}

	if ($_POST[Lname] == '')
	{
	    die("The \"Last Name\" field cannot be blank.");
	}

	if ($_POST[Id_number] == '')
	{
	    die("The \"Id Number\" field cannot be blank.");
	}

	if ($_POST[Password] == '')
	{
	    die("The \"Password\" field cannot be blank.");
	}

	if ($_POST[Job_title] == '')
	{
	    die("The \"Job Title\" field cannot be blank.");
	}

	$Birthday = $_POST[Birth_date];
	$Date_check = explode('-',$Birthday);
	
	if (!checkdate($Date_check[1],$Date_check[2],$Date_check[0]))
	{
	    $Birthday = NULL;
	}
	
	$sql = "INSERT INTO EMPLOYEE 
              VALUES ('$_POST[Id_number]','$_POST[Password]','$_POST[Fname]',
              '$_POST[Lname]','$_POST[Phone_number]',
              ".(($Birthday=='')?"NULL":("'".$Birthday."'")).",
              '$_POST[Job_title]',$Admin)";
	
	if (!($result = $conn->query($sql)) === TRUE && $conn->errno == 1062)
    	{
	    die("ID already exists");
	}
	else if (!$result === TRUE)
	{
	    die($conn->error);
	}

	if ($_POST[Pay_type] == 'Salary')
	{
	    if (!is_numeric($_POST[Salary_amount]))
	    {
		$sql = "INSERT INTO SALARY_EMPL(E_id) VALUES ('$_POST[Id_number]')";
	    }
	    else
	    {
		$sql = "INSERT INTO SALARY_EMPL (E_id,Salary) VALUES ('$_POST[Id_number]','$_POST[Salary_amount]')";
	    }
	}
	else
	{
	    if (!is_numeric($_POST[Wage_amount]))
	    {
		$sql = "INSERT INTO HOURLY_EMPL (E_id) VALUES ('$_POST[Id_number]')";
	    }
	    else
	    {
		$sql = "INSERT INTO  HOURLY_EMPL (E_id,Wage) VALUES ('$_POST[Id_number]','$_POST[Wage_amount]')";
	    }
	}

	if (!$conn->query($sql) === TRUE)
    	{
	    die($conn->error);
	}
	
	if (isset($_POST[Mechanic]))
	{
	    $sql = "INSERT INTO MECHANIC VALUES ('$_POST[Id_number]','$_POST[Certif]')";
	    
	    if (!$conn->query($sql) === TRUE)
    	    {
		die($conn->error);
	    }
	    else
	    {
		header("Location:adminHome.php");
	    }
	}
	else
	{
	    header("Location:adminHome.php");
	}
    }
    ?>
</html>
