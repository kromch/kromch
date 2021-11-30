<?php

$X=[1,2,3,4,5,6,7,8];
$Y=["a","b","c","d","e","f","g","h"];

print "<table class=\"table\"; border=\"1px solid black\"; border-spacing=\"0px\"> <caption>Chess Board</caption>";


for ($i = 0; $i<count($X); $i++) {

  print "<tr>";
   
  for ($j = 0; $j<count($Y); $j++) {

     $m=(($i+$j)%2==0)?'white':'black';
     $n=($m=='white')?'black':'white';
 
     print "<td nowrap; style=\"color:".$n."\"; height=\"80\"; width=\"80\"; valign=\"middle\"; align=\"center\"; bgcolor=\"".$m."\">"."$X[$i]".$Y[$j]."</td>";

      }

  print "</tr>";

}


print "</table>";    

?>