<?php
namespace Cards;
class Card
{
public $number = '1234567';
private string $pin_code;
private int $balance=0;
public function __construct() {
$this->$pin_code=(string)random_int(1000,9999);
}
public function get_balance() {
return $this->balance;
}
public function get_pin() {
return $this->$pin_code;
}
public function change_pin(string $np) {
$np=substr(trim($np),0,4);
if(intval($np)>=1000&&intval($np)<=9999) {
$this->$pin_code=$np;
}
else echo 'Inadmissible new value pin code';
}

public function add_balance(int $sum,string $pin) {
if(strcmp($this->$pin_code,$pin)==0&&$sum>=10) 
    $this->make_inc_transaction((int)$sum);
 else 
    echo 'Increase balance less then $10 not allowed or wrong pin code';
}
public function sub_balance(int $sum,string $pin) {
if(strcmp($this->$pin_code,$pin)==0&&(int)$sum>=10) 
    $this->make_sub_transaction((int)$sum);
 else 
    echo 'Decrease balance less then $10 not allowed or wrong pin code';
}

private function make_sub_transaction($sum) {
if($this->balance>=$sum)
$this->balance=$this->balance-$sum;
}

private function make_inc_transaction($sum) {
$this->balance=$this->balance+$sum;
}
}
echo <<<'LB'
<!DOCTYPE html>
<html>
<head>
<title>Class for pay Card in PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="Class realization i PHP">
<meta name="description" content="Class a dedit/credit pay card">
<style>
body {background-color:#eeffee;background-repeat:no-repeat;background-position:top left;background-attachment:fixed;}
h1{text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ff8040;background-color:#80ff80;}
p {font-family:Georgia, serif;font-size:24px;font-style:normal;font-weight:normal;color:#ff00ff;background-color:#ffffff;}
</style>
</head>
<p>
LB;
$card1=new Card;
$card2=new Card;
echo "Increase total summa Card1 on 500 and summa Card2 on 700 ...<br>";
$card1->add_balance(500,$card1->get_pin());
echo "<br>";
$card2->add_balance(700,$card2->get_pin());
echo "<br>";
echo "Total balance Card1: ".strval($card1->get_balance())."<br>";
echo "Total balance Card2: ".strval($card2->get_balance())."<br><br>";
$card1->sub_balance(210,$card1->get_pin());
echo "<br>";
echo "Trying get out from Card1 210 and residual: ".strval($card1->get_balance())."<br>";
$card2->sub_balance(1000,$card2->get_pin());
echo "<br>";
echo "Trying get out from Card2 1000 and residual: ".strval($card2->get_balance())."<br><br>";
echo "Change pin code Card1 to AA351, current pin code: ".$card1->get_pin()."<br>";
$card1->change_pin("AA351");
echo "<br>";
echo "Change pin code Card1 to 3205, current pin code: ".$card1->get_pin()."<br>";
$card1->change_pin("3205");
echo "<br>";
echo "New pin code Card1 is: ".$card1->get_pin()."<br>";
echo <<<LB
</p>
</form>
</body>
</html>
LB;
?>
