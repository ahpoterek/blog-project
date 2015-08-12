
<?php
$db= new mysqli("localhost", "root", "root", "blog");


if ($db-> connect_errno){
	echo "Failed to connect to MySQL" . "<br>";
	echo $db->connect_error;
	exit();
}

$edit= $db->prepare('SELECT title, author, date, modified, contents FROM posts WHERE id= ?');
$edit->bind_param('i', $_GET['id']);
$edit->execute();
$edit->bind_result($title, $author, $date, $modified, $contents);
$edit->fetch();
$edit->close();


?>




<p><h2><font face= 'georgia' > Edit a Post </h3></p>
<form action= "edit_post.php" method= "POST">
<p><b>Title<br>
<input type= "text" name= "title" value= "<?php echo $title?>"><br></b></p>
<p><b>Author<br>
<input type= "text" name= "author" value= "<?php echo $author?>"><br></b></p>
<input type= "hidden" name= "id" value= "<?php echo $_GET['id']; ?>">
<p><b>Post<br>
<textarea name= "contents" rows= "10" cols= "40"><?php echo $contents?></textarea><br></b></p>
<p><input type= "submit" name= "edit" value= "Edit"><br></form></face><br>
<a href= "db_info.php">Home</a>

<?php
if (isset($_POST['edit'])){
	$ed_title= $_POST['title'];
	$ed_author= $_POST['author'];
	$ed_contents= $_POST['contents'];
	$ed_id= $_POST['id'];


//input validation
if ($ed_title== "" || $ed_author== "" || $ed_contents == "" ){
		echo "Please make valid edits";
			
}else{
	$edit= $db->prepare('UPDATE posts SET title= ?, author= ?, modified= ?, contents= ? WHERE id= ?');
	//additional variables

	$ed_modified= date("l.m.d.Y");

	//bind param
	$edit->bind_param('ssssi', $ed_title, $ed_author, $ed_modified, $ed_contents, $ed_id);
	//execute
	//var_dump($edit);
	$edit->execute();
	echo $edit->error;
	header("Location:db_info.php");
	die();

}
}
?>