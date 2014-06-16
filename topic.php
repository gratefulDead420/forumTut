<?php

/*
* script: topic.php
* @developed by gratefulDeadty
*/

require 'config.php';

$topic = $forums->topicData($_GET['id']);
$reply = $forums->replyData($_GET['id']);

if(empty($_GET['id']) === true)
{
	$errors[] = 'Error: Forum does not exist. ';
}
else
{
        if (count($topic['id']) == 0)
	{
		$errors[] = 'Error: This topic doesn\'t exist. Click <a href="forum.php">here</a> to go back.';
	}

	//success -> now we display the topic, but only if no errors are involved.
	if(empty($errors) === true)
	{
		$starter = $topic['starter'];
		$title = $topic['title'];
		$message = $topic['message'];
                $created = $topic['created'];
                echo '<p><strong>'.$title.'</strong> - <span style="font-size:8pt;"><i>Posted by '.$starter.'</i></span><br />'.$message.'</p>';

		$i = 0;
    		foreach ($reply as $replies)
    		{
			++$i;
            		$reply_username = $replies['username'];
	    		$reply_message = $replies['message'];
            		$created = $replies['created'];
            		$whatforum = $replies['forum'];
	    		echo ''.$i.': ' .$reply_username. ' - ' .$reply_message. '<br /><br />';
    		}

		echo '<br /><div><strong>Reply:</strong><form method="POST">Email/Name: <input type="text" name="username"><br /><br /><textarea name="message" cols="40" rows="4">Body</textarea>
<br /><input type="hidden" name="topicid" value="'.htmlspecialchars($_GET['id'],ENT_QUOTES).'"><input type="submit" name="submit" value="Add Reply"></form></div>';

	}

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
		$message = htmlentities($_POST['message']);
		$username = htmlentities($_POST['username']);
		$topicid = htmlentities($_POST['topicid']);
                $whatforum = htmlentities($topic['forum']);
                $created = date('Y-m-d H:i:s');
		$insert_reply = $forums->addReply($message,$username,$topicid,$whatforum,$created);
                $forumpost_update = $forums->updatelastPost($username,$whatforum);
                $topicreply_update = $forums->updatelastReply($username,$topicid);
	        echo 'You have created a reply!';
	}

}

//if any errors occured, we'll display them using the $errors[] array.
if (empty($errors) === false)
{
	echo ' '.implode($errors).' ';
}
?>
