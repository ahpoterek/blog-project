<form action= "edit_post.php" method= "POST">
<input type= "text" name= "title" value= "Title your post"><br>
<input type= "text" name= "author" value= "Who are you?"><br>
<textarea name= "post" rows= "10" cols= "40">Write something!</textarea><br>

<input type= "submit" name= "submit" value= "Submit"><br>

<?php
if (isset($_POST["submit"])){
	$title = $_POST['title'];
	$author= $_POST['author'];
	$content= $_POST['post'];
}
?>