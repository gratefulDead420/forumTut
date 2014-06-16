<?php

/*
* script: forum_main.php
* @developed by gratefulDeadty 2014
*/

require 'config.php'; //our script which begins the forum & database connection.

$forum_main = $forums->getForum();
$topics = $forums->getTopics($_GET['forum']);


//check to see if any forum boards exist yet.
if (count($forum_main) == 0)
{
	die('No forums created yet');
}

if (empty($_GET['forum']))
{
?>

<div align="center">
<table cellspacing="0" cellpadding="0">
<tr>
<td width="100"><strong>Forum</strong></td>
<td width="200"></td>
<td width="50"><strong>Topics</strong></td>
<td width="50"><strong>Posts</strong></td>
<td width="200"><strong>Last Post</strong></td>
</tr>
</div>

	<?php
    	$color = 1;
	foreach ($forum_main as $forum)
	{
		if ($color % 2 != 0)
        	$trColor = "#CCCCCC"; 
        	else
        	$trColor = "#FFFFFF";
		$forum_name = $forum['name']; //name
		$forum_desc = $forum['description']; //description
        	$forumid = $forum['id'];
        	$lastpost = $forum['lastpost'];
        	$totaltopics = $forums->totalTopics($forumid);
        	$totalreplies = $forums->totalReplies($forumid);
		echo '<tr style="background-color:'.$trColor.';"><td><a href="forum.php?forum='.$forumid.'">' .$forum_name . '</a></td><td>' . $forum_desc . '</td><td>'.$totaltopics.'</td><td>'.$totalreplies.'</div></td><td>last post by ' .$lastpost. '</td>';
		++$color;
	} //end foreach()
    	echo '</tr></table>';
} //end if()


if ($_GET['forum'])
{
	if (count($topics) == 0)
	{
		echo '<p>No topics have been found under the '.htmlspecialchars($_GET['forum'],ENT_QUOTES).'</a> forum.</p>';
		echo '<br /><br /><a href="addtopic.php?forum='.htmlspecialchars($_GET['forum'],ENT_QUOTES).'">Add Topic</a>';
		die();
	}
	else
	{
	?>

<div align="center">
<table cellspacing="0" cellpadding="0">
<tr>
<td width="100"><strong>Forum</strong></td>
<td width="200"></td>
<td width="50"><strong>Posts</strong></td>
<td width="200"><strong>Last Post</strong></td>
</tr>
</div>

		<?php
		$color = 1;
		foreach ($topics as $topic) 
		{
			if ($color % 2 != 0)
			$trColor = "#CCCCCC"; 
			else
			$trColor = "#FFFFFF";
			$topic_id = $topic['id']; //id of topic.
			$topic_title = $topic['title']; //topic title.
			$topic_starter = $topic['starter']; //topic starter.
			$topic_lastpost = $topic['lastpost']; //last replied user
			$totalposts = $forums->totalPosts($topic_id);
			if ($topic['sticky'] == '1')
			{
				$sticky = 'STICKY';
			}
			else
			{
				$sticky = '';
			}	
			echo '<tr style="background-color:'.$trColor.';"><td>'.$sticky.'<a href="topic.php?id='.$topic_id.'">' .$topic_title . '</td><td></td><td>'.$totalposts.'</td><td>Last post by '.$topic_lastpost.'</td>';
			++$color;
		} //end foreach()

		echo '</tr></table>'; 
		echo '<br /><a href="addtopic.php?forum='.htmlspecialchars($_GET['forum'],ENT_QUOTES).'">Post new topic</a> - <a href="forum.php">Forum Main</a>';

	} //end else()

} //end if()

?>
