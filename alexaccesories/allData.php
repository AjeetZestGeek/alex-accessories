<?php
require_once("signupConfig.php");
$data = new signupConfig();
$all = $data->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<title>view page</title>
    </head>
    <body>
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
           		<td><a class="btn btn-info" href="update.php?id=<?=$val['id']; ?>">Edit
           		</a>
                    &nbsp;<a class="btn btn-danger" href="delete.php?id=<?=$val['id']; ?>&req=delete" onclick='return checkdelete()'>Delete</a></td>
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
</body>
</html>