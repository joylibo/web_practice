<?php
$username = isset($_POST["username"])?$_POST["username"]:null;
$pwd = isset($_POST["pwd"])?$_POST["pwd"]:null;
if ("ajax" == $username && "login" == $pwd) {
  echo 1;
}else {
  echo 0;
}
