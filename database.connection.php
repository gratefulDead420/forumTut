<?php

/*
* script: database.connection.php
*/

$config = array( 
	'host'		=> 'host', 
	'username' 	=> 'db_user',
	'password' 	=> 'db_pass',
	'dbname' 	=> 'db_name'
	);

try
{

	$dbh = new PDO('mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'], $config['username'], $config['password']);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}
catch(PDOException $e)
{
	echo 'Connection failed: ' . $e->getMessage();
}

?>
