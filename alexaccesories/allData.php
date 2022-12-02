<?php
include 'layout/header.php';
if(isset($_GET['id'] )&& isset($_GET['req'])){
    if($_GET['req']=="delete"){
        $id = $_GET['id'];
        $stm = $dbConn->prepare("DELETE  FROM users WHERE id=?");
        $stm->execute([$id]);
    }
}
$stm = $dbConn->prepare("SELECT * FROM users");
$stm->execute();
$all = $stm->fetchAll();
?>

    <div class="container">
    	<table class="table table-striped">
            <div class="container">
    		<thead>
        		<tr>
        			<th><mark>id</mark></th>
        			<th><mark>Username </mark></th>
        			<th><mark>Email Address</mark></th>
        			<th><mark>Phone Number</mark></th>
        			<th><mark>Role</mark></th>
                    <th><mark>Action</mark></th>
        		</tr>
    	   </thead>
    		<tbody>
    			 <?php
                foreach($all as $key => $val){
                	?>
                <tr>
                   	<th><?=$val['id']?></th>
                   	<th><?=$val['username']?></th>
                   	<th><?=$val['emailaddress']?></th>
                   	<th><?=$val['phonenumber']?></th>
                    <th><?=$val['role']?></th>
           		    <td>
                        <a class="btn btn-info" href="update.php?id=<?=$val['id']; ?>&username=<?=$val['username']?>">Edit</a>&nbsp
                        <a class="btn btn-danger" href="?id=<?=$val['id']; ?>&req=delete" onclick='return checkdelete()'>Delete</a>
                    </td>
           	   <?php
                }
                ?>
                </tr>
            </tbody>
        </div>
    </table>
    <script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this user');
    }
 </script>
</div>
<?php 
include 'layout/footer.php';
?>