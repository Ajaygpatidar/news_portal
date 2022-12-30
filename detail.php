<?php
    include 'header.php';
   
    if(isset($_GET['nid']))
    {
        $nid=($_GET['nid']);
    }
    // view news concept...
    $sql="SELECT * FROM news_detail where nid='$nid'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $v=$row['viewcount'];
    $v1=$v + 1;

    $sql="UPDATE news_detail SET viewcount='$v1' where nid='$nid'";
    $res=mysqli_query($con,$sql);


    $sql="SELECT news_detail.nheading, news_detail.nimg,  news_detail.viewcount, news_detail.nid,news_detail.viewcount,news_detail.is_verify,news_detail.ndescription,news_detail.date,category.category_name,location.Location_name,user.name,user.image
    FROM news_detail
    INNER JOIN category ON news_detail.ncategory = category.cid
    INNER JOIN user ON news_detail.u_id = user.uid
    INNER JOIN location ON news_detail.nlocation = location.lid WHERE nid='$nid' and news_detail.is_verify='1' ";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);

    $h=$row['nheading'];
    $nid=$row['nid'];
    $d=$row['ndescription'];
    $img=$row['nimg'];
    $loc=$row['Location_name'];
    $cat=$row['category_name'];
    $image=$row['image'];
    $date=$row['date'];
    $name=$row['name'];
    $v2=$row['viewcount'];
?>

    <!-- Breaking News Start -->
    <div class="container-fluid  mb-3 pt-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="section-title border-right-0 mb-0" style="width: 180px;">
                            <h4 class="m-0 text-uppercase font-weight-bold">Tranding</h4>
                        </div>
                        <div class="owl-carousel tranding-carousel position-relative d-inline-flex align-items-center bg-white border border-left-0"
                            style="width: calc(100% - 180px); padding-right: 100px;">
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl sodales</a></div>
                            <div class="text-truncate"><a class="text-secondary text-uppercase font-weight-semi-bold" href="">Lorem ipsum dolor sit amet elit. Proin interdum lacus eget ante tincidunt, sed faucibus nisl sodales</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breaking News End -->


    <!-- News With Sidebar Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="<?php echo $img ?>" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href=""><?php echo $cat ?></a>
                                <a class="text-body" href=""><?php echo $date?></a>
                                <a class="badge badge-danger text-uppercase  float-right font-weight-semi-bold p-2 "
                                    href=""><?php echo $loc ?></a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold"><?php echo $h ?></h1>
                            <p><?php  echo $d ?></p>
                            
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" src="<?php echo $image ?>" width="25" height="25" alt="">
                                <span><?php echo $name ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="sharethis-inline-share-buttons mr-4"></div>
                                <!-- view news -->

                                <span class="ml-3"><i class="far fa-eye mr-2 text-success"></i><?php echo $v2;?></span>
                                <?php
                                    $sql="SELECT * FROM comment where nid='$nid' order by nid limit 0,5";
                                    $res=mysqli_query($con,$sql); 
                                    $row=mysqli_num_rows($res) ;
                                ?>
                                <span class="ml-3"><i class="far fa-comment mr-2 text-warning"></i><?php echo $row; ?></span>
                                <!-- like -->
                                
                                <?php
                                    $sql="SELECT * FROM likednews where n_id='$nid'";
                                    $res=mysqli_query($con,$sql);
                                    $count=mysqli_num_rows($res);
                                    if(isset($_SESSION['uid']))
                                    { 
                                       
                                        $uid=$_SESSION['uid'];
                                        $sql="SELECT * FROM likednews  where n_id='$nid' and newslikedby_id='$uid'";
                                        $res=mysqli_query($con,$sql); 
                                        $row=mysqli_fetch_array($res);
                                        
                                        if($row==true)
                                        { ?>
                                            <span class="ml-2"><a href=""  class="btn disabled"><i class="far fa-thumbs-up mr-2 text-danger"> </i></a><?php echo $count ?></span>    
                                        <?php }   
                                        else
                                        { ?>
                                            <span  class="ml-3"><a href="config.php?likednews=<?php echo $nid ?>"><i class="far fa-thumbs-up mr-2 text-info" ></i></a><?php echo $count ?></span>
                                       <?php } ?>
                                    
                                   <?php } 
                                      else
                                     { ?>
                                        <span  class="ml-3"><a href="config.php?likednews"><i class="far fa-thumbs-up mr-2 text-info" ></i></a><?php echo $count ?></span>

                                    <?php } ?>
                                     
                     
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->
                          <!-- Comment List Start -->
                    <div class="mb-3">
                  
                        <div class="section-title mb-0">
                        <?php
                            $sql="SELECT * FROM comment where nid='$nid' order by nid limit 0,5";
                            $res=mysqli_query($con,$sql); 
                            $row=mysqli_num_rows($res) ;
                        ?>
                            <h4 class="m-0 text-uppercase font-weight-bold"><?php echo $row?> Comment</h4>
                        </div>
                       <?php
                            $sql="SELECT  comment.comment,comment.date, user.image,user.name
                            FROM comment
                            INNER JOIN user ON comment.commentby_id = user.uid  where nid='$nid' ORDER BY nid DESC limit 0,8";
                            $res=mysqli_query($con,$sql); 
                            foreach($res as $row)
                            { 
                            
                                $c=$row['comment'];
                                $date=$row['date'];
                                $name=$row['name'];
                                $image=$row['image'];    
                        ?>

                        <div class="bg-white border border-top-0 p-4">
                            <div class="media mb-4">
                                <img src="<?php echo $image; ?>" alt="Image" class="" style="width: 45px;">
                                <div class="media-body">
                                    <h6><a class="text-secondary font-weight-bold" href=""><?php echo $name; ?></a> <small><i><?php echo $date;?></i></small></h6>
                                    <p><?php echo $c ?></p>
                                    <button class="btn btn-sm btn-outline-secondary">Reply</button>
                                </div>
                            </div>    
                        </div>
                        <?php } ?>
                    </div>
                    <!-- Comment List End -->
                    
                    <!-- Comment Form Start -->
                    <div class="mb-3">
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Leave a comment</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4">
                            <form action="config.php?comment_insert=<?php echo $nid;?>" method="POST">
                                
                                <div class="form-group">
                                    <label >Message *</label>
                                    <textarea  cols="30" rows="5" name="message" class="form-control"></textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit"  
                                    class="btn btn-primary font-weight-semi-bold py-2 px-3">submit</button>
                                </div>
                              
                            </form>
                        </div>
                    </div>
                    <!-- Comment Form End -->
                </div>

                <!-- sider news -->
                    <?php
                        include 'siderbar.php';
                    ?>
                <!-- sidebar news end -->
                   
                <!-- </div> -->
            </div>
        </div>
    </div>
    <!-- News With Sidebar End -->
    <!-- Footer Start -->
        <?php
            include 'footer.php';
        ?>
    <!-- Footer end -->

