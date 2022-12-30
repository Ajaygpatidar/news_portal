<?php
    include 'header.php';
?>
    <!-- Main News Slider Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 px-0">
                <div class="owl-carousel main-carousel position-relative">
                <?php
                        $sql="SELECT news_detail.nheading,news_detail.is_breaking,news_detail.nid,news_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name
                        FROM news_detail
                        INNER JOIN category ON news_detail.ncategory = category.cid
                        WHERE  news_detail.is_verify='1' and is_breaking='1' ORDER BY nid DESC LIMIT 0,4;";
                        $res=mysqli_query($con,$sql);  
                        foreach($res as $row)
                        { 
                            $nid=$row['nid'];
                            $head=$row['nheading'];
                            $h=substr($head,0,50);
                            $img=$row['nimg']; 
                            $cat=$row['category_name'];
                            $date=$row['date'];
                           
                    ?>
                    <div class="position-relative overflow-hidden" style="height: 500px;">
                        <img class="img-fluid h-100" src="<?php echo $img;?>" style="object-fit: cover;">
                        <div class="overlay">
                            <div class="mb-2">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href=""><?php echo $cat;?></a>
                                <a class="text-white" href=""><?php echo $date;?></a>
                            </div>
                            <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="detail.php=<?php echo $nid ?>"><?php echo $h;?>...</a>
                        </div>
                    </div>

                   <?php } ?>
                </div>
            </div>
                        
            <div class="col-lg-5 px-0">
                <div class="row mx-0">
                    <?php
                        $sql="SELECT news_detail.nheading,news_detail.is_breaking,news_detail.nid,news_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name
                        FROM news_detail
                        INNER JOIN category ON news_detail.ncategory = category.cid
                        WHERE ncategory='15' and news_detail.is_verify='1'ORDER BY nid DESC LIMIT 0,4;";
                        $res=mysqli_query($con,$sql);  
                        foreach($res as $row)
                        { 
                            $nid=$row['nid'];
                            $head=$row['nheading'];
                            $h=substr($head,0,50);
                            $img=$row['nimg']; 
                            $cat=$row['category_name'];
                            $date=$row['date'];
                    ?>
                    <div class="col-md-6 px-0">
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <a href="config.php?detail=<?php echo $nid ?>"><img class="img-fluid w-100 h-100" src="<?php echo $img ?>" style="object-fit: cover;"></a>
                            <div class="overlay">
                                <div class="mb-2">
                                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                        href=""><?php echo $cat ?></a>
                                    <a class="text-white" href=""><small><?php echo $date ?></small></a>
                                </div>
                                <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="config.php?detail=<?php echo $nid ?>" style="text-decoration:none"><?php echo $h ?></a>
                            </div>
                        </div>
                    </div>


                    
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News Slider End -->


    <!-- Breaking News Start -->
    <div class="container-fluid bg-dark py-3 mb-3">
        <div class="container-fluid">
            <div class="row align-items-center bg-dark">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <div class="bg-primary text-dark text-center font-weight-medium py-2" style="width: 160px;">Breaking News</div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center ml-3"
                            style="width: calc(100% - 180px); padding-right: 90px;">
                            
                                <?php
                                    $sql="SELECT * FROM news_detail WHERE is_breaking='1' and is_verify='1 ' ORDER BY nid DESC LIMIT 0,3";
                                    $res=mysqli_query($con,$sql);  
                                    foreach($res as $row)
                                    { 
                                    $b=$row['nheading'];
                                    $h=$row['nheading'];
                                    $bn=$row['nheading'];
                                    ?>
                                    <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href=""><?php echo $b ?></a></div>
                                    <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href=""><?php echo $h ?></a></div>
                                    <div class="text-truncate"><a class="text-white text-uppercase font-weight-semi-bold" href=""><?php echo $bn ?></a></div>

                                <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


   

    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
           
              
                <div class="col-lg-8">
                
                    <div class="row">
                        
                        <div class="col-12">
                            <div class="section-title">
                                <h4 class="m-0 text-uppercase font-weight-bold">Latest News</h4>
                                <a class="text-secondary font-weight-medium text-decoration-none" href="index.php?allnews"  style="text-decoration:none">View All</a>
                            </div>
                        </div>
                        <!-- News Start -->
                    
                        <?php
                       
                        if(isset($_GET['allnews']))
                        {
                            $sql="SELECT news_detail.nheading,news_detail.nid,news_detail.viewcount,snews_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name,user.name,user.image
                            FROM news_detail
                            INNER JOIN category ON news_detail.ncategory = category.cid
                            INNER JOIN user ON news_detail.u_id = user.uid
                            INNER JOIN location ON news_detail.nlocation = location.lid WHERE news_detail.is_verify='1'  ORDER BY nid DESC";
                           
                        }
                        elseif(isset($_GET['menu']))
                        {
                            $cid=$_GET['menu'];
                            $sql="SELECT news_detail.nheading,news_detail.nid,news_detail.viewcount,news_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name,user.name,user.image
                            FROM news_detail
                            INNER JOIN category ON news_detail.ncategory = category.cid
                            INNER JOIN user ON news_detail.u_id = user.uid
                            INNER JOIN location ON news_detail.nlocation = location.lid WHERE news_detail.is_verify='1' && ncategory='$cid' ORDER BY nid DESC";
                             
                        }
                        elseif(isset($_GET['loc']))
                        {
                            $lid=$_GET['loc'];
                            $sql="SELECT news_detail.nheading,news_detail.nid,news_detail.viewcount,news_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name,user.name,user.image
                            FROM news_detail
                            INNER JOIN category ON news_detail.ncategory = category.cid
                            INNER JOIN user ON news_detail.u_id = user.uid
                            INNER JOIN location ON news_detail.nlocation = location.lid WHERE news_detail.is_verify='1' && nlocation='$lid' ORDER BY nid DESC";
                             
                        }// search keyword
                        elseif(isset($_POST['search']))
                        {
                            $s=$_POST['search'];
                            
                            $sql="SELECT news_detail.nheading,news_detail.nid,news_detail.viewcount,news_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name,user.name,user.image
                            FROM news_detail
                            INNER JOIN category ON news_detail.ncategory = category.cid
                            INNER JOIN user ON news_detail.u_id = user.uid
                            INNER JOIN location ON news_detail.nlocation = location.lid WHERE news_detail.is_verify='1' or category.category_name or location.Location_name or news_detail.nheading or news_detail.ndescription  LIKE '%$s%'";
                            $res=mysqli_query($con,$sql); 
                        }
                        else
                        {
                            $sql="SELECT news_detail.nheading,news_detail.nid,news_detail.viewcount,news_detail.nimg,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name,user.name,user.image
                            FROM news_detail
                            INNER JOIN category ON news_detail.ncategory = category.cid
                            INNER JOIN user ON news_detail.u_id = user.uid
                            INNER JOIN location ON news_detail.nlocation = location.lid WHERE news_detail.is_verify='1'  ORDER BY nid DESC LIMIT 0,6";
                        } 
                            $res=mysqli_query($con,$sql); 
                            foreach($res as $row)
                            { 
                            $nid=$row['nid'];
                            $head=$row['nheading'];
                            $h=substr($head,0,20);
                            $d=$row['ndescription'];
                            $dis=substr($d,0,200);
                            $img=$row['nimg'];
                            $loc=$row['Location_name'];
                            $cat=$row['category_name'];
                            $image=$row['image'];
                            $date=$row['date'];
                            $name=$row['name'];
                            $view=$row['viewcount'];
                           
                            ?>
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <a href="config.php?detail=<?php echo $nid ?>"><img class="img-fluid w-100" src="<?php echo $img ?>"  style="object-fit: cover; height:350px;"></a>
                                    <div class="bg-white border border-top-0 p-4">
                                        <div class="mb-2">
                                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                                href=""><?php echo $cat ?></a>
                                            <a class="text-body text-dark" href=""><small><?php echo $date ?></small></a>
                                            <a class="badge badge-danger text-uppercase  float-right font-weight-semi-bold p-2 "
                                                href=""><?php echo $loc ?></a>
                                        </div>
                                        <a class="h4 d-block mb-3 text-secondary text-uppercase font-weight-bold" href="config.php?detail=<?php echo $nid ?>"  style="text-decoration:none"><?php echo $h;?></a>
                                        <p class="m-0"><?php echo $dis ?></p>
                                    </div>
                                    <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                                        <div class="d-flex align-items-center">
                                            <img class="rounded-circle mr-2" src="<?php echo $image ?>" width="25" height="25" alt="">
                                            <small><?php echo $name ?></small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            
                                            <small class="ml-3"><i class="far fa-eye mr-2 text-success"></i><?php echo $view;?></small>
                                            <?php
                                            
                                            $sql="SELECT * FROM comment ";
                                            $res=mysqli_query($con,$sql);
                                            
                                            foreach($res as $row1)
                                            {
                                                $nid1=$row1['nid'];
                                                if($nid1==$nid)
                                                {
                                                    $sql="SELECT * FROM comment where nid='$nid1'";
                                                    $res=mysqli_query($con,$sql);
                                                    $count=mysqli_num_rows($res);
                                                }
                                                else
                                                {
                                                    $count='0';
                                                }
                                            }
                                             echo '<small class="ml-3"><i class="far fa-comment mr-2 text-warning"></i> '.$count.'</small>';
                                            ?>
                                            <?php
                                             $c='0';  
                                            $sql1="SELECT * FROM likednews where n_id='$nid'";
                                            $res=mysqli_query($con,$sql1); 
                                            foreach($res as $row2)
                                            { 
                                                $nid2=$row2['n_id'];
                                                $sql="SELECT * FROM likednews where n_id='$nid2'";
                                                $res=mysqli_query($con,$sql);
                                                $c=mysqli_num_rows($res);
                                              
                                            }
                                            ?>
                                             <small class="ml-3"><i class="far fa-thumbs-up text-info"></i> <?php echo $c ?></small>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-12">
                            <div class="section-title ">
                                <a class="text-primary font-weight-large   text-decoration-none" href="index.php?allnews" ><h4 class=" text-center">View All</h4></a>
                            </div>
                        </div>
                    </div>
                        
                </div>
               <?php
                    include 'siderbar.php';
               ?>
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->


    <?php 
        include 'footer.php';
    ?>
   