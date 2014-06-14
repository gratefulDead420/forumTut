<?php 

session_start();

require 'database.connection.php';
require 'forum.class.php';

$forums = new Forum($dbh); //begin our forum class.
$errors = array(); //begin our error array.

ob_start();

?>
