<?php


/*
* script: forum_main.php
* @developed by gratefulDeadty 2014
*/


require_once = 'init.php'; //our script which begins the forum & database connection.



$forums = new Forum($dbh); //calls Forum class.

$forum_main = $forums->getForum();

if (empty($_GET['action']))
{
	//create a foreach to gather our fetch array.
	foreach ($forum_main as $forum)
	{
		$forum_name = htmlentities($forum['name']); //name
		$forum_desc = htmlentities($forum['description']); //description
		echo '<a href="forum.php?forum='.$forum_name.'">' .$forum_name . ' - ' . $forum_desc . '<br />';
	}
}

if ($_GET['forum'])
{
	foreach ($forum_topics as $topics)
	{
		//first we check to see if there are any topics created.
		$stmt = $dbh->prepare('SELECT * FROM topics WHERE ' . 'forum=:forum ');
		$stmt->bindParam('forum', $_GET['forum']);
		$stmt->execute();
		$count = $stmt->rowCount();
		if ($count == 0)
		{
			echo '<p>No topics have been found under the '.htmlspecialchars($_GET['forum'],ENT_QUOTES).' forum.</p>';
			echo '<br /><br /><a href="addtopic.php?forum='.htmlspecialchars($_GET['forum'],ENT_QUOTES).'">Add Topic</a>';
		}
		else
		{
			$topic_id = htmlentities($topics['id']); //id of topic.
			$topic_title = htmlentities($topics['title']); //topic title.
			$topic_starter = htmlentities($topics['starter']); //topic starter.
			$topic_lastreply = htmlentities($topics['lastreply']); //last replied user
			echo '<a href="topic.php?id='.$topic_id.'">' .$topic_title . ' - ' . $forum_desc . '<br />';

		} //end else

	} //end foreach()

} //end $_GET

?>
