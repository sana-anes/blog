<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>dashboard</title>
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
                    <li class="active"><a href="dash.php"><span class="glyphicon glyphicon-th" ></span>&nbsp;My posts</a></li>
                    <li><a href="newPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                    <li><a href="Comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                </ul>
            </div>

<div class="col2">
             
                <h1 style="text-align: center;">Posts list</h1>
                <?php
                echo Message();
                echo SuccessMessage();
               ?>
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <tr>
                      <th>No</th>
                      <th>Post Title</th>
                      <th>Date & Time</th>
                      <th>Category</th>
                      <th>Picure</th>
                      <th>Comments</th>
                      <th>Action</th>
                    </tr>
                    <?php
                    $userid=$_SESSION["User_Id"];
                    $con=connect();
                    $req = $con->query("SELECT * FROM posts WHERE owner_id='$userid' ORDER BY datetime desc");
                  
                    $SrNo = 0;
                    while($DataRows = $req->fetch()){
                      $Id = $DataRows["post_id"];
                      $DateTime = $DataRows["datetime"];
                      $Title = $DataRows["title"];
                      $Category = $DataRows["category"];
                      $Image = $DataRows["image"];
                      $SrNo++;
                      ?>
                      <tr>
                        <td><?php echo $SrNo ?></td>
                        <td style="color: #5e5eff;"><?php
                        if(strlen($Title)>20){$Title = substr($Title, 0, 20)."..";}
                        echo $Title ?>
                      </td>
                        <td><?php
                        if(strlen($DateTime)>11){$DateTime = substr($DateTime, 0, 11)."..";}
                        echo $DateTime ?>
                        </td>
                       
                        <td><?php
                        if(strlen($Category)>7){$Category = substr($Category, 0, 7)."..";}
                        echo $Category ?></td>
                        <td><img src="Upload/<?php echo $Image ?>" width="200";height="40px"></td>
                        <td>
                          <?php
                           $connect=connect();
                           $rep = $connect->query("SELECT COUNT(*) FROM comments WHERE post_id='$Id' ");
                          $RowsApproved =$rep->fetch();
                          $Total = array_shift($RowsApproved);
                          if($Total > 0){
                            ?>
                            <span class="label label-success pull-right">
                            <?php echo $Total; ?>
                            </span>
                          <?php } ?>

                        </td>
                        <td>
                           <a href="editPost.php?Edit=<?php echo $Id; ?>">
                         <span class="glyphicon glyphicon-pencil"></span></a>
                             <a href="DeletePost.php?Delete=<?php echo $Id; ?>">
                                  <span class="glyphicon glyphicon-trash"></span> </a>
                        </td>

                        <td>
                          <a href="single_post.php?id=<?php echo $Id; ?>" target="_blank">
                          <span class="btn btn-primary">Live Preview</span></a></td>
                      </tr>
                    <?php } ?>
                  </table>
                </div>
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