<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
require_once 'core/init.php'; 
require_once 'core/Companies.php';
if(not_logged_in() === TRUE) {
	header('location: login.php');
}

	$UserID = $_SESSION['id'];
	$Aktie = $_POST["Aktie"];
	$Antal = $_POST["Antal"];
	$pris = $_POST["pris"];
	$newBalance = $_POST["newBalance"];
	$TotalAntal = $_POST["TotalAntal"];



if(!empty($_POST['Aktie']))   
{
	$query = $connect->query("SELECT * FROM companies WHERE companyname = '".$_POST["Aktie"]."'");
}
if($row = mysqli_fetch_array($query))  {
	$AktieID = $row['aktieid'];
}
else {
}
$sql = "INSERT INTO transaction (UserID, CompanyID, Antal) VALUES ($UserID, $AktieID, $Antal)";

if ($connect->query($sql)===TRUE)  {
}
else {
	echo"FAILED!" . $sql . "<br>" . $connect->error;
}



if(!empty($_POST['Aktie']))   
{
	$query = $connect->query("SELECT * FROM currentstock WHERE userid = $UserID AND companyid = $AktieID");
}
if($row = mysqli_fetch_array($query))  {
	$CurrentStocksRowID = $row['id'];
	$sql = "DELETE FROM currentstock WHERE id=$CurrentStocksRowID";
	if ($connect->query($sql) === TRUE) {
		echo "Stock successfully";
	} else {
		echo "Error deleting record: " . $connect->error;
	}
}
$sql = "INSERT INTO currentstock (userid, companyid, antal)
VALUES ($UserID, $AktieID, $TotalAntal)";

if ($connect->query($sql) === TRUE) {
	echo " bought";
} else {
	echo "Error: " . $sql . "<br>" . $connect->error;
}




if(!empty($_POST['Aktie']))   
{
	$query = $connect->query("SELECT * FROM balance WHERE userid = $UserID");
}
if($row = mysqli_fetch_array($query))  {
	$BalanceRowID = "{$row['id']}";
	$sql = "DELETE FROM balance WHERE id=$BalanceRowID";
	if ($connect->query($sql) === TRUE) {
		echo "";
	} else {
		echo "Error deleting record: " . $connect->error;
	}
}

$sql = "INSERT INTO balance (userid, balance)
VALUES ($UserID, $newBalance)";

if ($connect->query($sql) === TRUE) {
	echo "";
} else {
	echo "Error: " . $sql . "<br>" . $connect->error;
}
?>

<a href="dashboard.php">tilbage</a>


</body>
</html>