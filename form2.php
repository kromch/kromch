<?php
session_start();
echo <<<'LB'
<!DOCTYPE html>
<html>
<head>
<title> Session Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="DOM, User registration">
<meta name="description" content="Login form">
<style>
body {background-color:#ffffff;background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ff8040;background-color:#80ff80;}
p {font-family:Georgia, serif;font-size:14px;font-style:normal;font-weight:normal;color:#000000;background-color:#ffffff;}
</style>
</head>
<script type="text/javascript">
function DelElementID(idn)  {     
    document.getElementById(idn).remove();
}
function RefreshState(st)  {
    document.getElementById("myHeader").innerHTML = "Sign in Administrator is now: "+st+"<br>";
}
function ExecPHPCode()  {
    document.write('<?php $_SESSION["Login"]="UNLOGGED";?>');
    window.location.href = "form2.php";

}
</script>
<body>
<h1 id="myHeader"></h1><br>
LB;
$_SESSION["Login"]='UNLOGGED';
echo '<script type="text/javascript">RefreshState("'.$_SESSION["Login"].'")</script>';

echo '<form id="myform" action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post">';
echo <<<LB
<label for="fuser">Input Administrator Login:</label><br>
<input type="text" maxlength="20" id="fuser" name="UserID" size="20" required> <br><br>
<label for="passw">Input Administrator Password (at least 5 symbols):</label><br>
<input type="password" maxlength="20" id="passw" name="Passwd" size="20" 
  pattern="[A-Za-z]{1}[A-Za-z0-9]{4,9}" required> <br><br>
<input type="submit" id="subm" value="Sign in user"> <br><br>
<input type="button" id="logt" value="Logout" onclick="ExecPHPCode()" disabled> <br><br>
LB;
if($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['Passwd']))

if($_POST["UserID"]=='Admin'&&htmlspecialchars($_POST["Passwd"])=="AdmiN")  {
$_SESSION["Login"]="LOGGED";
echo '<script type="text/javascript"> RefreshState("'.$_SESSION["Login"].'");</script>';
echo '<script type="text/javascript">document.getElementById("subm").disabled = true;</script>';
echo '<script type="text/javascript">document.getElementById("logt").disabled = false;</script>';
}
else  {
echo '<script type="text/javascript">alert("Invalid Administrator Login or Password. Please re-input valid") </script>';
unset($_SESSION["Login"]);
session_unset();
header("Refresh:0");
}

echo <<<LB
</form>
</body>
</html>
LB;
?>