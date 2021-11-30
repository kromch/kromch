<?php
require_once('form.class.php');
session_start();
echo <<<'LB'
<!DOCTYPE html>
<html>
<head>
<title>JSON Session Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="DOM, JSON Form generator ">
<meta name="description" content="JSON Login form">
<style>
body {background-color:#effffe;background-repeat:no-repeat;background-position:top left;background-attachment:fixed; padding:20px;}
label{ display:block; padding:10px;}

input{ padding:10px; }
h1{text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ff8040;background-color:#80ff80;}
p {font-family:Georgia, serif;font-size:14px;font-style:normal;font-weight:normal;color:#000000;background-color:#ffffff;}
</style>
</head>
<body>
<h1 id="myHeader">Generation submit form from JSON</h1><br>
LB;
//echo '<form id="genform" action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post"></form>';
$form = new Form(['file'=>'./example_form.json']);

$form->show();
echo <<<LB

LB;
if($_SERVER['REQUEST_METHOD']=='POST')  {
$json=array();
if(file_exists('bd.json')) {
$handle=fopen('bd.json','r+');
$jf=fgets($handle,filesize('bd.json')+1);
$json=json_decode($jf,true);
$json=$json[0];
}
else 
$handle=fopen('bd.json','x+');
if($_POST["Login"]==$json["Login"])
echo '<script type="text/javascript">alert("Login formerly saved and not will be saved again. \n Input another Login.")</script>';
else {
$jf=json_encode($_POST);
ftruncate($handle,0);
fseek($handle,0,SEEK_SET);
fwrite($handle,"[");
fwrite($handle,$jf,strlen($jf));
fwrite($handle,"]");
echo '<script type="text/javascript">alert("Login saved succsessful.")</script>';
}
fclose($handle);
}
echo <<<LB
</body>
</html>
LB;
?>