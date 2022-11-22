
<?php
session_start();
?>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

echo"<script>document.location='../index.php';</script>";
?>
