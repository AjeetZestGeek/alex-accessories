
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

echo"<script>alert('LogedOut successfully');document.location='../index.php';</script>";
?>

</body>
</html>