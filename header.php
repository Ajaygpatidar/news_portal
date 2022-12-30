<?php
 include 'db_cannect.php';
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BizNews - Free News Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <!-- live chat api -->
    <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/61b8d726c82c976b71c16a9d/1fmt0gt0p';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
<!--End of Tawk.to Script-->

    <!-- Favicon -->
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61b7fff6a86a8c0019c7cb48&product=inline-share-buttons" async="async"></script>
</head>

<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v12.0" nonce="Q7fMfn0O"></script>
    <!-- Topbar Start -->
    <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center bg-dark px-lg-5">
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-n2">
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#"><?php echo date("d/M/Y"). date (', l') ;?></a>
                        </li>
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#">Advertise</a>
                        </li>
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="#">Contact</a>
                        </li>
                        <?php
                        if(isset($_SESSION['uid']))
                        {?>
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="config.php?profile">profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body small" href="config.php?logout">Logout</a>
                        </li>
                        <?php }
                        else
                        {?>
                            <li class="nav-item border-right border-secondary">
                                <a class="nav-link text-body small" href="signup.php">Sign-up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-body small" href="login.php">Login</a>
                            </li> 
                       <?php } ?>
                    </ul>
                </nav>
            </div>
           
            <div class="col-lg-3 text-right d-none d-md-block">
                <nav class="navbar navbar-expand-sm bg-dark p-0">
                    <ul class="navbar-nav ml-auto mr-n2">
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-twitter"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-facebook-f"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-linkedin-in"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-instagram"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-google-plus-g"></small></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-body" href="#"><small class="fab fa-youtube"></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="row align-items-center bg-white py-3 px-lg-5">
            <div class="col-lg-4">
                <a href="config.php?index" class="navbar-brand p-0 d-none d-lg-block">
                    <h1 class="m-0 display-4 text-uppercase text-primary">AP<span class="text-secondary font-weight-normal">News</span></h1>
                </a>
            </div>
          
        </div>
        
    </div>
    <!-- Topbar End -->
    

     <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
            <a href="index.php" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-4 text-uppercase text-primary">Biz<span class="text-white font-weight-normal">News</span></h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="config.php?index" class="nav-item nav-link active">Home</a>
                    <?php
                        $sql="SELECT * FROM category order by cid limit 1,5";
                        $res=mysqli_query($con,$sql);  
                        foreach($res as $row)
                        { 
                            $cid=$row['cid'];
                            $name=$row['category_name'];
                        ?>
                        <a href="index.php?menu=<?php echo $cid;?>" class="nav-item nav-link"><?php echo $name ?></a>
                    <?php } ?>
                    <a href="signup.php" class="nav-item nav-link d-lg-none">Sign-up</a>
                    <a href="login.php" class="nav-item nav-link d-lg-none">login</a>
                </div>
                <form action="index.php" method="post">
                    <div class="input-group  d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                    
                        <input type="text" class="form-control border-0" name="search" placeholder="Search here">
                        <div class="input-group-append">
                            <button class="input-group-text bg-primary text-right border-0 px-3 " text="submit"  ><i
                                class="fa fa-search" ></i></button>
                        </div>
                    
                    </div>
                </form>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->