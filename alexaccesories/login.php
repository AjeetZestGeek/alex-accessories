<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration Form</title>
</head>
<body>
<form action="signupProcess.php" method="post" style="border:1px solid #ccc">
  <div class="container"style="float:left;
    width:90%;">
    <h1>Login</h1>
    <p>Please type username or password carefully.</p>
        <hr>
    <label for="username">User name</label>
    <input type="text" name="username" placeholder="Your name or email">

    <label for="password"> Password</label>
    <input type="password" name="password" placeholder="Your password">
 <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="button" style="width: 10%;border-radius: 5px;" class="cancelbtn">Cancel</button> &nbsp;
      <button type="submit" style="width: 10%;border-radius: 5px;" name="login"  value="save" class="signupbtn">Login</button>
    </div>
  </div>
</form>
</body>
</html>