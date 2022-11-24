<?php
include 'layout/header.php';
$usernameMsg = '';
$emailMsg = '';
$phoneMsg = '';
$passwordMsg = '';
$conPassMasg = '';
$allDone = true;
if (isset($_POST['save'])) {
  $username = $_POST['username'];
  if($username==''){
    $usernameMsg = 'Please fill User Name!!!';
    $allDone = false;
  }
  $emailaddress = $_POST['emailaddress'];
  if($emailaddress==''){
    $emailMsg = 'Please fill Email!!!';
    $allDone = false;
  }else if (filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL) === FALSE){
    $emailMsg = 'Please fill valid Email!!!';
    $allDone = false;
  }
  $phonenumber = $_POST['phonenumber'];
  if($phonenumber==''){
    $phoneMsg = 'Please fill phone number!!!';
    $allDone = false;
  }
  $role = $_POST['role'];
  $password = $_POST['password'];
  if($password==''){
    $passwordMsg = 'Please fill password!!!';
    $allDone = false;
  }
  $con_password = $_POST['con_password'];
  if($password!=$con_password){
    $conPassMasg = 'Password and confirm password do not matched!!!';
    $allDone = false;
  }
  if($allDone){
    $password = md5($password);
    $stm = $dbConn->prepare("SELECT * FROM users where username=? OR emailaddress=? OR phonenumber=?");
    $stm->execute([$username,$emailaddress,$phonenumber]);
    if($stm->rowCount()>0){
      echo"<script>alert('User Name/Email/Phone are already exits');</script>";
    }else{
      $sql = $dbConn->prepare("INSERT INTO users(username,emailaddress,phonenumber,role,password)values(?,?,?,?,?)");
      $sql->execute([$username,$emailaddress,$phonenumber,$role,$password]);
      echo"<script>document.location='index.php'</script>";
      $_SESSION['userData'] = $sql;
    }
  }
}
?>
<form class="signup-form" action="" method="post" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
        <hr>
    <label for="username">User name</label>
    <input class="form-control" type="text" name="username" value="<?=isset($username)?$username:'';?>" placeholder="abc123">
    <span class='error-msg'><?=$usernameMsg;?></span><br>

    <label for="emailaddress">Email</label>
    <input class="form-control" type="email" name="emailaddress" value="<?=isset($emailaddress)?$emailaddress:'';?>" placeholder="abc@xyz.com">
    <span class='error-msg'><?=$emailMsg;?></span><br>

    <label for="phonenumber">Phone number</label>
    <input class="form-control" type="text" name="phonenumber" maxlength="15" value="<?=isset($phonenumber)?$phonenumber:'';?>" placeholder="Phone Number">
    <span class='error-msg'><?=$phoneMsg;?></span><br>

    <input class="form-control" type="hidden" name="role" value="User" placeholder="Your role">

    <label for="password"> Password</label>
    <input class="form-control" type="password" name="password" placeholder="Password">
    <span class='error-msg'><?=$passwordMsg;?></span><br>

    <label for="password"> Confirm Password</label>
    <input class="form-control" type="password" name="con_password" placeholder="Confirm Password">
    <span class='error-msg'><?=$conPassMasg;?></span><br>
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button class="btn btn-warning" type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button> &nbsp;
      <button class="btn btn-success" type="submit" style="width: 10%;border-radius: 5px;" name="save"  value="save" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<?php
include 'layout/footer.php';
?>