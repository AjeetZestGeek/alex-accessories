<?php
include 'layout/header.php';
if(isset($_GET['id'] )&& isset($_GET['req'])){
    if($_GET['req']=="delete"){
        $id = $_GET['id'];
        $stm = $dbConn->prepare("DELETE  FROM blog_categary WHERE id=?");
        $stm->execute([$id]);
    }
}
$stm = $dbConn->prepare("SELECT * FROM blog_categary");
$stm->execute();
$all = $stm->fetchAll();
?>

    <div class="container">
    	<table class="table table-striped">
            <div class="container">
    		<thead>
        		<tr>
        			<th><mark>Id</mark></th>
        			<th><mark>Category </mark></th>
        			<th><mark>Created At</mark></th>
                    <th><mark>Action</mark></th>
        		</tr>
    	   </thead>
    		<tbody>
    			 <?php
                foreach($all as $key => $val){
                	?>
                <tr>
                   	<th><?=$val['id']?></th>
                   	<th><?=$val['title']?></th>
                   	<th><?=$val['created_date']?></th>
           		    <td>
                        <a class="btn btn-info" href="addBlogCategory.php?id=<?=$val['id']; ?>">Edit</a>&nbsp
                        <a class="btn btn-danger" href="?id=<?=$val['id']; ?>&req=delete" onclick='return checkdelete()'>Delete</a>
                    </td>
           	   <?php
                }
                ?>
                </tr>
                <a  class="btn btn-info" href="addBlogCategory.php">Add New</a>
            </tbody>
        </div>
    </table>
    <script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this category');
    }
 </script>
</div>
<?php 
include 'layout/footer.php';
?>