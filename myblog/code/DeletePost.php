<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_GET['Delete'])){

$postid=$_GET['Delete'];
  
        $connection=connect();
  $sql="DELETE FROM comments WHERE post_id = '$postid'";
  $query="DELETE FROM posts WHERE post_id = '$postid'";
   $connection->exec($sql);
      $connection->exec($query);
        $_SESSION["SuccessMessage"] = "Post Deleted Successfully.";
        Redirect_to("dash.php");
      

  }
?>


