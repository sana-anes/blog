<?php require_once("Include/Sessions.php"); ?>

<?php
  function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
  }

  function Login_Attempt($Username, $Password){

$connection=connect();

    $req = $connection->query("SELECT * FROM users WHERE username = '$Username' AND password = '$Password'");
    if($admin = $req->fetch()){

      return $admin;
    }else{
      return null;
    }

  }

  function Login(){
    if(isset($_SESSION["User_Id"])){
      return true;
    }
  }

  function Confirm_Login(){
    if(!Login()){
      $_SESSION["ErrorMessage"] = "Login Required !";
      Redirect_to("Login.php");
    }
  }
  function connect(){
    try
{
  $connection = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'root');
  return $connection;
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

  }

?>
