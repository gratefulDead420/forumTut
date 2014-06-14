<?php

/*
* script: topic.php
* @developed by gratefulDeadty
*/

require 'init.php';

$topic = $forums->topicData($_GET['id']);

echo '<center><strong>Topic '.$topic['id'].' - '.$topic['title'].'</strong></center>';

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
		echo ' ' .$starter. ' - ' .$message. '<br /><br />';

	} //end empty($errors)

    //begin Reply section.
    $stmt = $dbh->prepare('SELECT * FROM replies WHERE ' . 'topicid=:topicid ');
    $stmt->bindParam('topicid', $_GET['id']);
    $stmt->execute();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $reply)
    {
        $reply_username = $reply['username'];
	    $reply_message = $reply['message'];
	    echo ' ' .$reply_username. ' - ' .$reply_message. '<br />';
    }

	echo '<br /><div><strong>Reply:</strong><form method="POST">Email/Name: <input type="text" name="username"><br /><textarea name="message" cols="40" rows="4">Body</textarea>
<br /><input type="hidden" name="topicid" value="'.$_GET['id'].'"><input type="submit" name="submit" value="Add Reply"></form></div>';

}

if (isset($_POST['submit']))
{
    //submitting the reply.
	if (empty($_POST['message']) || empty($_POST['username']) === true)
	{
	    $errors[] = 'Error: You must enter a reply message and/or an email.';
	}
	else
	{
	    //insert the reply into the database.
		$message = $_POST['message'];
		$username = $_POST['username'];
		$topicid = $_POST['topicid'];
		$insert_reply = $forums->addReply($message,$username,$topicid);
	    echo 'You have created a reply!';
	}

}

    //displaying all errors from the $errors[] array.
	if (empty($errors) === false)
	{
    	echo '<p>' . implode('</p><p>', $errors) . '</p>';	
    }

?>
