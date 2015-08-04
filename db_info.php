<?php 

$db= new mysqli("localhost", "root", "root", "blog");


if ($db-> connect_errno){
	echo "Failed to connect to MySQL" . "<br>";
	echo $db->connect_error;
	exit();
}

//CREATE POST
?>
<head><title>Edit Post</title></head>

<form action= "edit_post.php" method= "POST">
<input type= "text" name= "title" value= "Title your post"><br>
<input type= "text" name= "author" value= "Who are you?"><br>
<textarea name= "post" rows= "10" cols= "40">Write something!</textarea><br>
<input type= "submit" name= "create" value= "Create"><br></form>

<?php
if (isset($_POST["create"])){
	//create variables
	$cr_title = $_POST['title'];
	$cr_author= $_POST['author'];
	$cr_content= $_POST['post'];
	//input validation
	if ($cr_title== "" || $cr_title== "Title your post" || $cr_author== "" || $cr_author == "Who are you?"|| $cr_content == "" || $cr_content == "Write something!"){
		return "Please enter valid information";
	}else{
		//prepare statement
		$create= $db->prepare('INSERT INTO posts(title, author, date, modified, contents) VALUES (?,?,?,?)');
		//define additional variables
		$cr_date= date("l.m.d.Y");
		$cr_modified= $date;
		//bind parameters 
		$create->bind_param('sssss', $cr_title, $cr_author, $cr_date, $cr_modified, $cr_content);
		//execute
		$create->execute();
	}	
}

//DELETE POST
if (isset($_POST["delete"])){
	//prepare
	$delete= $db->prepare('DELETE FROM posts WHERE id=?');
	//create variables
	$d_id= $_POST['id'];
	//bind param
	$delete->bind_param('i', $d_id);
	//execute
	$delete->execute();

}


?>