<?php

/*
* script: database.connection.php
*/

$config = array( 
	'host'		=> 'localhost', 
	'username' 	=> 'root',
	'password' 	=> 'pass',
	'dbname' 	=> 'forum'
	);

try
{
	
	$dbh = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}
catch(PDOException $e)
{
	echo 'Connection failed: ' . $e->getMessage();
    //file_put_contents('connection.errors.txt', $e->getMessage().PHP_EOL,FILE_APPEND);
}

?>
