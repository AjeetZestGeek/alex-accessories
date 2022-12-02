<?php
include 'layout/header.php';
$limit = 5;
$pageNo = 0;
if (isset($_GET['page-no'])) {
    $pageNo = $_GET['page-no']-1;
}
$offset = $limit*$pageNo;
$tableName = 'blog_post';
if(isset($_GET['id'] )&& isset($_GET['req'])){
    if($_GET['req']=="delete"){
        $id = $_GET['id'];
        $stm = $dbConn->prepare("DELETE FROM $tableName WHERE id=?");
        $stm->execute([$id]);
    }
}

$sql = "SELECT $tableName.id as blogId,$tableName.title as blogTitle, blog_categary.title as categoryTitle, content, image, $tableName.created_date as blogCratedDate FROM $tableName JOIN blog_categary ON $tableName.category_id = blog_categary.id";
if(isset($_GET['cat'])&&$_GET['cat']!=''){
    $catId = $_GET['cat'];
    $sql .= " WHERE blog_categary.id = $catId";
}
$sqlPaginated = $sql . " LIMIT $limit OFFSET $offset"; 
$stm = $dbConn->prepare($sqlPaginated);
$stm->execute();
$all = $stm->fetchAll();
$pagi = $dbConn->prepare($sql);
$pagi->execute();
$totalPages = ceil($pagi->rowCount()/$limit);
?>

    <div class="container">
    	<table class="table table-striped">
            <div class="container">
    		<thead>
        		<tr>
        			<th>Id</th>
                    <th>
                        <div class="dropdown">
                          <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <a class="dropdown-item" href="?page-no=<?=isset($_GET['page-no'])?$_GET['page-no']:1?>">All</a>
                            <?php 
                            $sql = $dbConn->prepare("SELECT * FROM blog_categary");
                            $sql->execute();
                            $datas = $sql->fetchAll();
                            foreach($datas as $data){
                            ?>
                            <a class="dropdown-item" href="?page-no=<?=isset($_GET['page-no'])?$_GET['page-no']:1?>&cat=<?=$data['id'];?>&category=<?=$data['title'];?>"><?=$data['title'];?></a>
                            <?php } ?>
                          </ul>
                        </div>
                    </th>
        			<th>Title</th>
        			<th>Image</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>Action</th>
        		</tr>
    	   </thead>
    		<tbody>
    			 <?php
                foreach($all as $key => $val){
                	?>
                <tr>
                   	<th><a href="blogView.php?id=<?=$val['blogId']?>&title=<?=$final = preg_replace('#[ -]+#', '-', $val['blogTitle']); ?>"><?=$val['blogId']?></a></th>
                    <th><?=$val['categoryTitle']?></th>
                   	<th><a href="blogView.php?id=<?=$val['blogId']?>&title=<?=$final = preg_replace('#[ -]+#', '-', $val['blogTitle']); ?>"><?=$val['blogTitle']?></a></th>
                    <th><a href="blogView.php?id=<?=$val['blogId']?>&title=<?=$final = preg_replace('#[ -]+#', '-', $val['blogTitle']); ?>"><img src="<?=$val['image']?>"></a></th>
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
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="?page-no=<?=(isset($_GET['page-no'])&&$_GET['page-no']>1)?$_GET['page-no']-1:1?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>">Previous</a></li>

        <li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==1)?'active':''?>" href="?page-no=1&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>">1</a></li>...

    <?php for ($i=((isset($_GET['page-no'])&&$_GET['page-no']-2>1)?$_GET['page-no']-2:2); $i < $totalPages && $i < (isset($_GET['page-no'])?$_GET['page-no']+3:3); $i++) { ?>

        <li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==$i)?'active':''?>" href="?page-no=<?=$i;?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>"><?=$i;?></a></li>

    <?php } 
    if($totalPages!=1){
    ?>
        ...<li class="page-item"><a class="page-link <?=(isset($_GET['page-no'])&&$_GET['page-no']==$totalPages)?'active':''?>" href="?page-no=<?=$totalPages;?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>"><?=$totalPages;?></a></li>

    <?php } ?>
        <li class="page-item"><a class="page-link" href="?page-no=<?=(isset($_GET['page-no'])&&$_GET['page-no']<$totalPages)?$_GET['page-no']+1:$totalPages?>&cat=<?=isset($_GET['cat'])?$_GET['cat']:''?>">Next</a></li>
      </ul>
    </nav>
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