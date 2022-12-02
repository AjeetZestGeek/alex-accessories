<?php 
include 'layout/header.php';
$tableName = 'blog_post';
$sql = "SELECT $tableName.id as blogId,$tableName.title as blogTitle, blog_categary.title as categoryTitle, content, image, $tableName.created_date as blogCratedDate FROM $tableName JOIN blog_categary ON $tableName.category_id = blog_categary.id WHERE $tableName.id = ".$_GET['id'];
$stm = $dbConn->prepare($sql);
$stm->execute();
$data = $stm->fetchAll()[0];
?>
<div class="col-lg-12">
	<div class="col-lg-12">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<img src="uploads/<?=explode('_', $data['image'])[1]?>">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<p>Created At : </p>
			<p>Created By : </p>
		</div>
	</div>
	<div class="col-lg-12">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<p>Title : </p>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">
			<p>Content : </p>
		</div>
	</div>
</div>

<?php 
include 'layout/footer.php';
?>