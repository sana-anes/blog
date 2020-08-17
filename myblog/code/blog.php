<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Blog</title>
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


    <!-- header
    ================================================== -->
    <header class="s-header header">

        <div class="header__logo">
            <a class="logo" href="index.html">
            <img src="images/blog.svg" alt="Homepage">

            </a>
        </div> 
         
        <nav class="header__nav-wrap">

            <h2 class="header__nav-heading h6">Navigate to</h2>

            <ul class="header__nav">
                <li><a href="index.html" title="">Home</a></li>
                <li class="has-children">
                    <a href="#0" title="">Categories</a>
                    <ul class="sub-menu">
                        <li><a href="category.html">Lifestyle</a></li>
                        <li><a href="category.html">Health</a></li>
                        <li><a href="category.html">Family</a></li>
                        <li><a href="category.html">Management</a></li>
                        <li><a href="category.html">Travel</a></li>
                        <li><a href="category.html">Work</a></li>
                    </ul>
                </li>
                <li class="has-children">
                    <a href="#0" title="">Blog</a>
                    <ul class="sub-menu">
                        <li><a href="single-video.html">Video Post</a></li>
                        <li><a href="single-audio.html">Audio Post</a></li>
                        <li><a href="single-standard.html">Standard Post</a></li>
                    </ul>
                </li>
                <li><a href="style-guide.html" title="">Styles</a></li>
                <li><a href="page-about.html" title="">About</a></li>
                <li class="current"><a href="page-contact.html" title="">Contact</a></li>
                 <a href="signin.php" class="btn btn-info bt" role="button"  style="margin-left:  20px;">Sign in</a>
                <a href="signup.php" class="btn btn-info bt " role="button" >Sign up</a>
     
            </ul> <!-- end header__nav -->
               
           
                
     
             


        </nav> <!-- end header__nav-wrap -->

    </header> <!-- s-header -->


    <section class="s-content s-content--top-padding">

        <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <h1 class="display-1 display-1--with-line-sep">Welcome </h1>
                
            </div>
        </div>
        
        <div class="row entries-wrap add-top-padding wide">
            <div class="entries">
                <?php 
                        $con=connect();
                    $req = $con->query("SELECT * FROM posts ORDER BY datetime desc");
                     while($DataRows = $req->fetch()){
                      $Id = $DataRows["post_id"];
                      $DateTime = $DataRows["datetime"];
                      $Title = $DataRows["title"];
                      $Category = $DataRows["category"];
                      $Image = $DataRows["image"];
                      $Author=$DataRows["author"];

                      ?>

                
                <article class="col-block">
                    
                    <div class="item-entry" data-aos="zoom-in">
                        <div class="item-entry__thumb">
                            <a href="single_post.php?id=<?php echo $Id; ?>" class="item-entry__thumb-link">
                                <img src="Upload/<?php echo $Image ?>" 
                                         alt="">
                            </a>
                        </div>
        
                        <div class="item-entry__text">
                            <div class="item-entry__cat">
                                <a href="category.html"><?php echo $Category; ?></a> 
                            </div>
    
                            <h1 class="item-entry__title"><a href="single_post.php?id=<?php echo $Id; ?>"> <?php echo $Title; ?>.</a></h1>
                                
                            <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="#0">
                                <?php echo $Author ; ?>
                            </a></span>
                            <span class="popular__date"><span>on</span> <time datetime="2018-06-14"></time><?php echo $DateTime ;?></span>
                        </section>
                        </div>
                    </div> <!-- item-entry -->

                </article> <!-- end article -->

             <?php } ?>

</div> <!-- end entries -->
        </div> <!-- end entries-wrap -->
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