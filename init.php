<?php 

session_start();

require 'database.connection.php';

$forums = new Forum($dbh);
$errors = array();

//ob_start();

/* if error 'header already sent' undo the ob_start note. */

?>
