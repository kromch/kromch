<?php



$s='one;two;three;four';


$p=0;
$k=0;
$t=0;$l=strlen($s);
$n=1;


$s1=''; $s2=''; $s3='';



do 
{

$p=stripos($s,';',$k);

$t=strripos($s,';',$l-strlen($s)-1);

if ($p==false)  { $p=strlen($s);}

$s1=$s1.ucfirst(substr($s,$k,$p-$k));

$s2=$s2."$n".'-'.substr($s,$k,$p-$k);

if($p<strlen($s)) { $s1=$s1.';'; $s2=$s2.';'; }

$k=$p+1;


if($t==false) { $t=-1;}

$s3=$s3.substr($s,$t+1,$l-$t-1);

$l=$t;

if($t>0) $s3=$s3.'-';

$n=$n+1;

} 
while($k<strlen($s));
?>