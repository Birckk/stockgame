<body>
  <?php
  require_once 'core/init.php'; 
require_once 'core/Companies.php';
if(not_logged_in() === TRUE) {
	header('location: login.php');
}
	$UserID = $_SESSION['id'];
    $SSAntal = $_POST['SSAntal'];
    $TotalPris = $_POST['STotalPris'];
    $Aktie = $_POST['SCompanie'];
    $STotalAntal = $_POST['STotalAntal'];
 
    if(!empty($Aktie))   
    {
      $query = $connect->query("SELECT * FROM companies WHERE companyname = '$Aktie'");
    }
    if($row = mysqli_fetch_array($query))  {
      $AktieID = $row['aktieid'];
    }
    else {
    }

   if(!empty($_POST['SSAntal']))   
   {
     $query = $connect->query("SELECT * FROM currentstock WHERE userid = $UserID AND companyid = $AktieID");
   }
   if($row = mysqli_fetch_array($query))  {
     $CurrentStocksRowID = "{$row['id']}";
     $sql = "DELETE FROM currentstock WHERE id=$CurrentStocksRowID";
     if ($connect->query($sql) === TRUE) {
       } else {
         echo "Error deleting record: " . $connect->error;
       }
     }

     $sql = "INSERT INTO currentstock (userid, companyid, antal)
     VALUES ($UserID, $AktieID, $STotalAntal)";

     if ($connect->query($sql) === TRUE) {
     } else {
       echo "Error: " . $sql . "<br>" . $connect->error;
     }

    if(!empty($_POST['SSAntal']))   
    {
      $query = $connect->query("SELECT * FROM balance WHERE userid = $UserID");
    }
    if($row = mysqli_fetch_array($query))  {
      $BalanceRowID = "{$row['id']}";
      $sql = "DELETE FROM balance WHERE id=$BalanceRowID";
      if ($connect->query($sql) === TRUE) {
        } else {
            echo "Error deleting record: " . $connect->error;
        }
      }

      $sql = "INSERT INTO balance (userid, balance) VALUES ($UserID, $TotalPris)";

      if ($connect->query($sql) === TRUE) {
        echo "Stocks sold";
      } else {
          echo "Error: " . $sql . "<br>" . $connect->error;
      }
   ?>

 <a href="dashboard.php">tilbage</a>
</body>
