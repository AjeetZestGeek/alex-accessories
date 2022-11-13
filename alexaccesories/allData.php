<?php
include 'layout/header.php';
require_once("signupConfig.php");
$data = new signupConfig();
$all = $data->fetchAll();
?>

    <div class="container">
    	<table class="table table-striped">
            <div class="container">
    		<thead>
        		<tr>
        			<th> <mark>id</mark></th>
        			<th> <mark>Username </mark></th>
        			<th><mark>Email Address</mark></th>
        			<th><mark>Phone Number</mark></th>
        			<th><mark>Role</mark></th>
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
                        <a class="btn btn-info" href="update.php?id=<?=$val['id']; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="delete.php?id=<?=$val['id']; ?>&req=delete" onclick='return checkdelete()'>Delete</a>
                    </td>
           	   <?php
                }
                ?>
                </tr>
                <a  class="btn btn-info" href="signup.php">Add New</a>
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