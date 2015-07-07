<?php
define("NEW_LINE", "</BR>");
include_once("timestamp.php");
$test=new scTimestamp();

echo $test->getDateAsString();

$test->setTimestamp(1210203200);

echo $test->getDateDifferenceFromNow();

echo $test;

$test->setTimestamp(121020320022);
echo $test->getYear();

?>
