<?php


/*
* script: forum_main.php
* @developed by gratefulDeadty 2014
*/


require 'init.php'; //our script which begins the forum & database connection.

$forum_main = $forums->getForum();

if (empty($_GET['forum']))
{
        $stmt = $dbh->query('SELECT * FROM forum_main');
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count == 0)
        {
            echo 'No forums created yet!';
        }
        
	//create a foreach to gather our fetch array.
	foreach ($forum_main as $forum)
	{
		$forum_name = $forum['name']; //name
		$forum_desc = $forum['description']; //description
                $forumid = $forum['id'];
		echo '<a href="forum.php?forum='.$forumid.'">' .$forum_name . '</a> - <i>' . $forum_desc . '</i><br />';

	} //end foreach()

} //end if()


if ($_GET['forum'])
{

	//first we check to see if there are any topics created.
	$stmt = $dbh->prepare('SELECT id,title,starter,lastreply FROM topics WHERE ' . 'forum=:forum ');
	$stmt->bindParam('forum', $_GET['forum']);
	$stmt->execute();
	$count = $stmt->rowCount();
	if ($count == 0)
	{
	        echo '<p>No topics have been found under the '.htmlspecialchars($_GET['forum'],ENT_QUOTES).'</a> forum.</p>';
		echo '<br /><br /><a href="addtopic.php?forum='.htmlspecialchars($_GET['forum'],ENT_QUOTES).'">Add Topic</a>';
	}
	else
	{
        	foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $topics)
                {
			$topic_id = $topics['id']; //id of topic.
			$topic_title = $topics['title']; //topic title.
			$topic_starter = $topics['starter']; //topic starter.
			$topic_lastreply = $topics['lastreply']; //last replied user
			echo '<a href="topic.php?id='.$topic_id.'">' .$topic_title . '<br />';

                } //end foreach()

                echo '<br /><br /><a href="addtopic.php?forum='.htmlspecialchars($_GET['forum'],ENT_QUOTES).'">Add Topic</a>';

	} //end else()

} //end if()

?>
