<?php
session_start();
function PrintTable($ars)
{
echo <<<LB
<div class="table-container">
<br><br>
<table class="table"; width="60%" border="1px solid black" cellspacing="2px" cellpadding="0px"> <caption><h2>Database MyUsers table</h2></caption>
LB;
foreach($ars as $ar)  {
echo '<tr style="background-color:blue;">';
echo '<td style="color:white" valign="middle" align="center">'.$ar["Fname"].'</td>';
echo '<td style="color:white" valign="middle" align="center">'.$ar["Lname"].'</td>';
echo '<td style="color:white" valign="middle" align="center">'.$ar["Phone"].'</td>';
echo '<td style="color:white" valign="middle" align="center">'.$ar["Email"].'</td>';
echo ' </tr>';
}
echo <<<LB
</table>
</div>
LB;
}
echo <<<LB
<!DOCTYPE html>
<html>
<head>
<title>SQL Database Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Database, MySQL Database">
<meta name="description" content="MySQL Database form">
<style>
body {background-color:#ffddff;background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ff8040;background-color:#80ff80;}
p {font-family:Georgia, serif;font-size:14px;font-style:normal;font-weight:normal;color:#000000;background-color:#ffffff;}
</style>
<script type="text/javascript">
function ClearForm()  {
  const x = document.forms["myform"];
  for (let i = 0; i < x.length; i++)
  if (x.elements[i].id!='subm')
  x.elements[i].value='';
}
</script>
</head>
<body>
<h1 id="myHeader">MySQL Database Example</h1><br>
<div style="border: 5px solid green; padding: 5px">
LB;
echo '<form id="myform" action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post">';
echo <<<LB
<label for="fusern">Input User Name:</label><br>
<input type="text" maxlength="20" id="fusern" name="UserN" size="20" required> <br><br>
<label for="fuserf">Input User SecondName:</label><br>
<input type="text" maxlength="20" id="fuserf" name="UserF" size="20" required> <br><br>
<label for="phone">Enter a phone number:</label>
<input type="tel" id="phone" name="phone" required
  placeholder="+38012-345-6789"
  pattern="+[0-9]{5}-[0-9]{3}-[0-9]{4}"> <br><br>
<label for="email">Enter your email:</label>
<input type="email" id="email" name="email" required><br><br>
<input type="submit" id="subm" value="Add a user"> <br><br>
</div>
LB;

if($_SERVER['REQUEST_METHOD']=='POST')  {
$mysqli=new mysqli("localhost","root","");
if ($mysqli->connect_error) 
die("Connection failed: ".$mysqli->connect_error);
else
echo '<script type="text/javascript">alert("Connected successfully");</script>';
try {
$querystr='CREATE DATABASE IF NOT EXISTS Users';
$mysqli->query($querystr);
$mysqli->select_db("Users");
$querystr='CREATE TABLE IF NOT EXISTS MyUsers (
Fname varchar(30) NOT NULL, Lname varchar(30) NOT NULL, Phone varchar(13) NOT NULL, Email varchar(13) NOT NULL, Dt DATE NOT NULL,PRIMARY KEY(Fname,LName)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';
$mysqli->query($querystr,MYSQLI_USE_RESULT);
mysqli_begin_transaction($mysqli);
$querystr='INSERT HIGH_PRIORITY INTO MyUsers(Fname,LName,Phone,Email,Dt) VALUES("'.$_POST["UserN"].'","'.$_POST["UserF"].'","'.$_POST["phone"].'","'.$_POST["email"].'",CURDATE()) ON DUPLICATE KEY UPDATE Fname=concat(fname,"1")';
$mysqli->query($querystr);
$result = $mysqli->query("SELECT * FROM MyUsers");
$mysqli->commit();
$rows = $result->fetch_all(MYSQLI_ASSOC);
} catch (mysqli_sql_exception $exception) {
  mysqli_rollback($mysqli);
  echo $exception; 
} finally {
  $mysqli->close();
}
PrintTable($rows);
}
echo <<<LB
</body>
</html>
LB;

?>