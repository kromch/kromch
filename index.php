<?php


(file_exists(str_replace('/','',$_SERVER['REQUEST_URI'])))? include 'pages/'.str_replace('/','',$_SERVER['REQUEST_URI']).'.php': include 'pages/main.php';

print "<p> ".$_SERVER['QUERY_STRING']." </p> <br>";

$params=explode("&",$_SERVER['QUERY_STRING']);
if(!empty($params)) {
foreach($params as $value)
{
$value=str_replace('%22','',$value);
$value=str_replace('%27','',$value);
print "<p> ".$value." </p> <br>";
$val=explode("=",$value);
print "<p> ".$val[1]." </p> <br>";
}
unset($value); unset($val); 

var_dump($params);  }

phpinfo()
    

?>