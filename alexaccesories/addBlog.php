<?php
include 'layout/header.php';
$tableName = 'blog_post';
$titleMsg = '';
$categoryIdMsg = '';
$contentMsg = '';
$allDone = true;
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $stm = $dbConn->prepare("SELECT * FROM $tableName where id=?");
  $stm->execute([$id]);
  $val = $stm->fetchAll()[0];
}
if(isset($_POST['submit'])){
	$category_id = $_POST['category_id'];
	if($category_id == ''){
	  $categoryIdMsg = "Category cannot be blank";
	  $allDone = false;
	}
	$title = $_POST['title'];
	if($title == ''){
	  $titleMsg = "Title cannot be blank";
	  $allDone = false;
	}
	$content = $_POST['content'];
	if($content == ''){
	  $contentMsg = "Content cannot be blank";
	  $allDone = false;
	}
	$image = $_POST['image'];
	// if($image == ''){
	//   $imageMsg = "Image name cannot be blank";
	//   $allDone = false;
	// }
	if($allDone){
		if($_POST['submit']=='save'){
			$stm = $dbConn->prepare("INSERT INTO $tableName (category_id,title,image,content,created_date,created_by_id,status)VALUES(?,?,?,?,?,?,?)");
			$stm->execute([$category_id,$title,$image,$content,date('Y-m-d h:t:s'),$userId,1]);
			echo"<script>alert('Data updated successfully');document.location='blogList.php'</script>";
		}
		if($_POST['submit']=='update'){
		  $stm = $dbConn->prepare("UPDATE $tableName SET category_id = ?, title = ?,image = ?, content = ?, updated_date = ? WHERE id=?");
		  $stm->execute([$category_id,$title,$image,$content,date('Y-m-d h:t:s'),$id]);
		  echo"<script>alert('Data updated successfully');document.location='blogList.php'</script>";
		}
	}
}
?>
<form class="update-form" action="" method="post">
  <div class="container"  style="width:90%;">
    <h1><?=isset($val['title'])?'Update':'Add';?> Category</h1>
    <hr>
    <label for="title">Title</label>
    <select class="form-select" name="category_id">
    	<?php 
    	$stm = $dbConn->prepare("SELECT * FROM blog_categary");
		  $stm->execute([$id]);
		  $values = $stm->fetchAll();
		  foreach($values as $value){
		  ?>
    	<option <?=isset($val['category_id'])&&$val['category_id']==$value['id']?'selected':'';?> value="<?=$value['id'];?>"><?=$value['title'];?></option>
    <?php } ?>
    </select>
    <span class="error-msg"><?=$categoryIdMsg;?></span><br>

    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" placeholder="Enter blog category" value="<?=isset($val['title'])?$val['title']:'';?>">
    <span class="error-msg"><?=$titleMsg;?></span><br>

    <label for="image">Image</label>
    <input class="form-control" type="file" name="image" placeholder="Enter blog category" value="<?=isset($val['image'])?$val['image']:'';?>" accept="image/*">
    <!-- <span class="error-msg"></?=$titleMsg;?></span> -->
    <br>

    <label for="content">Content</label>
    <textarea class="form-control" name="content"><?=isset($val['content'])?$val['content']:'';?></textarea>
    <span class="error-msg"><?=$contentMsg;?></span><br>

    <div class="clearfix">
      <a href="blogCategoryList.php"><button class="btn btn-danger" type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button></a>&nbsp;
      <button class="btn btn-<?=isset($val['title'])?'warning':'success';?>" type="submit" name="submit" style="width: 10%;border-radius: 5px;" value="<?=isset($val['title'])?'update':'save';?>"><?=isset($val['title'])?'Update':'Save';?></button>
    </div>
  </div>
</form>
<?php 
include 'layout/footer.php';
?>