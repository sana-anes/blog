<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_POST["submit"])){
        $PostId=$_GET['id'];
    $Comment = $_POST["cMessage"];
    $name=$_POST["cName"];
    $email=$_POST["cEmail"];
    date_default_timezone_set("Europe/Paris");
    $DateTime=date('Y-m-d');
        $conn=connect();
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="INSERT INTO comments(datetime,post_id,name,comment,email)
      VALUES('$DateTime', '$PostId','$name', '$Comment','$email')";

  if($conn->exec($sql)){
  $_SESSION["SuccessMessage"] = "Comment Added Successfully.";
        Redirect_to("single_post.php?id=$PostId");}
        else{
            $_SESSION["Message"] = "Something went wrong !.";
        Redirect_to("single_post.php?id=$PostId"); 
        }
}

$conn = null;


?>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Post </title>
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

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<body id="top">

    <!-- preloader
    ================================================== -->
   
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

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--top-padding s-content--narrow">

           <?php 
           $id=$_GET['id'];
                        $con=connect();
                    $req = $con->query("SELECT * FROM posts WHERE post_id='$id' ORDER BY datetime desc");
                     while($DataRows = $req->fetch()){
                      $Id = $DataRows["post_id"];
                      $DateTime = $DataRows["datetime"];
                      $Title = $DataRows["title"];
                      $post=$DataRows["content"];
                      $Category = $DataRows["category"];
                      $Image = $DataRows["image"];
                      $Author=$DataRows["author"];
                      
                      ?>


        <article class="row entry format-standard">

            <div class="entry__media col-full">
                <div class="entry__post-thumb">
                    <img src="Upload/<?php echo $Image ?>"  alt="" >
                </div>
            </div>

            <div class="entry__header col-full">
                <h1 class="entry__header-title display-1">
             <?php echo $Title ?>
                </h1>
                <ul class="entry__header-meta">
                    <li class="date"><?php echo $DateTime ;?></li>
                    <li class="byline">
                        By
                        <a href="#0"><?php echo $Author; ?></a>
                    </li>
                </ul>
            </div>

            <div class="col-full entry__main">

                <p class="lead drop-cap">
                  <?php echo $post; ?>
                .</p>
                
             

                <div class="entry__taxonomies">
                    <div class="entry__cat">
                        <h5>Posted In: </h5>
                        <span class="entry__tax-list">
                            <a href="#0"><?php echo $Category; ?></a>
                            
                        </span>
                    </div> <!-- end entry__cat -->

                    
                </div> <!-- end s-content__taxonomies -->

                

            </div> <!-- s-entry__main -->

        </article> <!-- end entry/article -->
<?php }
//$con = null;   ?>

        <div class="comments-wrap">
               <?php

                           $connect=connect();
                           $rep = $connect->query("SELECT COUNT(*) FROM comments WHERE post_id='$Id' ");
                          $Rows =$rep->fetch();
                          $Total = array_shift($Rows);
                          if($Total > 0){
                            ?>
                           

            <div id="comments" class="row">
                <div class="col-full">

                    <h3 class="h2"> <?php echo $Total ;?> Comments</h3>
                       
                    <!-- START commentlist -->
                    <ol class="commentlist">
                         <?php
                           $con=connect();
                           $sql = $con->query("SELECT * FROM comments WHERE post_id='$Id' ");
                          while($data =$sql->fetch())
                          {
                               $Datetime = $data['datetime'];
                      $Name = $data['name'];
                      $Comment = $data['comment'];
                            ?>
                        <li class="depth-1 comment">

                            <div class="comment__avatar">
                                <img class="avatar" src="images/avatars/user.png" alt="" width="50" height="50">
                            </div>

                            <div class="comment__content">

                                <div class="comment__info">
                                    <div class="comment__author"><?php echo $Name?></div>

                                    <div class="comment__meta">
                                        <div class="comment__time"><?php echo $Datetime?></div>
                                        <div class="comment__reply">
                                            <a class="comment-reply-link" href="#0">Reply</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment__text">
                              <?php echo $Comment ;?>
                                </div>

                            </div>

                        </li> <!-- end comment level 1 -->
                    <?php } ?>
                    </ol>
                    <!-- END commentlist -->           

                </div> <!-- end col-full -->
            </div> <!-- end comments -->   
        <?php } ?>



            <div class="row comment-respond">

                <!-- START respond -->
                <div id="respond" class="col-full">

                    <h3 class="h2">Add Comment <span>Your email address will not be published</span></h3>

                    <form name="contactForm" id="contactForm" method="post" action="single_post.php?id=<?php echo $Id; ?>" autocomplete="off">
                        <fieldset>

                            <div class="form-field">
                                <input name="cName" id="cName" class="full-width" placeholder="Your Name*" value="" type="text" required>
                            </div>

                            <div class="form-field">
                                <input name="cEmail" id="cEmail" class="full-width" placeholder="Your Email*" value="" type="email" required>
                            </div>

                            <div class="message form-field">
                                <textarea name="cMessage" id="cMessage" class="full-width" placeholder="Your Message*" required></textarea>
                            </div>

                            <input name="submit" id="submit" class="btn btn--primary btn-wide btn--large full-width" value="Add Comment" type="submit">

                        </fieldset>
                    </form> <!-- end form -->

                </div>
                <!-- END respond-->

            </div> <!-- end comment-respond -->

        </div> <!-- end comments-wrap -->

    </section> <!-- end s-content -->


    
    <!-- s-footer
    ================================================== -->
       <footer  >

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


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>

</html>