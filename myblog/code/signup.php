
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php
  if(isset($_POST["signup"])){
   
     $Username =  $_POST["name"];
    $Email =  $_POST["email"];
    $Password = $_POST["pass"];
    $Re_password =  $_POST["re_pass"];


   if($Password !== $Re_password){
              $_SESSION["ErrorMessage"] = "password does not match";
      }else {
      $conn=connect();
$sql="INSERT INTO users(username,password,email)
      VALUES('$Username','$Password','$Email')";

      if ($conn->exec($sql)){
        $_SESSION["SuccessMessage"] = "member Added Successfully.";
        Redirect_to("signin.php");
      }else {
        $_SESSION["ErrorMessage"] = "member failed to Add.";
        Redirect_to("signup.php");
      }
    $conn=null;
    }
  }
?>


 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/sign_style.css">
   
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                                  
               <form method="POST" class="form" id="registerform" onsubmit="javascript:return validation (document.formulaire.pass,document.formulaire.re_pass);" >
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Username" required />
                              

                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required  />
                                

                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" required />
                               

                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required />
                               

                            </div>
                            <?php echo Message();echo SuccessMessage();  ?>

                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"  />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>  

    </div>
   
    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>