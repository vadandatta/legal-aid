<?php 
session_start();
include_once ("db.php");
if(isset($_SESSION["role"])){
  $role = $_SESSION["role"];
}else{
  $role = "none";
}

if($role == 'client'){
  include_once ("client/index.php");
}else if($role == 'lawyer'){
  include_once ("lawyer/index.php");
}else{
  include_once ("home/index.html");
}

?>