<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php
if(isset($_GET["id"])){
  $IdFromURL = $_GET["id"];
  $connection=connect();
  $sql="DELETE FROM comments WHERE comment_id='$IdFromURL'";
   if($connection->exec($sql)){
  $_SESSION["SuccessMessage"] = "Comment Deleted Successfully";
  Redirect_to("Comments.php");
  }else{
  $_SESSION["ErrorMessage"] = "Something Went Wrong. Try Again!";
  Redirect_to("Comments.php");
}

}
 ?>