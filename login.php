<?php
require_once('layout/header.php');
$usernameMsg = '';
$passwordMsg = '';
$allDone = true;
if(isset($_POST['login'])){
  $username = $_POST['username'];
  if($username==''){
    $usernameMsg = 'Please fill User Name!!!';
    $allDone = false;
  }
  $password = $_POST['password'];
  if($password==''){
    $passwordMsg = 'Please fill password!!!';
    $allDone = false;
  }
  if($allDone){
    $password = saltPassword(sha1($password));
    $stm = $dbConn->prepare("SELECT * FROM users WHERE (username = ? OR emailaddress = ?) AND password = ?");
    $stm->execute([$username,$username,$password]);
    if($stm->rowCount()>0){
      $_SESSION['login_data'] = $stm->fetchAll();
      if($_SESSION['login_data'][0]['role']=='Admin'){
        echo"<script>document.location='alexaccesories/index.php';</script>";
      }else{
        echo"<script>document.location='index.php';</script>";
      }
    }else{
      echo"<script>alert('Username/Email OR Password wrong');document.location='login.php';</script>";
    }
  }
}
?>
<form class="login-form" action="" method="post" style="border:1px solid #ccc">
  <div class="container" style="width:90%;">
    <h1>Login</h1>
    <p>Please type username or password carefully.</p>
        <hr>
    <label for="username">User name</label>
    <input class="form-control" type="text" name="username" placeholder="Your username or email">
    <span class='error-msg'><?=$usernameMsg;?></span><br>

    <label for="password"> Password</label>
    <input class="form-control" type="password" name="password" placeholder="Your password">
    <span class='error-msg'><?=$passwordMsg;?></span><br>
    
    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"><label for="remember"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button class="btn btn-warning" type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button> &nbsp;
      <button class="btn btn-success" type="submit" style="width: 10%;border-radius: 5px;" name="login"  value="save" class="signupbtn">Login</button>
    </div>
  </div>
</form>
<?php
require_once('layout/footer.php');
?>