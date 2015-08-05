
<?php
$db= new mysqli("localhost", "root", "root", "blog");


if ($db-> connect_errno){
	echo "Failed to connect to MySQL" . "<br>";
	echo $db->connect_error;
	exit();
}

$view= $db->prepare('SELECT title, author, date, modified, contents FROM posts WHERE id= ?');
$view->bind_param('i', $_GET['id']);
$view->execute();
$view->bind_result($title, $author, $date, $modified, $contents);
$view->fetch();

echo $title . '<br>';
echo  "By: $author <br>";
echo "Posted On: $date <br>";
echo "Last Modified On: $modified <br>";
echo $contents . '<br>';
?>