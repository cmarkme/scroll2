<?php
session_start();
include('config.php');
//error_reporting(0);
$link=mysqli_connect("localhost",$user,$password,"a8351038_scrolle");

// Check connection
if (mysqli_connect_errno($link))
{
	echo "Failed to connect t MySQL: " . mysqli_connect_error();
}

xdebug_break();
if (isset($_POST['postid']) AND isset($_POST['action'])) {
	// $postId = (int) mysql_real_escape_string($_POST['postid']);
	# check if already voted, if found voted then return
	// if (isset($_SESSION['vote'][$postId])) return;
	# connect mysql db


	# query into db table to know current voting score 
	#
	# mysqli_query($link, $query);
	$query = mysqli_query($link,"
		SELECT vote
		from row_items
		WHERE id = '{$_POST['postid']}' 
		LIMIT 1" );
	if(@$_POST['r']==1)
	{
		if ($data = mysqli_fetch_array($query)) {
			echo $data[0];return;
		}

	}
	# increase voting score

	if ($data = mysqli_fetch_array($query)) {
		if(!isset($_SESSION['vote'][$_POST['postid']]))
		{
			if ($_POST['action'] === 'up'){

				$vote = ++$data['vote'];
			}
			# update new voting score
			mysqli_query($link,"
				UPDATE row_items
				SET vote = '{$vote}'
				WHERE id = '{$_POST['postid']}' ");
			$_SESSION['vote'][$_POST['postid']] = true;
		}
		else
		{
		echo '1 Vote per Image';return;
		}
		$query = mysqli_query($link,"
			SELECT vote
			from row_items
			WHERE id = '{$_POST['postid']}' 
			LIMIT 1" );
		if(@!$_POST['r'])
		{
			if ($data = mysqli_fetch_array($query)) {
				echo $data[0];return;
			}

		}

		if(!isset($_SESSION['vote'][$_POST['postid']]))
		{
		echo 'fail';return;
		}



	}

}

