<?php

/*
* forum class script.
* @author gratefulDeadty
*/

class Forum
{
	private $dbh; //database handler.
	public function __construct($database)
	{
		$this->dbh = $database;
	}

/* function that gets the main forum board */
public function getForum()
{
	$query = $this->dbh->prepare('SELECT * FROM `forum_main` ORDER BY `id` DESC');
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

/* function that inserts a new topic */
public function addTopic($username, $title, $message, $whatforum)
{
	$query = $this->dbh->prepare("INSERT INTO `topics` (`starter`, `title`, `message`, `forum`) VALUES (?, ?, ?, ?) ");
	$query->bindValue(1, $username);
	$query->bindValue(2, $title);
	$query->bindValue(3, $message);
	$query->bindValue(4, $whatforum);
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
	$query = $this->dbh->prepare("SELECT * FROM `topics` WHERE `id`= ?");
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

/* function that inserts a new reply */
public function addReply($message, $username, $topicid)
{
	$query = $this->dbh->prepare("INSERT INTO `replies` (`message`, `username`, `topicid`) VALUES (?, ?, ?) ");
	$query->bindValue(1, $message);
	$query->bindValue(2, $username);
	$query->bindValue(3, $topicid);
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
