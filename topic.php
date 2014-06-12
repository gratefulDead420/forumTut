<?php

/*
* script: topic.php
* @developed by gratefulDeadty
*/

require_once = 'init.php';

$errors = array(); //for displaying errors.

$topic = $forums->topicData($_GET['id']);

if(empty($_GET['id']) === true)
{
	$errors[] = 'Error: Forum does not exist.';
}
else
{
	$stmt = $dbh->prepare('SELECT * FROM topics WHERE ' . 'id=:id ');
	$stmt->bindParam('id', $_GET['id']);
	$stmt->execute();
	$count = $stmt->rowCount();
	if ($count == 0)
	{
		$errors[] = 'Error: This topic does not exist.';
	}
	
	//success -> now we display the topic.
	if(empty($errors) === true)
	{
		$starter = $topic['starter'];
		$title = $topic['title'];
		$message = $topic['message'];
		echo ' ' .$starter. ' - ' .$title. '<br /><br />' .$message. ' ';

	} //end empty($errors)
	
    //begin Reply section.
	$stmt = $dbh->prepare('SELECT * FROM replies WHERE ' . 'topicid=:topicid ');
    $stmt->bindParam('topicid', $_GET['id']);
    $stmt->execute();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $reply)
    {
        $reply_username = $reply['username'];
	    $reply_message = $reply['message'];
	    echo ' ' .$reply_username. '<br />' .$reply_message. '<br />';
    }
	
	echo '<form method="POST"><input type="text" name="email"><textarea name="reply_message" cols="40" rows="4">Body</textarea>
<br /><input type="hidden" name="topicid" value="'.$_GET['id'].'"><input type="submit" name="submit" value="Add Reply"></form>';

}

if (isset($_POST['submit']))
{
    //submitting the reply.
	if (empty($_POST['reply_message']) || empty($_POST['email']) === true)
	{
	    $errors[] = 'Error: You must enter a reply message and/or an email.';
	}
	else
	{
	    //insert the reply into the database.
		$reply_message = htmlentities($_POST['message']);
		$reply_email = htmlentities($_POST['email']);
		$topicid = htmlentities($_POST['topicid']);
		//$topicid = (int)$_GET['id'];
		$insert_reply = $forums->addReply($reply_message,$reply_email,$topicid);
	    echo 'You have created a reply!';
	}
	
}
	
	
	
    //displaying all errors from the $errors[] array.
	if (empty($errors) === false)
	{
    	echo '<p>' . implode('</p><p>', $errors) . '</p>';	
    }
	
?>
