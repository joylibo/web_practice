<?php
$str = "world";
echo $html_str =<<<HLW
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>helloworld_dynamic</title>
  </head>
  <body>
HLW;

echo "<p>hello".$str."!</p>";
echo "</body>";
echo "</html>";

 ?>
