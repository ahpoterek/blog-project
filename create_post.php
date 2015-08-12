


<h2><font face= "georgia"> Create a Post</face></h2>


<?php
$db= new mysqli("localhost", "root", "root", "blog");


if ($db->connect_errno){
	echo "Failed to connect to MySQL" . "<br>";
	echo $db->connect_error;
	exit();
}

?>

<form action= "create_post.php" method= "POST">
<p><b>Title<br>
<input type= "text" name= "title" value= "Title your post"><br></b></p>
<p><b>Author<br>
<input type= "text" name= "author" value= "Who are you?"><br></b></p>
<p><b>Post<br>
<textarea name= "content" rows= "10" cols= "40">Write something!</textarea><br></b></p>
<input type= "submit" name= "create" value= "Create"><br></form></face><br>
<a href= "db_info.php">Home</a><br>




<?php
if (isset($_POST["create"])){
	//create variables
	//print_r($_POST);
	$cr_title = $_POST['title'];
	$cr_author= $_POST['author'];
	$cr_content= $_POST['content'];
	//input validation
	if ($cr_title== "" || $cr_title== "Title your post" || $cr_author== "" || $cr_author == "Who are you?"|| $cr_content == "" || $cr_content == "Write something!"){
		echo "<center>Please enter valid information</center>";
	}else{
		//prepare statement
		$create= $db->prepare("INSERT INTO posts (title, author, date, modified, contents) VALUES (?, ?, ?, ?, ?)");
		echo $db->error;
		//define additional variables
		$cr_date= date("l.m.d.Y");
		$cr_modified= $cr_date;
		//bind parameters
		//var_dump($create); 
		$create->bind_param('sssss', $cr_title, $cr_author, $cr_date, $cr_modified, $cr_content);
		//execute
		$create->execute();
		echo $create->error;
		header("Location:db_info.php");
		die();
	}	
}

?>