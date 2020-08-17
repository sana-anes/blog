<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<?php
  if(isset($_POST["Submit"])){
    $Title =  $_POST["Title"];
    $Category =  $_POST["Category"];
    $Post = $_POST["Post"];
    date_default_timezone_set("Europe/Paris");
    $DateTime=date('Y-m-d');
    $Admin = $_SESSION["Username"];
    $OwnerID=$_SESSION["User_Id"];
    $Image = $_FILES["Image"]["name"];
    $Target = "Upload/".basename($_FILES["Image"]["name"]);
   

try {
  $conn = new PDO("mysql:host=localhost;dbname=test", 'root', 'root');
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="INSERT INTO posts(datetime,title,category,author,image,content,owner_id)
      VALUES('$DateTime', '$Title', '$Category', '$Admin', '$Image', '$Post','$OwnerID')";
          move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

  $conn->exec($sql);
  $_SESSION["SuccessMessage"] = "Post Added Successfully.";
        Redirect_to("newPost.php");
} catch(PDOException $e) {
        
die('Erreur : '.$e->getMessage());}

$conn = null;

}
?>



<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>new post</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <style >
        .col2 {
    background-color: #f2f2f2;
  box-shadow: 5px 10px 18px #888888;
    width:80%;
      float: right;
      margin-left:20px;



}
.col1{
  width:20%;
  box-shadow: 5px 10px 18px #888888;
background-color: #2d2d86;



}
.newpost,.updatepost{
  padding-left: 10%;
  padding-right: 10%;
/*border: 1px  solid black ;*/
height: 100%;
}
.table-responsive{
height: 100%;
}



#Side_Menu {  
background-color: #2d2d86;
padding-top:40px; 
}



.container-fluid,.srow
{

height: 100%;
width: 100%;
margin-left: 2%;
  margin-right: 2%;
  display: flex;
  flex-direction: row;
}

#Side_Menu a{
    color: #9fb1c2;
}

#Side_Menu .active a{
    color: white;
    background-color: #7979d2;
    font-weight: bold;
}

#Side_Menu a:hover{
    color: white;
    background-color: #1ab394;
    font-weight: bold;
    display: block;
}
    </style>
</head>

<body id="top">


    <!-- header
    ================================================== -->
    <header class="s-header header">

        <div class="header__logo">
            <a class="logo" href="dash.php">
                <img src="images/blog.svg" alt="Homepage">
           </a>
        </div> 
         
        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Navigate to</h2>

            <ul class="header__nav">
                <li><a href="blog.php" title="">Blog</a></li>
                <li class="has-children">
                    <a href="#0" title="">Categories</a>
                    <ul class="sub-menu">
                      <?php 
                       $conc=connect();
                    $req = $conc->query("SELECT * FROM category  ORDER BY datetime desc");
                  
                    while($Data = $req->fetch()){
                             $cat=$Data['name'];
                      ?>
                        <li><a href="<?php echo $cat ; ?>.php"><?php echo $cat ; ?></a></li>
                      <?php } ?>
                    </ul>
                </li>
                <li><a href="#" title="">About</a></li>
                <li class="current"><a href="#" title="">Contact</a></li>
                
            </ul> <!-- end header__nav -->
               

        </nav> <!-- end header__nav-wrap -->

    </header> <!-- s-header -->

      <!-- s-content -->
    <section class="s-content s-content--top-padding">
                    <div class="container-fluid">
                <div class="srow">
 <div class="col1" >
                <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                         <li ><a href="#"><span class="glyphicon glyphicon-user" ></span>&nbsp;<?php echo $_SESSION['Username']; ?></a></li>
                    <li ><a href="dash.php"><span class="glyphicon glyphicon-th" ></span>&nbsp;My posts</a></li>
                    <li class="active"><a href="newPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                    <li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                    <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                </ul>
            </div>

<div class="col2">

           <h1 style="text-align: center; ">Add New Post</h1>
                <?php
                echo Message();
                echo SuccessMessage();
               ?>
                <div class="newpost">
                  <form action="newPost.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                      <div class="form-group" >
                        <label for="title"><span class="FieldInfo">Title:</span></label>
                        <input class="form-control form-control-sm" type="text" name="Title" id="title" placeholder="Title" required>
                      </div>
                      <div class="form-group">
                        <label for="categoryselect"><span class="FieldInfo">Category:</span></label>
                        <select class="form-control" id="categoryselect" name="Category">
                          <?php
                          $connection=connect();
                           $req = $connection->query("SELECT * FROM category ORDER BY datetime desc");
                          
                          while($DataRows = $req->fetch()){
                            $ID = $DataRows["id"];
                            $CategoryName = $DataRows["name"];

                           ?>
                           <option><?php echo $CategoryName; ?></option>
                         <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                        <input type="File" class="form-control" name="Image" id="imageselect" required>
                      </div>
                      <div class="form-group">
                        <label for="postarea"><span class="FieldInfo">Post:</span></label>
                        <textarea class="form-control" name="Post" id="postarea" required></textarea>
                      </div>
                      <br>
                      <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">
                      <br>
                    </fieldset>   
                    </form>

            </div>
        </div>
        </div>

    </section> <!-- end s-content -->









    <!-- s-footer
    ================================================== -->
    <footer style="background-color: darkgrey;">

        <div class="s-footer__main">
            <div class="row">
                
                <div class="col-six tab-full s-footer__about">
                        
                   <h4>About the blog</h4>

                    <p>a various post category blog with multiple bloogers .</p>


                </div> <!-- end s-footer__about -->

                   <div class="col-six tab-full" style="padding-left: 120px;">
                    <ul class="footer-social">
                        <li>
                            <a href="#0"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div> 

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
                    <div class="s-footer__copyright" style="text-align: center;">
                        <span>
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
</span>
                    </div>
                
        </div> <!-- end s-footer__bottom -->

        

    </footer> <!-- end s-footer -->


   
</body>

</html>