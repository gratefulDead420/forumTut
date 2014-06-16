<?php 

session_start();

/*
* script: config.php
*
* this is the site configuration file.
* you include it on the top of every page within the forum.
* it handles our forum class, and error[] array.
*/

require 'database.php';
require 'forum.class.php';

$forums = new Forum($dbh);
$errors = array(); //creates the $errors[] array.

ob_start('ob_gzhandler');

?>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
