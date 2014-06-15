<?php

/*
* script: forum_main.php
* @developed by gratefulDeadty 2014
*/

require 'init.php'; //our script which begins the forum & database connection.

$forum_main = $forums->getForum();
$topics = $forums->getTopics($_GET['forum']);

if (empty($_GET['forum']))
{

?>

<div align="center">
<table>
<tr>
<td width="100"><strong>Forum</strong></td>
<td width="200"></td>
<td width="50"><strong>Topics</strong></td>
<td width="50"><strong>Posts</strong></td>
<td width="200"><strong>Last Post</strong></td>
</tr>
</div>

        <?php
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
                $lastpost = $forum['lastpost'];
                $totaltopics = $forums->totalTopics($forumid);
                $totalreplies = $forums->totalReplies($forumid);
		echo '<tr><td><a href="forum.php?forum='.$forumid.'">' .$forum_name . '</a></td><td>' . $forum_desc . '</td><td>'.$totaltopics.'</td><td>'.$totalreplies.'</div></td><td>last post by ' .$lastpost. '</td>';

	} //end foreach()
        echo '</tr></table>';
} //end if()


if ($_GET['forum'])
{

?>

<div align="center">
<table>
<tr>
<td width="100"><strong>Forum</strong></td>
<td width="200"></td>
<td width="50"><strong>Posts</strong></td>
<td width="200"><strong>Last Post</strong></td>
</tr>
</div>

        <?php
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
        	foreach ($topics as $topic)
                {
			$topic_id = $topic['id']; //id of topic.
			$topic_title = $topic['title']; //topic title.
			$topic_starter = $topic['starter']; //topic starter.
			$topic_lastreply = $topic['lastreply']; //last replied user
			echo '<tr><td><a href="topic.php?id='.$topic_id.'">' .$topic_title . '</td><td></td><td>0</td><td>last post by</td>';

                } //end foreach()
		
                echo '</tr></table>';
                echo '<br /><a href="addtopic.php?forum='.htmlspecialchars($_GET['forum'],ENT_QUOTES).'">Post new topic</a> - <a href="forum.php">Forum Main</a>';

	} //end else()

} //end if()

?>
