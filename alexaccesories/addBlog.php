<?php
include 'layout/header.php';
$tableName = 'blog_post';
$titleMsg = '';
$categoryIdMsg = '';
$contentMsg = '';
$imageMsg = '';
$image = '';
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
	$imageProcess = 0;
	 if(is_array($_FILES)&&!empty($_FILES['image']['tmp_name'])) {
	     $fileName = $_FILES['image']['tmp_name'];
	     $sourceProperties = getimagesize($fileName);
	     $resizeFileName = time();
	     $uploadPath = "./uploads/";
	     if(!file_exists($uploadPath)){
	     	mkdir($uploadPath);
	     }
	     $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	     $uploadImageType = $sourceProperties[2];
	     $sourceImageWidth = $sourceProperties[0];
	     $sourceImageHeight = $sourceProperties[1];
	     switch ($uploadImageType) {
	         case IMAGETYPE_JPEG:
	             $resourceType = imagecreatefromjpeg($fileName); 
	             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
	             imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
	             $imageProcess = 1;
	             break;

	         case IMAGETYPE_GIF:
	             $resourceType = imagecreatefromgif($fileName); 
	             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
	             imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
	             $imageProcess = 1;
	             break;

	         case IMAGETYPE_PNG:
	             $resourceType = imagecreatefrompng($fileName); 
	             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
	             imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
	             $imageProcess = 1;
	             break;

	         case IMAGETYPE_JPG:
	             $resourceType = imagecreatefrompng($fileName); 
	             $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
	             imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
	             $imageProcess = 1;
	             break;

	         default:
	             $imageProcess = 0;
	             break;
	     	}
	     	move_uploaded_file($fileName, $path. $resizeFileName. ".". $fileExt);
	      if($imageProcess == 0 && $_POST['submit']=='update'){
				  $image = $val['image'];
				  $imageProcess = 1;
				}else{
					$image = $uploadPath."thump_".$resizeFileName.'.'. $fileExt;
					$imageProcess = 1;
				}
	 }
	
	if($allDone){
		if($_POST['submit']=='save'){
			$stm = $dbConn->prepare("INSERT INTO $tableName (category_id,title,image,content,created_date,created_by_id,status)VALUES(?,?,?,?,?,?,?)");
			$stm->execute([$category_id,$title,$image,$content,date('Y-m-d h:t:s'),$userId,1]);
			echo"<script>document.location='blogList.php'</script>";
		}
		if($_POST['submit']=='update'){
		  $stm = $dbConn->prepare("UPDATE $tableName SET category_id = ?, title = ?,image = ?, content = ?, updated_date = ? WHERE id=?");
		  $stm->execute([$category_id,$title,$image,$content,date('Y-m-d h:t:s'),$id]);
		  echo"<script>document.location='blogList.php'</script>";
		}
	}
}
?>
<form class="update-form" action="" method="post" enctype="multipart/form-data">
  <div class="container"  style="width:90%;">
    <h1><?=isset($val['title'])?'Update':'Add';?> Post</h1>
    <hr>
    <label for="category">Category</label>
    <select class="form-select" name="category_id" id="category">
    	<?php 
    	$stm = $dbConn->prepare("SELECT * FROM blog_categary");
		  $stm->execute();
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
    <input class="form-control" type="file" name="image" placeholder="Enter blog category">
    <span class="error-msg"><?=$imageMsg;?></span>
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