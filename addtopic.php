<?php

/*
* script: add_topic.php
* @developed by gratefulDeadty
*/

require 'config.php'; 

if(empty($_GET['forum']) === true)
{
	$errors[] = 'Error: Forum does not exist.';
}
else
{
	echo '<div><form method="POST">
	Email/Name: <input type="text" name="username"><br />
	Post Title: <input type="text" name="title"><br />
	Post Body: <input type="text" name="message"><br />
	<input type="submit" name="submit" value="Submit"></div>';
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
                        $created = date('Y-m-d H:i:s');
			$forums->addTopic($username,$title,$message,$whatforum,$created);
                        $newtopicid = $dbh->lastInsertId();
			echo '<p>Thank you, your topic has been added to the '.htmlspecialchars($_GET['forum'],ENT_QUOTES).' forum.</p>';
			echo '<br /><a href="forum.php">Back to main board</a> <font color="#898989">or click <a href="topic.php?id='.$newtopicid.'">here</a>';
		}
	}
}

//displaying all errors from the $errors[] array.
if (empty($errors) === false)
{ 
	echo ' '.implode($errors).' ';
}
?>
