<?php
include "db.php";

$id = $_GET['id'];

$query = "delete from tasks where id=$id";

$var = $db->query($query);

if($var){
  header('location: index.php');
}

?>