
<?php
    include 'db_cannect.php';
    $sql="SELECT * FROM notification where A_seen='0'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_num_rows($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BizNews - Free News Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

</head>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="css/style1.css">
<script src="js/js1.js"></script>
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!------ Include the above in your HEAD tag ---------->

<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://bryanrojasq.wordpress.com">
                <img src="http://placehold.it/200x50&text=LOGO" alt="LOGO">
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right  top-nav">
            <li><a href="config.php?index"><i class="fa fa-home " aria-hidden="true"> Home  </i> 
            <li><a href="config.php?notification" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Stats"><i class="fa fa-bell"><span class="badge btn-danger "><?php echo $row ?></span></i></a>
            </li>            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>
                    <li><a href="#"><i class="fa fa-fw fa-cog"></i> Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="config.php?logout"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse navbar-left">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="config.php?dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                </li>
                <li>
                    <a href="config.php?index"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                </li>
                <li>
                    <a href="config.php?profile"><i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                </li>
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Manage Reporter <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="config.php?ADDR"><i class="fa fa-angle-double-right"></i> Add  Reporter</a></li>
                        <li><a href="config.php?Vreporter"><i class="fa fa-angle-double-right"></i> View  Reporter</a></li>
                        <li><a href="config.php?Rsuspend"><i class="fa fa-angle-double-right"></i> View Suspended</a></li>
                    </ul>
                </li>
              
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-indent" aria-hidden="true"></i> Manage Editor<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="config.php?ADDE"><i class="fa fa-angle-double-right"></i> Add  Editor</a></li>
                        <li><a href="config.php?Veditor"><i class="fa fa-angle-double-right"></i> View  Editor</a></li>
                        <li><a href="config.php?Esuspend"><i class="fa fa-angle-double-right"></i> View Suspended</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-3"><i class="fa fa-indent" aria-hidden="true"></i> Manage User<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-3" class="collapse">
                        <li><a href="config.php?vu"><i class="fa fa-angle-double-right"></i> Verified User</a></li>
                        <li><a href="config.php?nvu"><i class="fa fa-angle-double-right"></i>Non Verified User</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-4"><i class="fa fa-indent" aria-hidden="true"></i> Manage News<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-4" class="collapse">
                        <li><a href="config.php?Vnews"><i class="fa fa-angle-double-right"></i> Verified News</a></li>
                        <li><a href="config.php?mynews"><i class="fa fa-angle-double-right"></i>Non Verified News</a></li>
                    </ul>
                </li>
               
                <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-5"><i class="fa fa-cc" aria-hidden="true"></i> Utility<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-5" class="collapse">
                        <li><a href="addcategory.php"><i class="fa fa-angle-double-right"></i>  Category</a></li>
                        <li><a href="addlocation.php"><i class="fa fa-angle-double-right"></i>  Location</a></li>
                        <!-- <li><a href="#"><i class="fa fa-angle-double-right"></i> Message</a></li> -->
                    </ul>
                </li>
                <li>
                    <a href="config.php?email" ><i class="fa fa-envelope-o" aria-hidden="true"></i> E-mail</a>
                   
                </li>
                <li>
                    <a href="config.php?notification"><i class="fa fa-indent" aria-hidden="true"></i> Notification</a>
                  
                </li>
                <li>
                    <a href="config.php?logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                </li>
            </ul>
        </div>
        
        <!-- /.navbar-collapse -->
    </nav>
    <div class="col-sm-12 col-md-12 well" id="content">
        <h1>Welcome to Admin!</h1>
    </div>
