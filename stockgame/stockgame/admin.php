<?php 
/*
adminsiden til at ændre aktiepriserne
*/
require_once 'core/init.php'; 
if(!$_SESSION['is_admin']) {
    header('location: dashboard.php');
}

if (isset($_POST['change_stock'])) {
	$stock_id = $_POST['stock_id'];
	$new_price = $_POST['new_price'];

 	$sql = "UPDATE companies SET stockvalue = '$new_price' WHERE id = '$stock_id' ";

      if ($connect->query($sql) === TRUE) {
        echo "Stock with ID " . $stock_id . " updated to " . $new_price;
      } else {
          echo "Error: " . $sql . "<br>" . $connect->error;
      }
}
?>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="aktiespil.css"><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<html>
<head>
	<title>adminbrugerpanelside</title>
</head>
<body style="background-color:grey;">
	<br>
	<center>
		<div id="admincontainer">
<a href="dashboard.php">Tilbage</a>
<?php 

$sql = "SELECT * FROM companies";
$stock = [];
$result = $connect->query($sql);
if ($result) {
	$stock = $result->fetch_all(MYSQLI_ASSOC);
} else {
	echo "Error: " . $sql . "<br>" . $connect->error;
}

?>



<table>
	<caption>Opdater aktie priser</caption>
	<thead>
		<tr>
			<th>Aktie navn</th>
			<th>ID</th>
			<th>Pris</th>
			<th>Ny pris</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($stock as $stock_item): ?>
			<tr>
				<td><?= $stock_item['companyname']?></td>
				<td><?= $stock_item['id']?></td>
				<td><?= $stock_item['stockvalue']?></td>
				<td><form action="admin.php" method="post">
					<input type="hidden" name="stock_id" value="<?=$stock_item['id']?>">
					<input type="number" name="new_price">
					<input type="submit" value="Ændr pris" name="change_stock">
				</form></td>
				
				<td></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

</div>
</center>
</body>
</html>