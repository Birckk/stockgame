<?php 
 /*
Dette er hovedsiden med alle de forskellige aktier osv.
*/
require_once 'core/init.php'; 
 require_once 'core/Companies.php';
if(not_logged_in() === TRUE) {
    header('location: login.php');
}
$Aktie1 = "";
$antal1 = "";
$antal2 = "";

$userdata = getUserDataByUserId($_SESSION['id']);

$query = $connect->query("SELECT * FROM companies WHERE companyname = 'ecco'");
      if($row = mysqli_fetch_array($query))  {
        $Aktie1 = "{$row['stockvalue']}";
      }

$query = $connect->query("SELECT * FROM companies WHERE companyname = 'geox'");
      if($row = mysqli_fetch_array($query))  {
        $Aktie2 = $row['stockvalue'];
      }

$query = $connect->query("SELECT * FROM balance WHERE userid = '{$userdata['id']}'");
      if($row = mysqli_fetch_array($query))  {
        $balance = $row['balance'];
      }

$query_useraktie1 = $connect->query("SELECT * FROM currentstock WHERE userid = '{$userdata['id']}'AND companyid = 1");
      if($row = mysqli_fetch_array($query_useraktie1))  { 
        $antal1 = $row['antal'];
      }

$query_useraktie2 = $connect->query("SELECT * FROM currentstock WHERE userid = '{$userdata['id']}' AND companyid = 2");
      if($row = mysqli_fetch_array($query_useraktie2))  {
        $antal2 = $row['antal'];
        }

$query_aktie1 = $connect->query("SELECT * FROM companies WHERE  `aktieid` = '1'");
      if($row = mysqli_fetch_array($query_aktie1))  {
        $name1 = "{$row['companyname']}";    
	}

$query_aktie2 = $connect->query("SELECT * FROM companies WHERE  `aktieid` = '2'");
      if($row = mysqli_fetch_array($query_aktie2))  {
        $name2 = "{$row['companyname']}";    
		}

?>

<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="aktiespil.css">
<html>
<head>
    <title>Dashboard</title>
</head>
<body style="background-color:grey;">

<center>
  <div id="dashboardcontainer" >  
   Hello , <?php echo $userdata['username']; ?>
    balance , <?php echo $balance; ?>
    <?php echo $_SESSION['is_admin'] ? '<a href="admin.php">Adminpanel</a>':"" ?>
    <br>
   <a href="changepassword.php">Change Password</a>
    <a href="logout.php">Logout</a>

<h3>
<h1>køb</h1>
 <form method="post" action="buy.php">
 	<div>

<input type="radio" name="Aktie" value="ecco" id="Aktie1"> ecco
 		<input type="radio" name="Aktie" value="geox" id="Aktie2"> geox
 		<input type="number" name="Antal" id="Antal" onkeyup="this.value = minmax(this.value, 1); Udregning(); " onchange="this.value = minmax(this.value, 1); Udregning();">
    <input type="submit" name="køb" id="køb" value="køb" disabled>
<div>

        <input type="hidden" value="" name="pris" id="pris">pris og
        <input type="hidden" value="" name="newBalance" id="newbalance">
        
        <input type="hidden" value="" name="TotalAntal" id="TotalAntal">
        totalantal
      </div>
 	</div>
 </form>
  <div>
    <h3 id="output1"></h3>
    <h3 id="output2"></h3>
  </div>


  <h1>sælg</h1>
<div>
      <table> <form action="Sell.php" method="post">
        <tr><th>Aktie</th><th>Antal</th><th>AktieVærdi</th><th>Sælg</th></tr>
        <tr><td>ecco</td><td><?php echo $antal1; ?></td><td><?php echo $Aktie1; ?></td><td><input type="number" name="SAntal" id="SAntal1" max="<?php echo $antal1; ?>" onkeyup="Disable(1);" onchange="Disable(1); "></td></tr>

        <tr><td>geox</td><td><?php echo $antal2; ?></td><td><?php echo $Aktie2; ?></td><td><input type="number" name="SAntal" id="SAntal2" max="<?php echo $antal2; ?>" onkeyup="Disable(2);" onchange="Disable(2) "></td></tr>

        <input type="hidden" value="" id="SSAntal" name="SSAntal">
        <input type="hidden" value="" name="SUserID" id="SUserID">
        <input type="hidden" value="" name="SnameLogin" id="SnameLogin">
        <input type="hidden" value="" name="SpwLogin" id="SpwLogin">
        <input type="hidden" value="" name="STotalPris" id="STotalPris">
        <input type="hidden" value="" name="SCompanie" id="SCompanie">
        <input type="hidden" value="" name="STotalAntal" id="STotalAntal">
        <tr><td><input type="submit" id="SSubmit" name="SSubmit" value="Sælg"></td></tr>
      </form>
      </div>
</center>
<script>
  var UserID = "<?php echo $userdata['id'];?>";
    var nameLogin = "<?php echo $userdata['username'];?>";
    var pwLogin = "<?php echo $userdata['password'];?>";
    var Balance = "<?php echo $balance;?>";

    var Aktie1 = "<?php echo $Aktie1; ?>";
    var Aktie2 = "<?php echo $Aktie2; ?>";

    var Antal1 = "<?php echo $antal1; ?>" || 0 ;
    var Antal2 = "<?php echo $antal2; ?>" || 0;

  function Udregning()  {
      var Antal = document.getElementById("Antal").value;
      if (document.getElementById('Aktie1').checked) {
          var Price = Aktie1 * Antal;
        if(parseInt(Antal.length) < 1)  {
            document.getElementById("køb").disabled = true;
        }
        else if (Price < Balance)  {
          document.getElementById("output1").innerHTML = Price;
          document.getElementById("pris").value = Price;
          document.getElementById("køb").disabled = false;
          document.getElementById("newbalance").value = Balance - Price;
          document.getElementById("TotalAntal").value = (parseInt(Antal) + parseInt(Antal1)) || Antal.value;
          document.getElementById("output2").innerHTML =(parseInt(Antal) + parseInt(Antal1)) || Antal.value;
        }
        else {
          document.getElementById("køb").disabled = true;
          document.getElementById("output1").innerHTML = Price;
        }
      }
      if (document.getElementById('Aktie2').checked) {
          var Price = Aktie2 * Antal;
        if(parseInt(Antal.length) < 1)  {
            document.getElementById("køb").disabled = true;
        }
        else if (Price < Balance)  {
          document.getElementById("output1").innerHTML = Price;
          document.getElementById("pris").value = Price;
          document.getElementById("køb").disabled = false;
          document.getElementById("newbalance").value = Balance - Price;
          document.getElementById("TotalAntal").value = (parseInt(Antal) + parseInt(Antal2)) || Antal.value;
          document.getElementById("output2").innerHTML =(parseInt(Antal) + parseInt(Antal2)) || Antal.value;
        }
        else {
          document.getElementById("køb").disabled = true;
          document.getElementById("output1").innerHTML = Price;
        }
      }
    }

    function minmax(value, min)
      {
        if(parseInt(value.length) < 1)  {
            document.getElementById("køb").disabled = true;
            return ;
        }
        else if(parseInt(value) >= min)  {
             return value;
        }
        else if(parseInt(value) < min)  {
            document.getElementById("køb").disabled = false;
            return 1;
        }
        else {
            return value;
            document.getElementById("køb").disabled = false;
        }
      }
       function Disable(SAktie)  {
      if(SAktie == 1)  {
        if(Antal1 >= parseInt(document.getElementById("SAntal1").value))  {
          document.getElementById("SAntal2").value = "";
          document.getElementById("SSAntal").value = document.getElementById("SAntal1").value;
          var SPrice = Aktie1 * document.getElementById("SAntal1").value;
          document.getElementById("STotalPris").value = parseInt(SPrice) + parseInt(Balance);
          document.getElementById("SCompanie").value = "ecco";
          document.getElementById("STotalAntal").value = Antal1 - document.getElementById("SAntal1").value;
        }
        else {
          document.getElementById("SSubmit").disabled = true;
        }
      }
      else if(SAktie == 2)  {
        if(Antal2 >= parseInt(document.getElementById("SAntal2").value))  {
          document.getElementById("SAntal1").value = "";
          document.getElementById("SSAntal").value = document.getElementById("SAntal2").value;
          var SPrice = Aktie2 * document.getElementById("SAntal2").value;
          document.getElementById("STotalPris").value = parseInt(SPrice) + parseInt(Balance);
          document.getElementById("SCompanie").value = "geox";
          document.getElementById("STotalAntal").value = Antal2 - document.getElementById("SAntal2").value;
        }
        else {
          document.getElementById("SSubmit").disabled = true;
        }
      }
    }

 </script>
</body>
 </form>
</body>
</html>