<?php

$db = new Mysqli;

// Create connection
$db->connect('localhost', 'root', '', 'crud');

// Check connection
if (!$db) {
  die("Connection failed");
}
?> 