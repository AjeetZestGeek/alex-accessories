<?php 
include 'layout/header.php';
$tableName = 'blog_post';
$sql = "SELECT $tableName.id as blogId,$tableName.title as blogTitle, blog_categary.title as categoryTitle, content, image, $tableName.created_date as blogCratedDate, username FROM $tableName JOIN blog_categary ON $tableName.category_id = blog_categary.id JOIN users ON $tableName.created_by_id = users.id WHERE $tableName.id = ".$_GET['id'];
$stm = $dbConn->prepare($sql);
$stm->execute();
$data = $stm->fetchAll()[0];
?>
<a href="blogList.php" id="back-btn" class="btn btn-warning">Back</a>
<div class="main">
	<div class="row main-heading">
		<div class="col-lg-6 col-md-6 col-sm-12 container">
			<?php 
			$image = 'uploads/'.explode('_', $data['image'])[1];
			?>
			<img class="blog-image" src="<?=$image?>">
			<button class="btn btn-danger main-heading" id="alex-image-delete" value="<?=$data['image'];?>" onclick="confirm('Are you sure to delete?')">Delete</button>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<div class="right-item">
				<p><strong>Created At : </strong><?=$data['blogCratedDate'];?></p>
				<p><strong>Created By : </strong><?=$data['username'];?></p>
			</div>
		</div>
	</div>
	<hr>
	<div class="row main-content">
		<div class="title">
			<p><strong>Title : </strong><?=$data['blogTitle'];?></p>
		</div>
		<div class="content">
			<p><strong>Content : </strong><?=$data['content'];?></p>
		</div>
	</div>
</div>

<?php 
include 'layout/footer.php';
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#alex-image-delete').click(function(){
 			var thumb = '<?=$data['image'];?>';
	   		var image = '<?=$image;?>';
	   		$.post("ajax/remove_image.php",
		    {
		        'thumb':thumb,
		        'image':image
		    },function(data,status){
		        if(status='success'){
		            console.log('Image Removed');
		            window.location.href = "blogView.php?id="+"<?=$_GET['id']?>"+"&title="+"<?=$_GET['title']?>";
		        }
		    });
 		});
	});
</script>