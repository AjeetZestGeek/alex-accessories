<?php
require_once("signupConfig.php");
$data = new signupConfig();
$id=$_GET['id'];
$data->setId($id);
    if(isset($_POST['edit'])){
  $data -> setusername($_POST['username']);
  $data-> setemailaddress($_POST['emailaddress']);
  $data-> setphonenumber($_POST['phonenumber']);
  $data->  setrole($_POST['role']);
  $data-> setpassword($_POST['password']);
  $data-> update();
  echo"<script>alert('data updated successfully');document.location='allData.php'</script>";
}
$record = $data->fetchone()
;
$val=$record[0];
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Form</title>
</head>
<body>
<form action="" method="post" style="border:1px solid #ccc">
  <div class="container"  style="float:left;
    width:90%;">
    <h1>Update Form</h1>
    <button  type="button" style="width: 10%;border-radius: 5px;" class="gobackbtn" href="allData.php">Go Back</button>
        <hr>
    <label for="username">User name</label>
    <input type="text" name="username" placeholder="Your name" value="<?php echo $val['username'];?>">

    <label for="emailaddress">Email</label>
    <input type="email" name="emailaddress" placeholder="Your email" value="<?php echo $val['emailaddress'];?>">

    <label for="phonenumber">Phone number</label>
    <input type="number" name="phonenumber" placeholder="Your phonenumber" value="<?php echo $val['phonenumber'];?>">

    <label for="role"> User Role</label>
    <input type="text" name="role" placeholder="Your role" value="<?php echo $val['role'];?>">

    <div class="clearfix">
      <button type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button>&nbsp;
      <button type="submit" name="edit" style="width: 10%;border-radius: 5px;" value="update" class="updatebtn">Update</button>
    </div>
  </div>
</form>
</body>
</html>