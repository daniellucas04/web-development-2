<?php
$number1 = $_GET['number1'];
$number2 = $_GET['number2'];

if($number1 > $number2) echo "$number1 é maior que $number2 (>)<br>";
if($number2 > $number1) echo "$number2 é maior que $number1 (>)<br>";
if($number1 < $number2) echo "$number1 é menor que $number2 (<)<br>";
if($number2 < $number1) echo "$number2 é menor que $number1 (<)<br>";
if($number1 == $number2) echo "$number1 é igual a $number2 (==)<br>";
if($number1 === $number2) echo "$number1 é identico a $number2 (===)<br>";
if($number2 !== $number1) echo "$number2 não é identico a $number1 (!==)<br>";
if($number1 <> $number2) echo "$number1 é diferente de $number2 (<>)<br>";
if($number2 != $number1) echo "$number2 é diferente de $number1 (!=)<br>";
if(($number1 <=> $number2) == -1) echo "$number1 é menor que $number2 (<=>)<br>";
if(($number1 <=> $number2) == 0) echo "$number1 é igual a $number2 (<=>)<br>";
if(($number1 <=> $number2) == 1) echo "$number1 é maior que $number2 (<=>)<br>";
?>