<?php

/*
* script: forum.class.php
* developed by gratefulDeadty
* 
* this is our forum class, easily custumizable, and easy to add to it.
*/

class Forum
{
	private $dbh; //dbh = database handler.
	public function __construct($database)
	{
		$this->dbh = $database;
	}

/* function that gets the main forum board */
public function getForum()
{
	$query = $this->dbh->prepare('SELECT * FROM `forum_main` ORDER BY `id` ASC');
	try
	{
		$query->execute();
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
	return $query->fetchAll();
}

/* function that gathers the topic list, based off which forum a user is viewing. */
public function getTopics($forumid)
{
	$query = $this->dbh->prepare('SELECT * FROM `topics` WHERE `forum`= ?');
	$query->bindValue(1, $forumid);
	try
	{
		$query->execute();
		return $query->fetchAll();
	} 
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
}

/* function that inserts a new topic */
public function addTopic($username, $title, $message, $whatforum, $created)
{
	$query = $this->dbh->prepare('INSERT INTO `topics` (`starter`, `title`, `message`, `forum`, `created`) VALUES (?, ?, ?, ?, ?) ');
	$query->bindValue(1, $username);
	$query->bindValue(2, $title);
	$query->bindValue(3, $message);
	$query->bindValue(4, $whatforum);
        $query->bindValue(5, $created);
	try
	{
		$query->execute();
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}	
}

/* function that gathers information about the topic */
public function topicData($topicid) 
{
	$query = $this->dbh->prepare('SELECT * FROM `topics` WHERE `id`= ?');
	$query->bindValue(1, $topicid);
	try
	{
		$query->execute();
		return $query->fetch();
	} 
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
}

/* function that gathers information about the replies within the topic. */
public function replyData($topicid) 
{
	$query = $this->dbh->prepare('SELECT * FROM `replies` WHERE `topicid`= ?');
	$query->bindValue(1, $topicid);
	try
	{
		$query->execute();
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
	return $query->fetchAll();
}


/* function that inserts a new reply */
public function addReply($message, $username, $topicid, $whatforum, $created)
{
	$query = $this->dbh->prepare("INSERT INTO `replies` (`message`, `username`, `topicid`, `forum`, `created`) VALUES (?, ?, ?, ?, ?) ");
	$query->bindValue(1, $message);
	$query->bindValue(2, $username);
	$query->bindValue(3, $topicid);
        $query->bindValue(4, $whatforum);
        $query->bindValue(5, $created);
	try
	{
		$query->execute();
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}	
}


/* function that adds up the total amount of topics. */
public function totalTopics($forumid)
{
	$query = $this->dbh->prepare("SELECT id FROM topics WHERE forum = ?");
        $query->bindValue(1, $forumid);
        try
	{
		$query->execute();
		return $query->rowCount();
	} 
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
}

/* function that adds up the total amount of replies */
public function totalReplies($forumid)
{
	$query = $this->dbh->prepare("SELECT id FROM replies WHERE forum = ?");
        $query->bindValue(1, $forumid);
        try
	{
		$query->execute();
		return $query->rowCount();
	} 
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
}

/* function that updates the last post, showing on the main forum board */
public function updatelastPost($whatforum)
{
	$query = $this->dbh->prepare('UPDATE `forum_main` SET `lastpost`=? WHERE `id`=? ');
	$query->bindValue(1, $username);
	$query->bindValue(2, $whatforum);
	try
	{
		$query->execute();
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}	
}

/* function that updates the last post, showing on the topics page */
public function updatelastReply($username,$topicid)
{
	$query = $this->dbh->prepare('UPDATE `topics` SET `lastpost`=? WHERE `id`=? ');
	$query->bindValue(1, $username);
	$query->bindValue(2, $topicid);
	try
	{
		$query->execute();
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}	
}


} //end Forum class.	
