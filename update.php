<?php
include 'db.php';

if(isset($_POST['update'])){
  $name = htmlspecialchars($_POST['taskUpdate']);
  $id = $_POST['name_id'];

  $query = "UPDATE tasks SET name='$name' where id=$id";

  $val = $db->query($query);

  if($val){
    header("location: index.php");
  }
}


?>