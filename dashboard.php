<?php
    
    $role=$_SESSION['role'];
    
    if($role=='admin')
    {
        include 'adminheader.php';
    
    ?>
<div class="col-sm-12 col-md-12" id="content">
    <div class="row">
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="" style="text-decoration:none"><h6 class=" text-center text-primary">  Total Member</h6></a>
            <?php
            $sql="SELECT * FROM user ";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="" style="text-decoration:none"><h6 class=" text-center text-primary">Total User</h6></a>
            <?php
            $sql="SELECT * FROM user WHERE role='user'";
            $res=mysqli_query($con,$sql);  
            $count=mysqli_num_rows($res);
            ?>
           
            <p class=" text-center text-danger"><?php echo $count ;?></p>
           
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?vu" style="text-decoration:none"><h6 class=" text-center text-primary"> Verified User</h6></a>
           <?php
             $sql="SELECT * FROM user WHERE  role='user' and is_verify='0'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
            <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?nvu" style="text-decoration:none"><h6 class=" text-center text-primary"> Non-Verified User</h6></a>
            <?php
             $sql="SELECT * FROM user WHERE  role='user'and is_verify='1'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
            <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="" style="text-decoration:none"><h6 class=" text-center text-primary"> Reporter</h6></a>
            <?php
             $sql="SELECT * FROM user WHERE  role='reporter'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
            <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?Vreporter" style="text-decoration:none"><h6 class=" text-center text-primary"> Verified Reporter</h6></a>
            
            <?php
             $sql="SELECT * FROM user WHERE  role='reporter' and is_verify='0'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
            <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
      

    </div>
    <div class="row">
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?Rsuspend" style="text-decoration:none"><h6 class=" text-center text-primary">  Non-Verified Reporter</h6></a>
            <?php
             $sql="SELECT * FROM user WHERE  role='reporter' and is_verify='1'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="" style="text-decoration:none"><h6 class=" text-center text-primary"> Editor</h6></a>
            <?php
             $sql="SELECT * FROM user WHERE  role='editor'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?Veditor" style="text-decoration:none"><h6 class=" text-center text-primary"> Verified Editor</h6></a>
            <?php
             $sql="SELECT * FROM user WHERE  role='editor' and is_verify='0'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?Esuspend" style="text-decoration:none"><h6 class=" text-center text-primary">  Non-Verified Editor</h6></a>
            <?php
             $sql="SELECT * FROM user WHERE  role='editor' and is_verify='1'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="" style="text-decoration:none"><h6 class=" text-center text-primary"> News</h6></a>
            <?php
             $sql="SELECT * FROM news_detail ";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?Vnews" style="text-decoration:none"><h6 class=" text-center text-primary"> Verified News</h6></a>
            <?php
                $sql="SELECT * FROM news_detail where is_verify='1'";
                $res=mysqli_query($con,$sql);  
                $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
       
    </div>
    
   
    <div class="row">
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?mynews" style="text-decoration:none"><h6 class=" text-center text-primary"> Non-verified news</h6></a>
            <?php
             $sql="SELECT * FROM news_detail where is_verify='0'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>

        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary"> Comment</h6></a>
            <p class=" text-center text-danger">15</p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary"> Total View</h6></a>
            <p class=" text-center text-danger">15</p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary"> TotalLikes</h6></a>
            <p class=" text-center text-danger">15</p>
        </div>
    </div>
</div>
<?php }

elseif($role=='reporter')
{   
    include 'reporterheader.php';
    $uid=$_SESSION['uid'];

    ?>
    <div class="row">
      <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?mynews" style="text-decoration:none"><h6 class=" text-center text-primary">  Total News</h6></a>
            <?php
             $sql="SELECT * FROM news_detail where u_id='$uid'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?mynews" style="text-decoration:none"><h6 class=" text-center text-primary"> Verified News</h6></a>
            <?php
                $sql="SELECT * FROM news_detail where u_id='$uid' and is_verify='1'";
                $res=mysqli_query($con,$sql);  
                $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?mynews" style="text-decoration:none"><h6 class=" text-center text-primary"> Non-verified news</h6></a>
            <?php
             $sql="SELECT * FROM news_detail where u_id='$uid' and is_verify='0'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>

        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary"> Comment</h6></a>
            <?php
             $sql="SELECT * FROM comment where newsposted_by='$uid' ";
            $res=mysqli_query($con,$sql);  
            $row=mysqli_num_rows($res);
            ?>
            <p class=" text-center text-danger"><?php echo $row ?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary"> Total View</h6></a>
            <?php
            // $sql = "SELECT SUM(value) AS viewcount FROM news_detail WHERE u_id='$uid'";
            $sql="SELECT SUM(viewcount) FROM news_detail  WHERE u_id='$uid'";
            $res=mysqli_query($con,$res); 
            $row=mysqli_fetch_array($res); 
            $sum=$row['viewcount'];
            ?>
            <p class=" text-center text-danger"><?php echo $sum ?></p>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
        <?php
            $sql="SELECT * FROM likednews where newspostedby='$uid' ";
            $res=mysqli_query($con,$sql);  
            $row=mysqli_num_rows($res);
            ?>
            <h6 class="text-center text-center text-primary"> TotalLikes</h6></a>
            <p class=" text-center text-danger"><?php echo $row ?></p>
        </div>
    </div>
<?php }
elseif($role=='editor')
{
    include 'editorheader.php';
   $uid=$_SESSION['uid'];
    $c=$_SESSION['c_id'];
    $l=$_SESSION['l_id'];
    
    ?>
     <div class="row">
      <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="" style="text-decoration:none"><h6 class=" text-center text-primary"> Total News</h6></a>
            <?php
            $sql="SELECT * FROM news_detail  where  ncategory='$c' and nlocation='$l'";
            $res=mysqli_query($con,$sql);  
            $count=mysqli_num_rows($res);
           
            ?>
             <p class=" text-center text-danger"><?php echo $count;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?Vnews" style="text-decoration:none"><h6 class=" text-center text-primary">  Total Verified News</h6></a>
            <?php
            
              $sql="SELECT * FROM news_detail  where  ncategory='$c' and nlocation='$l' and is_verify='1'";
              $res=mysqli_query($con,$sql);  
              $count=mysqli_num_rows($res);
                
            ?>
             <p class=" text-center text-danger"><?php echo $count;?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <a href="config.php?mynews" style="text-decoration:none"><h6 class=" text-center text-primary"> Non-verified news</h6></a>
            <?php
             $sql="SELECT * FROM news_detail where ncategory='$c' and nlocation='$l' and is_verify='0'";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
            ?>
             <p class=" text-center text-danger"><?php echo $c;?></p>
        </div>

        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
       
            <h6 class="text-center text-center text-primary">  Total Category</h6></a>
            <?php
            $sql="SELECT * FROM category ";
            $res=mysqli_query($con,$sql);  
            $c=mysqli_num_rows($res);
        ?>
            <p class=" text-center text-danger"><?php echo $c ?></p>
        </div>
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary">  total Location</h6></a>
            <?php
            $sql="SELECT * FROM location ";
            $res=mysqli_query($con,$sql);  
            $loc=mysqli_num_rows($res);
        ?>
            <p class=" text-center text-danger"><?php echo $loc ?></p>
        </div>
        
    </div>
    <div class="row">
        <div class="col-sm-1 well  col-sm-offset-1" style="border-radius:50%">
            <h6 class="text-center text-center text-primary"> Total reporter</h6></a>
        <?php
            $cid=$_SESSION['c_id'];
            $lid=$_SESSION['l_id'];
            $sql="SELECT * FROM user where l_id='$lid' and c_id='$cid' and role='reporter'";
            $res=mysqli_query($con,$sql);  
            $tr=mysqli_num_rows($res);
        ?>
            <p class=" text-center text-danger"><?php echo $tr ?></p>
        </div>
    </div>
<?php } ?>
