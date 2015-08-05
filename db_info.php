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

<form action= "db_info.php" method= "POST">
<input type= "text" name= "title" value= "Title your post"><br>
<input type= "text" name= "author" value= "Who are you?"><br>
<textarea name= "content" rows= "10" cols= "40">Write something!</textarea><br>
<input type= "submit" name= "create" value= "Create"><br></form>

<?php
if (isset($_POST["create"])){
	//create variables
	//print_r($_POST);
	$cr_title = $_POST['title'];
	$cr_author= $_POST['author'];
	$cr_content= $_POST['content'];
	//input validation
	if ($cr_title== "" || $cr_title== "Title your post" || $cr_author== "" || $cr_author == "Who are you?"|| $cr_content == "" || $cr_content == "Write something!"){
		echo "Please enter valid information";
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
		echo "Created!";
	}	
}

if (isset($_GET["action"]) && $_GET['action']=='delete'){
	//prepare
	$delete= $db->prepare('DELETE FROM posts WHERE id=?');
	//create variables
	$d_id= $_GET['id'];
	//bind param
	$delete->bind_param('i', $d_id);
	//execute
	$delete->execute();

}

$result = $db->query("SELECT * FROM posts");
print '<table border="1">';
while($row = $result->fetch_assoc()) {
    print '<tr>';
    print '<td>'.$row["id"].'</td>';
    print '<td>'.$row["title"].'</td>';
    print '<td>'.$row["author"].'</td>';
    print '<td>'.$row["date"].'</td>';
    print '<td>'.$row["modified"].'</td>';
    print '<td>'.$row["contents"].'</td>';
    ?>
     <td> <a href = "db_info.php?action=delete&id=<?php print $row['id']; ?>">Delete</a></td>
     <td><a href= "view_posts.php?id=<?php print $row['id'];?>">View</a></td>
    <?php
    print '</tr>';

}  
print '</table>';


//EDIT POST
if (isset($_GET['Edit'])){
	$sql= "SELECT id, title, author, contents, date FROM posts WHERE contents";
}
?>
<a href 'db_info.php?id='>
Edit
</a>
<?php
//DELETE POST


 //CREATE TABLE within database:
//create table posts( id INT NOT NULL AUTO_INCREMENT, title TEXT, author TEXT, date TEXT, modified TEXT, contents TEXT, PRIMARY KEY(id));


?>