<?php
include 'layout/header.php';
$titleMsg = '';
$allDone = true;
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $stm = $dbConn->prepare("SELECT * FROM blog_categary where id=?");
  $stm->execute([$id]);
  $val = $stm->fetchAll()[0];
}
if(isset($_POST['submit'])){
	$title = $_POST['title'];
	if($title == ''){
	  $titleMsg = "User name cannot be blank";
	  $allDone = false;
	}
	if($allDone){
		if($_POST['submit']=='save'){
			$stm = $dbConn->prepare("INSERT INTO blog_categary (title,created_date,created_by_id,status)VALUES(?,?,?,?)");
			$stm->execute([$title,date('Y-m-d h:t:s'),$userId,1]);
			echo"<script>document.location='blogCategoryList.php'</script>";
		}
		if($_POST['submit']=='update'){
		  $stm = $dbConn->prepare("UPDATE blog_categary SET title=?, updated_date = ? WHERE id=?");
		  $stm->execute([$title,date('Y-m-d h:t:s'),$id]);
		  echo"<script>document.location='blogCategoryList.php'</script>";
		}
	}
}
?>
<form class="update-form" action="" method="post">
  <div class="container"  style="width:90%;">
    <h1><?=isset($val['title'])?'Update':'Add';?> Category</h1>
    <hr>
    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" placeholder="Enter blog category" value="<?=isset($val['title'])?$val['title']:'';?>">
    <span class="error-msg"><?=$titleMsg;?></span><br>

    <div class="clearfix">
      <a href="blogCategoryList.php"><button class="btn btn-danger" type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button></a>&nbsp;
      <button class="btn btn-<?=isset($val['title'])?'warning':'success';?>" type="submit" name="submit" style="width: 10%;border-radius: 5px;" value="<?=isset($val['title'])?'update':'save';?>"><?=isset($val['title'])?'Update':'Save';?></button>
    </div>
  </div>
</form>
<?php 
include 'layout/footer.php';
?>