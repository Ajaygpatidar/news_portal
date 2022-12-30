
<?php
   include 'db_cannect.php';
    session_start();
    // signup page for user Registraction on index.php
    if(isset($_POST['registraction']))
    {   
        $n=$_POST['name'];
        $m=$_POST['mobile'];
        $e=$_POST['email'];
        $p=$_POST['password'];
        $l=$_POST['loc'];
        
        if(!empty($n) && !empty($m) && !empty($e) && !empty($p) && !empty($l))
        {
            $sql= "SELECT * FROM user WHERE email='$e'";
            $res=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($res);
        
            if(!empty($row))
            {
                header("location:http://localhost/news_portal/signup.php?msg= These Email is already exists Try another! ");
            }
            else
            { 
                $sql="INSERT INTO user (name,mobile,email,password,role,c_id,l_id)
                VALUES ('$n','$m','$e','$p','user','1','$l')";
                $res=mysqli_query($con,$sql);
                $lastid=$con->insert_id;
               
                if($res==true)
                {    
                    $sql="SELECT * FROM user where uid='$lastid'";
                    $res=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($res);
                    $n=$row['name'];
                    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,l_id,post_id,role) 
                    VALUES('registered as','One user','$n','self','$l','$lastid','user')";
                    $res=mysqli_query($con,$sql);
                    require 'signup.php';
                }
                
                else
                {
                    echo 'unsuccessfully';
                }
            }
        }
        else
        {
            header("location:http://localhost/news_portal/signup.php?msg= Please fill it First ");
        }
    }
    // login page for user
    if(isset($_POST['login']))
    {
        $e=$_POST['email'];
        $p=$_POST['password'];
        if(!empty($e) && !empty($p))
        {
            $sql= "SELECT * FROM user WHERE email='$e'";
            $res=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($res);
            $em=$row['email'];
            if(!empty($em))
            {
                $sql= "SELECT * FROM user WHERE email='$e' and password='$p'";
                $res=mysqli_query($con,$sql);
                $row=mysqli_fetch_array($res);
                $pm=$row['password'];
                if(!empty($pm))
                {
                    $sql= "SELECT * FROM user WHERE email='$e' and password='$p'";
                    $res=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($res);                   
                    $r=$row['role'];
                    $uid=$row['uid'];
                    $cid=$row['c_id'];
                    $lid=$row['l_id'];
                    $n=$row['name'];
                    $_SESSION['name']=$n;
                    $_SESSION['role']=$r;
                    $_SESSION['uid']=$uid;
                    $_SESSION['c_id']=$cid;
                    $_SESSION['l_id']=$lid;
                    if($res==true)
                    {
                        require 'profile.php';
                    }
                    else
                    {
                        header("location:http://localhost/news_portal/login.php?msg= your Account is not verified by admin ");

                    }
                }
                else
                {
                    header("location:http://localhost/news_portal/login.php?msg= Invalid Password! ");

                }
            }
            else
            {
                header("location:http://localhost/news_portal/login.php?msg= Invalid Email! ");

            }

        }
        else
        {
           
            header("location:http://localhost/news_portal/login.php?msg= These field is mandetory please fill it");

           
        }
    }
    // logout for all user
    elseif(isset($_GET['logout']))
    { 
        session_destroy();
        header("location:http://localhost/news_portal/login.php? You'r  Logout");
    }
    // Profile of all user on profile.php
    elseif(isset($_GET['profile']))
    {
        if(isset($_SESSION['uid']))
        {
            require 'profile.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    // Profile update  of user who will according to session
    elseif(isset($_POST['pupdate']))
    {
        $uid=$_SESSION['uid'];
        $n=$_POST['name'];
        $m=$_POST['mobile'];
        $e=$_POST['email'];
        $a=$_POST['address'];
        $sql="UPDATE user SET name='$n',mobile='$m',email='$e',address='$a' WHERE uid=$uid";
        $res=mysqli_query($con,$sql);
        require 'profile.php';
    }
    // Image update for user
    elseif(isset($_POST['imgupdate']))
    {
        $uid=$_SESSION['uid'];
        $file="img/".basename($_FILES['img']['name']);
        $sql="UPDATE user SET image='$file' WHERE uid='$uid'";
        $res=mysqli_query($con,$sql);
        move_uploaded_file($_FILES['img']['tmp_name'],$file);
        require 'profile.php';
    }
    // Password change for reporter and editor
    elseif(isset($_POST['passwordupdate']))
    {
        $pid=$_SESSION['uid'];
        $oldp=$_POST['opassword'];
        $newp=$_POST['npassword'];
        $cp=$_POST['cpassword'];
        $sql= "SELECT * FROM user WHERE uid='$pid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $p=$row['password'];
        if($p==$oldp)
        {   
            if($newp==$cp)
            {
                $sql="UPDATE user SET password='$cp' WHERE uid=$pid";
                $res=mysqli_query($con,$sql);
                require 'profile.php';
            }
            else
            {
                $msg="Your Password Not matched";
                require 'profile.php';
            }
        }
        else
        {
            $msg="Your Old password is Invalid ";
            require 'profile.php';
        }
    }
    // Add New category ny admin from admin dashboard
   
    elseif(isset($_POST['addcategory']))
    {
        $nuid=$_SESSION['name'];
       
        $uid=$_SESSION['uid'];
        $cat=$_POST['category'];
        $sql="INSERT INTO category (category_name)
        VALUES ('$cat')";
        $res=mysqli_query($con,$sql);
        $lastid = $con->insert_id;
        if($res==true)
        {
           
           
            $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,post_id,role) 
            VALUES('added by','One category','$cat','$nuid','$lastid','$uid','admin')";
            $res=mysqli_query($con,$sql);
            require 'addcategory.php';
        }
        else
        {
            echo 'unsuccessfully';
        }
    }
    // Add New Location by admin on admin dashboard for any reporter and user
    elseif(isset($_POST['addlocation']))
    {    
        $nuid=$_SESSION['name'];
        
        $uid=$_SESSION['uid'];
        $loc=$_POST['location'];
        $sql="INSERT INTO location (location_name)
        VALUES ('$loc')";
        $res=mysqli_query($con,$sql);
        $lastid = $con->insert_id;
        if($res==true)
        {
           
            $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,l_id,post_id,role) 
            VALUES('added by','One location','$loc','$nuid','$lastid','$uid','admin')";
            $res=mysqli_query($con,$sql);
            require 'addlocation.php';
        }
        else
        {
            echo 'unsuccessfully';
        }
    }
    // Category Delete by admin from admin dashboard
    elseif(isset($_GET['cdelete']))
    { 
        $nuid=$_SESSION['name'];
        $cid=$_SESSION['c_id'];
        $lid=$_SESSION['l_id'];
        $uid=$_SESSION['uid'];
        
        $cid=$_GET['cdelete'];
        $sql="DELETE FROM category WHERE cid=$cid";
        $res=mysqli_query($con,$sql);
        require 'addcategory.php';
    }
    // Edit category by admin on admin dashboard
    if(isset($_GET['editcategory']))
    {
        $uid=$_SESSION['uid'];
        $cid=$_GET['editcategory'];
        $c=$_POST['category'];
        $sql="UPDATE category SET category_name='$c' WHERE cid='$cid'";
        $res = mysqli_query($con,$sql);
        require 'addcategory.php';
        
    }
    // location Delete by admin from admin dashboard
    elseif(isset($_GET['ldelete']))
    {   
        $uid=$_SESSION['uid'];
        $lid=$_GET['ldelete'];
        $sql="DELETE FROM location WHERE lid=$lid";
        $res=mysqli_query($con,$sql);
        require 'addlocation.php';
    }
    // Edit Location by admin from admin dashboard
    if(isset($_GET['editlocation']))
    {
      
        if(isset($_SESSION['uid']))
        {
            $lid=$_GET['editlocation'];
            $l=$_POST['location'];
            $sql="UPDATE location SET Location_name='$l' WHERE lid='$lid'";
            $res = mysqli_query($con,$sql);
            require 'addlocation.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
        
    }
    // Add new reporter by admin from admin dashboard
    elseif(isset($_POST['addnewreporter']))
    { 
        $nuid=$_SESSION['name'];
        $uid=$_SESSION['uid'];
        $n=$_POST['name'];
        $m=$_POST['mobile'];
        $e=$_POST['email'];
        $p=$_POST['password'];
        $c=$_POST['category'];
        $l=$_POST['location'];
        $sql="INSERT INTO user(name,mobile,email,password,role,l_id,c_id) 
        VALUES('$n','$m','$e','$p','reporter','$l','$c')";
        $res=mysqli_query($con,$sql);
        $lastid = $con->insert_id;
        $sql="SELECT * FROM user where uid='$lastid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('added by','One Reporter','$n','$nuid','$c','$l','$lastid','$uid','admin')";
        $res=mysqli_query($con,$sql);
        require 'addnewreporter.php';
    }
    // add new reporter by admin from admin dashboard
    elseif(isset($_POST['addneweditor']))
    {
        $nuid=$_SESSION['name'];
        $uid=$_SESSION['uid'];
        $n=$_POST['name'];
        $m=$_POST['mobile'];
        $e=$_POST['email'];
        $p=$_POST['password'];
        $c=$_POST['category'];
        $l=$_POST['location'];
        $sql="INSERT INTO user(name,mobile,email,password,role,l_id,c_id) 
        VALUES('$n','$m','$e','$p','editor','$l','$c')";
        $res=mysqli_query($con,$sql);
        $lastid = $con->insert_id;
        $sql="SELECT * FROM user where uid='$lastid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $na=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('added by','One editor','$na','$nuid','$c','$l','$lastid','$uid','admin')";
        $res=mysqli_query($con,$sql);
        require 'addnewreporter.php';
    }
  
    elseif(isset($_GET['ADDR']))
    {
        if(isset($_SESSION['uid']))
        {
            require 'addnewreporter.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
      
    }
    elseif(isset($_GET['Vreporter']))
    {
        if(isset($_SESSION['uid']))
        {
            require 'viewreporter.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
      
    }
    elseif(isset($_GET['Rsuspend']))
    {
        require 'reportersuspend.php';
    }
   
    elseif(isset($_GET['ADDE']))
    {
        require 'addneweditor.php';
    }
    elseif(isset($_GET['Veditor']))
    {
        
        if(isset($_SESSION['uid']))
        {
            require 'vieweditor.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    elseif(isset($_GET['Esuspend']))
    {
        require 'editorsuspend.php';
    }
    elseif(isset($_GET['vu']))
    {
       
        if(isset($_SESSION['uid']))
        {
            require 'vu.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    elseif(isset($_GET['nvu']))
    {
      
        if(isset($_SESSION['uid']))
        {
            require 'nvu.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    elseif(isset($_GET['vnews']))
    {
        if(isset($_SESSION['uid']))
        {
            require 'verifynews.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    elseif(isset($_GET['nvnews']))
    {
        if(isset($_SESSION['uid']))
        {
            require 'nvnews.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    // reporter edit his profile from reporter dashboard
    if(isset($_GET['Redit']))
    {
        $uid=$_GET['Redit'];
        $n=$_POST['name'];
        $m=$_POST['mobile'];
        $e=$_POST['email'];
        $l=$_POST['loc'];
        $c=$_POST['cat'];
        $sql="UPDATE user SET name='$n',mobile='$m',email='$e',c_id='$c',l_id='$l' WHERE uid='$uid'";
        $res = mysqli_query($con,$sql);
        require 'viewreporter.php';
    }
    // Editor edit his profile from editor dashboard
    if(isset($_GET['Editoredit']))
    {
        $eid=$_GET['Editoredit'];
        
        $n=$_POST['name'];
        $m=$_POST['mobile'];
        $e=$_POST['email'];
        $l=$_POST['loc'];
        $c=$_POST['cat'];
        $sql="UPDATE user SET name='$n',mobile='$m',email='$e',c_id='$c',l_id='$l' WHERE uid='$eid'";
        $res = mysqli_query($con,$sql);
        require 'vieweditor.php';
        
    }
    // reporter delete by admin from admin dashboard
    elseif(isset($_GET['Rdelete']))
    {  
        $uid1=$_SESSION['uid'];
        $nuid=$_SESSION['name'];
        $cid=$_SESSION['c_id'];
        $lid=$_SESSION['l_id'];
        $uid=$_GET['Rdelete'];
        $sql="UPDATE user SET is_delete='1' WHERE uid='$uid'";
        $res=mysqli_query($con,$sql);
      
        $sql="SELECT * FROM user where uid='$uid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('deleted by','One reporter','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
        $res=mysqli_query($con,$sql);
        require 'viewreporter.php';
    }
    // editor delete by admin from admin dashboard
    elseif(isset($_GET['Edelete']))
    {   
        $uid1=$_SESSION['uid'];
        $nuid=$_SESSION['name'];
        $cid=$_SESSION['c_id'];
        $lid=$_SESSION['l_id'];
        $uid=$_GET['Edelete'];
        $sql="UPDATE user SET is_delete='1' WHERE uid='$uid'";
        $res=mysqli_query($con,$sql);
      
        $sql="SELECT * FROM user where uid='$uid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('deleted by','One editor','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
        $res=mysqli_query($con,$sql);
        require 'vieweditor.php';
    }
    // suspend editor bu admin from admin dashboard
    elseif(isset($_GET['ESdelete']))
    {
        $uid1=$_SESSION['uid'];
        $uid=$_GET['ESdelete'];
        $nuid=$_SESSION['name'];
        $cid=$_SESSION['c_id'];
        $lid=$_SESSION['l_id'];
        $sql="UPDATE user SET is_delete='1' WHERE uid='$uid'";
        $res=mysqli_query($con,$sql);
      
        $sql="SELECT * FROM user where uid='$uid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('deleted by','One editor','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
        $res=mysqli_query($con,$sql);
        require 'editorsuspend.php';
    }
    // editor suspend by admin from admin dashboard
    elseif(isset($_GET['Editorsuspend']))
    {
        
        if(isset($_SESSION['uid']))
        {
            $uid1=$_SESSION['uid'];
            $nuid=$_SESSION['name'];
            $cid=$_SESSION['c_id'];
            $lid=$_SESSION['l_id'];
            $uid=$_GET['Editorsuspend'];
            $sql="UPDATE user SET is_verify='1'  WHERE uid=$uid";
            $res=mysqli_query($con,$sql);
           
            $sql="SELECT * FROM user where uid='$uid'";
            $res=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($res);
            $n=$row['name'];
            $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
            VALUES('suspended by','One editor','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
            $res=mysqli_query($con,$sql);
            require 'vieweditor.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
    }
    // reporter suspend by admin from admin dashboard
    elseif(isset($_GET['RS']))
    {
       
        if(isset($_SESSION['uid']))
        {
            $uid1=$_SESSION['uid'];
            $nuid=$_SESSION['name'];
            $cid=$_SESSION['c_id'];
            $lid=$_SESSION['l_id'];
            $uid=$_GET['RS'];
            $sql="UPDATE user SET is_verify='1'  WHERE uid=$uid";
            $res=mysqli_query($con,$sql);
            
            $sql="SELECT * FROM user where uid='$uid'";
            $res=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($res);
            $n=$row['name'];
            $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
            VALUES('suspended by','One reporter','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
            $res=mysqli_query($con,$sql);
            require 'viewreporter.php';
        }
        else
        {
            header("location:http://localhost/news_portal/login.php");
        }
        
    }
    // reporter realse by admin from admin dashboard
    elseif(isset($_GET['Rrealse']))
    {
        $uid1=$_SESSION['uid'];
        $nuid=$_SESSION['name'];
        $cid=$_SESSION['c_id'];
        $lid=$_SESSION['l_id'];
        $uid=$_GET['Rrealse'];
        $sql="UPDATE user SET is_verify='0'  WHERE uid=$uid";
        $res=mysqli_query($con,$sql);
        $lastid = $con->insert_id;
        $sql="SELECT * FROM user where uid='$uid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('realsed by','One reporter','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
        $res=mysqli_query($con,$sql);
        require 'reportersuspend.php';
    }
    // Editor realse by admin from admin dashboard
    elseif(isset($_GET['Erealse']))
    {
        $uid1=$_SESSION['uid'];
        $nuid=$_SESSION['name'];
        $cid=$_SESSION['c_id'];
        $lid=$_SESSION['l_id'];
        $uid=$_GET['Erealse'];
        $sql="UPDATE user SET is_verify='0'  WHERE uid=$uid";
        $res=mysqli_query($con,$sql);
       
        $sql="SELECT * FROM user where uid='$uid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['name'];
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,c_id,l_id,to_id,post_id,role) 
        VALUES('realsed by','One editor','$n','$nuid','$cid','$lid','$uid','$uid1','admin')";
        $res=mysqli_query($con,$sql);
        require 'editorsuspend.php';
    }
    //  index where admin/reporter/editor will open news 
    elseif(isset($_GET['index']))
    {
        $nid=$_GET['index'];
        require 'index.php';
    }
//  reporter header
elseif(isset($_GET['addnews']))
{
    require 'addnews.php';
}
elseif(isset($_GET['mynews']))
{
    
    require 'news.php';
}
// Add News by reporter from reporter dashbioard
elseif(isset($_POST['news']))

{
    $nuid=$_SESSION['name'];
    $cid=$_SESSION['c_id'];
    $lid=$_SESSION['l_id'];
    $uid=$_SESSION['uid'];
    $c=$_SESSION['c_id'];  
    $h=$_POST['heading'];
    $d=$_POST['description'];
    $file="img/".basename($_FILES['img']['name']); 
    move_uploaded_file($_FILES['img']['tmp_name'],$file);
    if(isset($_POST['bnews']))
    {
        $b=$_POST['bnews']; 
        $sql="INSERT INTO news_detail(u_id,nheading,nimg,ndescription,nlocation,ncategory,is_breaking) 
        VALUES ('$uid','$h','$file','$d','$lid','$c','$b')";
        $res=mysqli_query($con,$sql); 
    }   
    else
    {                                     
        $sql="INSERT INTO news_detail(u_id,nheading,nimg,ndescription,nlocation,ncategory) 
        VALUES ('$uid','$h','$file','$d','$lid','$c')";
        $res=mysqli_query($con,$sql); 
       
    }
    $lastid=$con->insert_id;
    $sql="SELECT * FROM news_detail where nid='$lastid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['nheading'];
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,n_id,c_id,l_id,to_id,post_id,role) 
    VALUES('added by','One news','$n','$nuid','$lastid','$cid','$lid','$lastid','$uid','reporter')";
    $res=mysqli_query($con,$sql);
    require 'addnews.php';
}
// News Edit by editor from editor dashboard
elseif(isset($_GET['Nedit']))
{
    require 'newsedit.php';
}
// news update by editor from editor dashboard
elseif(isset($_GET['newsupdate']))
{
    $nid=$_GET['newsupdate'];
    $h=$_POST['heading'];
    $d=$_POST['description'];
    $x="img/";
    $y=basename($_FILES['img']['name']);
    if(!empty($y))
    {
        $file=$x.$y;
        $sql="UPDATE news_detail SET nheading='$h',nimg='$file',ndescription='$d' WHERE nid='$nid'";
        $res = mysqli_query($con,$sql);
        move_uploaded_file($_FILES['img']['tmp_name'],$file);
        require 'news.php';
    }
    else
    {
        $sql="UPDATE news_detail SET nheading='$h' ,ndescription='$d' WHERE nid='$nid'";
        $res = mysqli_query($con,$sql);
        require 'news.php';
    }
}
// News Delete by reporter from reporter dashboard
elseif(isset($_GET['Ndelete']))
{
    $uid1=$_SESSION['uid'];
    $nuid=$_SESSION['name'];
    $cid=$_SESSION['c_id'];
    $lid=$_SESSION['l_id'];
    $uid=$_SESSION['uid'];
    $nid=$_GET['Ndelete'];
    $sql="UPDATE news_detail SET is_delete='1' WHERE nid='$nid'";
    $res=mysqli_query($con,$sql);
    
    $sql="SELECT * FROM news_detail where nid='$nid'  ";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['nheading'];
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,n_id,c_id,l_id,to_id,post_id,role) 
    VALUES('deleted by','One news','$n','$nuid','$nid','$cid','$lid','$nid','$uid1','reporter')";
    $res=mysqli_query($con,$sql);
    require 'news.php';
}
// reporter news will view on reporter dashboard
elseif(isset($_GET['Nview']))
{
    $nid=$_GET['Nview'];
    require 'viewnews.php';
}

// Editor view news  on editor dashboard
elseif(isset($_GET['EVnews']))
{
    
    require 'editornews.php';
}
// Verify news seen to editor  on editor dashboard
elseif(isset($_GET['Vnews']))
{
    require 'verifynews.php';
}
// Query to verify news on editor from editor dashboard
elseif(isset($_GET['Everifynews']))
{
    $nuid=$_SESSION['name'];
    $cid=$_SESSION['c_id'];
    $lid=$_SESSION['l_id'];
    $uid=$_SESSION['uid'];
    $nid=$_GET['Everifynews'];
    $sql="UPDATE news_detail SET is_verify='1' WHERE nid=$nid";
    $res=mysqli_query($con,$sql);
    
    $sql="SELECT * FROM news_detail where nid='$nid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['nheading'];
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,n_id,c_id,l_id,to_id,post_id,role) 
    VALUES('verified by','One news','$n','$nuid','$nid','$cid','$lid','$nid','$uid','editor')";
    $res=mysqli_query($con,$sql);
    require 'news.php';
}
//  Non-verify news of editor  on editor dashboard
elseif(isset($_GET['Enonverifynews']))
{
    $nuid=$_SESSION['name'];
    $cid=$_SESSION['c_id'];
    $lid=$_SESSION['l_id'];
    $uid=$_SESSION['uid'];
    $nid=$_GET['Enonverifynews'];
    $sql="UPDATE news_detail SET is_verify='0' WHERE nid=$nid";
    $res=mysqli_query($con,$sql);
    $lastid = $con->insert_id;
    $sql="SELECT * FROM news_detail where nid='$nid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['nheading'];
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,n_id,c_id,l_id,to_id,post_id,role) 
    VALUES(' blocked by','One news','$n','$nuid','$nid','$cid','$lid','$nid','$uid','editor')";
    $res=mysqli_query($con,$sql);
    require 'verifynews.php';
}
// News shown in detail 
elseif(isset($_GET['detail']))
{   
    $nid=$_GET['detail'];
    require 'detail.php';
}
// comment inserted by user when user is login
elseif(isset($_GET['comment_insert']))
{   
    $nuid=$_SESSION['name'];
    $uid=$_SESSION['uid'];
    $nid=$_GET['comment_insert'];
    $msg=$_POST['message'];
    $sql="SELECT * from news_detail WHERE nid='$nid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $postbyid=$row['u_id'];
    if(isset($uid))
    {
        
        $sql="INSERT INTO comment(comment,commentby_id,nid,newsposted_by) 
        VALUE('$msg','$uid','$nid','$postbyid')";
        $res=mysqli_query($con,$sql);
        $lastid=$con->insert_id;
        echo $lastid;
        $sql="SELECT * FROM comment where cmt_id='$lastid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $n=$row['comment'];
       
        $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,n_id,post_id,role) 
        VALUES('recieved by','One Comment','$n','$nuid','$nid','$uid','$nuid')";
        $res=mysqli_query($con,$sql);
        header('location:http://localhost/news_portal/detail.php?nid='.$nid);

    }
    else
    {
        header("location:http://localhost/news_portal/login.php?msg= Please login First Than comment ");
    } 
}
// dashboard seen to admin /reporter / editor
elseif(isset($_GET['dashboard']))
{  
    if(isset($_SESSION['uid']))
    {
    require 'dashboard.php';
    }
    else
    {
        header("location:http://localhost/news_portal/login.php ");
    } 
}
// User edit by user on user dashboard
elseif(isset($_GET['Uedit']))
{
    $uid=$_GET['Uedit'];
    $n=$_POST['name'];
    $m=$_POST['mobile'];
    $e=$_POST['email'];
   
    $sql="UPDATE user SET name='$n',mobile='$m',email='$e' WHERE uid='$uid'";
    $res = mysqli_query($con,$sql);
    require 'vu.php';
}
// User delete by admin from admin dashboard
elseif(isset($_GET['Udelete']))
{
    $uid1=$_SESSION['uid'];
    $nuid=$_SESSION['name'];
    $uid=$_GET['Udelete'];
    $sql="UPDATE user SET is_delete='1' WHERE uid='$uid'";
    $res=mysqli_query($con,$sql);
    $sql="SELECT * FROM user where uid='$uid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['name'];
    
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,to_idpost_id,,role) 
    VALUES('deleted by','One user','$n','$nuid','$uid','$uid1','admin')";
    $res=mysqli_query($con,$sql);
    require 'vu.php';
}
//  user block by admin from admin dashboard
elseif(isset($_GET['Ublock']))
{   
    $uid1=$_SESSION['uid'];
    $nuid=$_SESSION['name'];
    $uid=$_GET['Ublock'];
    $sql="UPDATE user SET is_verify='1'  WHERE uid=$uid";
    $res=mysqli_query($con,$sql);
    $sql="SELECT * FROM user where uid='$uid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['name'];
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,to_id,post_id,role) 
    VALUES('blocked by','One user','$n','$nuid','$uid','$uid1','user')";
    $res=mysqli_query($con,$sql);
    require 'vu.php';
}
// user realse  by admin from admin dashboard

elseif(isset($_GET['Urealse']))
{   
    $nuid=$_SESSION['name'];
    $uid1=$_SESSION['uid'];

    $uid=$_GET['Urealse'];
    $sql="UPDATE user SET is_verify='0'  WHERE uid=$uid";
    $res=mysqli_query($con,$sql);
    $sql="SELECT * FROM user where uid='$uid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['name'];
    $sql="INSERT INTO notification(noti_event,noti_object,username,u_id,to_id,post_id,role) 
    VALUES('realsed by','One user','$n','$nuid','$uid','$uid1','user')";
    $res=mysqli_query($con,$sql);
    require 'nvu.php';
}                    
//    liked news by login user
elseif(isset($_GET['likednews']))
{  
    $uid=$_SESSION['uid'];
    $nid=$_GET['likednews'];
    
    if(isset($uid))
    {
        $sql="SELECT * from news_detail WHERE nid='$nid'";
        $res=mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res);
        $postbyid=$row['u_id'];
    
        $sql="INSERT INTO likednews(newslikedby_id,n_id,newspostedby) values('$uid','$nid','$postbyid')";
        $res=mysqli_query($con,$sql);
        require 'detail.php';
    }
    else
    {
        header("location:http://localhost/news_portal/login.php?msg= Please login ");
    }
}
//  notifiacto shown to admin on admin dashboard
elseif(isset($_GET['notification']))
{   
    require 'notification.php';
}     
elseif(isset($_GET['email']))
{   
    $uid=$_SESSION['uid'];
    require 'email.php';
}     
 
elseif(isset($_POST['submit']))
{
    $f=$_POST['from'];
    $t=$_POST['to'];
   
    $m=$_POST['message'];
    $file1="img/".basename($_FILES["att"]["name"]);
    $sql="INSERT INTO message(from_id,to_id,attachiement,message) 
    VALUES('$f','$t','$file1','$m')";
    $res=mysqli_query($con,$sql);
    move_uploaded_file($_FILES["att"]["tmp_name"],$file1);
    require 'email.php';
   
}

?>