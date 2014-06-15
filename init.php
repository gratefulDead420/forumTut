<?php 

session_start();

require 'database.php';
require 'forum.class.php';

$forums = new Forum($dbh);
$errors = array();

ob_start("ob_gzhandler");

?>

<link rel="stylesheet" type="text/css" href="stylesheet.css">
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
