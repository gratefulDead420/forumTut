<?php

/*
* script: add_topic.php
* @developed by gratefulDeadty
*/

require_once 'init.php'; 

$errors = array(); //for displaying errors.

if(empty($_GET['forum']) === true)
{
	$errors[] = 'Error: Forum does not exist.';
}
else
{
	echo '<form method="POST">
	<input type="text" name="username">
	<input type="text" name="title">
	<input type="text" name="message">
	<input type="submit" name="Submit" value="Submit">';
}

if (isset($_POST['submit']))
{
	if (empty($_POST['username']) || empty($_POST['title']) || empty($_POST['message']))
	{
		$errors[] = 'Error: All fields are required to post.';
	}
	else
	{
		if (empty($errors) === true)
		{
			$username = htmlentities($_POST['username']);
			$title = htmlentities($_POST['title']);
			$message = htmlentities($_POST['message']);
			$whatforum = (int)$_GET['forum'];
			$forums->addTopic($username,$title,$message,$whatforum);
			echo '<p>Thank you, your topic has been added to the '.htmlspecialchars($_GET['forum'],ENT_QUOTES).' forum.</p>';
			echo '<br /><a href="forum.php">Back to main board</a>';
		}
	}
}

//displaying all errors from the $errors[] array.
if (empty($errors) === false)
{
	echo '<p>' . implode('</p><p>', $errors) . '</p>';	
}

?>

