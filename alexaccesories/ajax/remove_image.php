<?php 
if(isset($_POST['thumb'])&&isset($_POST['image'])){
	unlink($_POST['thumb']);
	unlink($_POST['image']);
}
?>