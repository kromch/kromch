<?php
session_start();
$_SESSION["Submit"]='alert("Thank you for to take participant in the Quiz")';
echo <<<LB
<!DOCTYPE html>
<html>
<head>
<title> Quiz Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Quiz, Participant in the quiz">
<meta name="description" content="Quiz form">
<style>
body {background-color:#ffddff;background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ff8040;background-color:#80ff80;}
p {font-family:Georgia, serif;font-size:14px;font-style:normal;font-weight:normal;color:#000000;background-color:#ffffff;}
</style>
</head>
<body>
<h1 id="myHeader">Mercedes-Benz Quiz</h1><br>
<div style="border: 3px solid blue;">
LB;
$json = file_get_contents('quiz.json');
$jobj = json_decode($json);
if ($jobj)  {
$i=0;$j=0;
echo '<form id="myquiz" action="act.php" method="post">';
foreach($jobj as $obj) {
echo '<em>Question:'.$obj->{'question'}.' On the site: '.$obj->{'dealer'}.' Select variant:</em><br>';
foreach($obj->{'answers'} as $jt)  {
echo '<input type="radio" id="car'.strval($i).'" name="car'.strval($j).'" value="'.$jt->{'modelauto'}.'">';
echo '<label for="car'.strval($i).'">'.$jt->{'modelauto'}.'</label><br>';
$i++;
}
$j++;
}
echo <<<'LB'
<br><input type="submit" id="subm" value="Check choices"> <br><br>
</form>
LB;
if (isset($_SESSION["Submit"]))  {
echo '<script type="text/javascript">'.$_SESSION["Submit"].'</script>';
unset($_SESSION["Submit"]);
session_destroy();
}
}
else die("The quiz JSON broken");
echo <<<LB
</div>
</body>
</html>
LB;
?>