
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
echo "<p><h2><font face= 'georgia' > $title  </h3>";
echo  "<b>By:</b> $author <br>";
echo "<b>Posted On: </b> $date <br>";
echo "<b>Last Modified On:</b> $modified <br>";
echo "<b>Post:</b> $contents . <br></p>";
echo "<a href= 'db_info.php'>Home</a><br>";
?>