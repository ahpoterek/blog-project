<?php
//DELETE A SELECTED POST

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