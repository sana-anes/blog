  
  <?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php
if(isset($_GET["id"])){
  $IdFromURL = $_GET["id"];
  $connection=connect();

  $sql="DELETE FROM users WHERE user_id='$IdFromURL'";
   if($connection->exec($sql)){
  $_SESSION["SuccessMessage"] = "user Deleted Successfully";
  Redirect_to("blog.php");
}else{
  $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
  Redirect_to("blog.php");
}
}
 ?>