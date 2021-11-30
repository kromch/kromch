<?php
session_start();
echo <<<'LB'
<!DOCTYPE html>
<html>
<head>
<title> Ouput Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="DOM, Output">
<meta name="description" content="Output form">
<style>
body {background-color:#ffffff;background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ff8040;background-color:#80ff80;}
p {font-family:Georgia, serif;font-size:14px;font-style:normal;font-weight:normal;color:#110011;background-color:#ffffff;}
</style>
</head>
<script type="text/javascript">
function RefreshState(idh,st)  {
    document.getElementById(idh).innerHTML = "Getting value: "+st;
}
function ReturnOnMainPage(npage)  {
     window.location.href = npage;
}
</script>
<body>
<em><h1>Result of the choosen:</h1></em>
<p id="myField1" ></p><br>
<p id="myField2" ></p><br>
<p id="myField3" ></p><br>
LB;
if($_SERVER['REQUEST_METHOD']=='POST')  {
$_SESSION["Submit"]='alert("Thank you for to take participant in the Quiz")';
$json = file_get_contents('quiz.json');
$jobj = json_decode($json,true); $j=1;
foreach($_POST as $key => $value)  {
foreach($jobj as $ar)  {
$ar=$ar["answers"];
foreach($ar as $a)  
if($value==$a["modelauto"])  { 
$vl='Model auto: '.$a["modelauto"].'<br>'.'Price: $'.$a["price"].'<br>';
$vl=$vl.'Year: '.strval($a["yop"]).'<br>'.'Power of engine: '.strval($a["power"]).'<br>'.'Availabel at present: '.(($a["aval"])?'Yes':'No');
echo '<script type="text/javascript">RefreshState("myField'.strval($j).'","'.$vl.'")</script>';
$j++;
break;
}
}
}
}
else echo '<script type="text/javascript"> alert("Method of sending is not POST") </script>';
$mp=substr($_SERVER['HTTP_REFERER'],strrpos($_SERVER['HTTP_REFERER'],'/')+1,strlen($_SERVER['HTTP_REFERER']));

echo '<br>';
//echo 'value="Return to the Main Page" onclick="ReturnOnMainPage("'.$mp.'")"><br>';
echo '<input type="button" id="rett" value="Return to the Main Page" onclick="ReturnOnMainPage(\''.$mp.'\')"><br>';
echo <<<'LB'
</body>
</html>
LB;
?>