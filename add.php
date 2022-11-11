<?php
include 'db.php';

if(isset($_POST['send'])){
  $name = htmlspecialchars($_POST['task']);

  $query = "insert into tasks (name) values ('$name')";

  $val = $db->query($query);

  if($val){
    header("location: index.php");
  }
}


?>