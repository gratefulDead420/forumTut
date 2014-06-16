<?php

/*
* script: database.connection.php
*/

$host = 'host';
$dbuser = 'dbuser';
$dbpass = 'dbpass';
$dbname = 'dbname';

try
{
	$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $dbuser, $dbpass);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
	echo 'Connection failed: ' . $e->getMessage();
	//file_put_contents('connection.errors.txt', $e->getMessage().PHP_EOL,FILE_APPEND);
}

?>
