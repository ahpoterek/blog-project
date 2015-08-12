<?php 

$db= new mysqli("localhost", "root", "root", "blog");


if ($db->connect_errno){
	echo "Failed to connect to MySQL" . "<br>";
	echo $db->connect_error;
	exit();
}

//CREATE POST
?>
<center><h2><font face= "georgia" >MY BLOG</face></h2></center>
<center><a href= "create_post.php">Create Post</a></center><br>


<?php


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
	print '<tr>';
	print '<td><b><center>'. "ID" .'</center></b></td>';
    print '<td><b><center>'. "TITLE".'</center></b></td>';
    print '<td><b><center>'. "AUTHOR".'</center></b></td>';
    print '<td><b><center>'. "DATE CREATED".'</center></b></td>';
    print '<td><b><center>'."DATE MODIFIED".'</center></b></td>';
    print '<td><b><center>'. "POST".'</center></b></td>';
    print "</tr>";
while($row = $result->fetch_assoc()) {
	
    print '<tr>';
    print '<td><i>'.$row["id"].'</i></td>';
    print '<td><i>'.$row["title"].'</i></td>';
    print '<td><i>'.$row["author"].'</i></td>';
    print '<td><i>'.$row["date"].'</i></td>';
    print '<td><i>'.$row["modified"].'</i></td>';
    print '<td><i>'.$row["contents"].'</i></td>';
    ?>
     <td> <a href = "db_info.php?action=delete&id=<?php print $row['id']; ?>">Delete</a></td>
     <td><a href= "view_posts.php?id=<?php print $row['id'];?>">View</a></td>
     <td><a href= "edit_post.php?id=<?php print $row['id'];?>">Edit</a></td>
    <?php
    print '</tr>';

}  
print '</table>';


//EDIT POST
//if (isset($_GET['Edit'])){
//	$sql= "SELECT id, title, author, contents, date FROM posts WHERE contents";
//}

//DELETE POST


 //CREATE TABLE within database:
//create table posts( id INT NOT NULL AUTO_INCREMENT, title TEXT, author TEXT, date TEXT, modified TEXT, contents TEXT, PRIMARY KEY(id));


?>