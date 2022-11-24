<?php
include 'layout/header.php';
$usernameMsg = '';
$emailaddressMsg = '';
$phoneMsg = '';
$roleMsg = '';
$allDone = true;
if(isset($_GET['id'])){
  $id=$_GET['id'];
  $stm = $dbConn->prepare("SELECT * FROM users where id=?");
  $stm->execute([$id]);
  $val = $stm->fetchAll()[0];
  if(isset($_POST['edit'])){
    $username = $_POST['username'];
    if($username == ''){
      $usernameMsg = "User name cannot be blank";
      $allDone = false;
    }
    $emailaddress = $_POST['emailaddress'];
    if($emailaddress == ''){
      $emailaddressMsg = "Email cannot be blank";
      $allDone = false;
    }
    $phonenumber = $_POST['phonenumber'];
    if($phonenumber == ''){
      $phoneMsg = "Phone number cannot be blank";
      $allDone = false;
    }
    $role = $_POST['role'];
    if($role == ''){
      $roleMsg = "Phone number cannot be blank";
      $allDone = false;
    }
    if($allDone){
      $stm = $dbConn->prepare("UPDATE users SET username=?,emailaddress=?,phonenumber=?,role=? WHERE id=?");
      $stm->execute([$username,$emailaddress,$phonenumber,$role,$id]);
      echo"<script>document.location='allData.php'</script>";
    }
  }
}
?>
<form class="update-form" action="" method="post">
  <div class="container"  style="width:90%;">
    <h1>Update Form</h1>
    <hr>
    <label for="username">User name</label>
    <input class="form-control" type="text" name="username" placeholder="Your name" value="<?php echo $val['username'];?>">
    <span class="error-msg"><?=$usernameMsg;?></span><br>

    <label for="emailaddress">Email</label>
    <input class="form-control" type="email" name="emailaddress" placeholder="Your email" value="<?php echo $val['emailaddress'];?>">
    <span class="error-msg"><?=$emailaddressMsg;?></span><br>

    <label for="phonenumber">Phone number</label>
    <input class="form-control" type="text" name="phonenumber" maxlength="15" placeholder="Your phonenumber" value="<?php echo $val['phonenumber'];?>">
    <span class="error-msg"><?=$phoneMsg;?></span><br>

    <label for="role"> User Role</label>
    <input class="form-control" type="text" name="role" placeholder="Your role" value="<?php echo $val['role'];?>">
    <span class="error-msg"><?=$roleMsg;?></span><br>

    <div class="clearfix">
      <a href="allData.php"><button class="btn btn-warning" type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button></a>&nbsp;
      <button class="btn btn-success" type="submit" name="edit" style="width: 10%;border-radius: 5px;" value="update" class="updatebtn">Update</button>
    </div>
  </div>
</form>
<?php 
include 'layout/footer.php';
?>