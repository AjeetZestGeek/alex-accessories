<?php
include 'layout/header.php';
$tableName = 'blog_post';
if(isset($_GET['id'] )&& isset($_GET['req'])){
    if($_GET['req']=="delete"){
        $id = $_GET['id'];
        $stm = $dbConn->prepare("DELETE FROM $tableName WHERE id=?");
        $stm->execute([$id]);
    }
}
$stm = $dbConn->prepare("SELECT $tableName.id as blogId,$tableName.title as blogTitle, blog_categary.title as categoryTitle, content, image, $tableName.created_date as blogCratedDate FROM $tableName JOIN blog_categary ON $tableName.category_id = blog_categary.id");
$stm->execute();
$all = $stm->fetchAll();
?>

    <div class="container">
    	<table class="table table-striped">
            <div class="container">
    		<thead>
        		<tr>
        			<th><mark>Id</mark></th>
                    <th><mark>Category</mark></th>
        			<th><mark>Title</mark></th>
        			<th><mark>Image</mark></th>
                    <th><mark>Content</mark></th>
                    <th><mark>Created At</mark></th>
                    <th><mark>Action</mark></th>
        		</tr>
    	   </thead>
    		<tbody>
    			 <?php
                foreach($all as $key => $val){
                	?>
                <tr>
                   	<th><?=$val['blogId']?></th>
                    <th><?=$val['categoryTitle']?></th>
                   	<th><?=$val['blogTitle']?></th>
                    <th><img src="<?=$val['image']?>" height='100' width = '150'></th>
                    <th><?=$val['content']?></th>
                   	<th><?=$val['blogCratedDate']?></th>
           		    <td>
                        <a class="btn btn-info" href="addBlog.php?id=<?=$val['blogId'].'&title='.$final = preg_replace('#[ -]+#', '-', $val['blogTitle']); ?>">Edit</a>&nbsp
                        <a class="btn btn-danger" href="?id=<?=$val['blogId']; ?>&req=delete" onclick='return checkdelete()'>Delete</a>
                    </td>
           	   <?php
                }
                ?>
                </tr>
                <a  class="btn btn-info" href="addBlog.php">Add New</a>
            </tbody>
        </div>
    </table>
    <script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this blog');
    }
 </script>
</div>
<?php 
include 'layout/footer.php';
?>