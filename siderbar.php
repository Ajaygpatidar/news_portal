<div class="col-lg-4"> 
        <!-- CategoryStart -->
        <div class="mb-3">
            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Categoey</h4>
            </div>
            
            <div class="bg-white border border-top-0 p-3">
                <?php
                $sql="SELECT * FROM category order by cid limit 1,5";
                $res=mysqli_query($con,$sql);  
            
                foreach($res as $row)
                { 
                    $cid=$row['cid'];
                    $name=$row['category_name'];
                ?>
                <a href="index.php?menu=<?php echo $cid;?>" class="d-block w-100 text-dark text-decoration-none mb-3 p-2" style="background: #FFCC00;">
                    <span class="font-weight-medium text-dark text-uppercase "><?php echo $name ?></span>
                </a>
                <?php } ?>
            </div>
        </div>

        <!-- Category end -->
        <!-- location Start -->
        <div class="mb-3">
            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Location</h4>
            </div>
            <div class="bg-white border border-top-0 p-3">
            <?php
               
                $sql="SELECT * FROM location order by lid limit 1,5";
                $res=mysqli_query($con,$sql);  
            
                foreach($res as $row)
                { 
                    $lid=$row['lid'];
                $lname=$row['Location_name'];
                ?>
                <a href="index.php?loc=<?php echo $lid;?>" class="d-block w-100 text-dark text-decoration-none mb-3 p-2" style="background: #FFCC00;">
                    <span class="font-weight-medium text-dark text-uppercase"><?php echo $lname ?></span>
                </a>
            <?php } ?>
            </div>
        </div>
        <!-- location End -->

        <!-- Social follows  Start -->
        <div class="mb-3">
             <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Follow Us on FACEBOOK</h4>
            </div>
            <div class="bg-white border border-top-0 p-3">
                <div class="fb-page" data-href="https://www.facebook.com/infochord" data-tabs="timeline" data-width="350" data-height="250" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/infochord" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/infochord">Infochord Technologies Pvt. Ltd.</a></blockquote>
                </div>      
            </div>
        </div>
        <!-- follow us End -->

         <!-- Social follows  Start -->
         <div class="mb-3">
             <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Follow Us on TWITTER</h4>
            </div>
            <a class="twitter-timeline" data-width="350" data-height="200" href="https://twitter.com/infochord?ref_src=twsrc%5Etfw">Tweets by infochord</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>        </div>
        <!-- follow us End -->

        <!-- Popular News Start -->
        <div class="mb-3">
            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Tranding News</h4>
            </div>
           
            <div class="bg-white border border-top-0 p-3">
               
            <?php      
                // $sql =  "SELECT MAX(viewcount) as 'viewcount' FROM news_detail ";
                // $sql=" SELECT news_detail.nid, MAX(news_detail.viewcount) FROM news_detail
                //GROUP BY news_detail.viewcount";

                //$sql="SELECT * FROM news_detail WHERE viewcount = ( SELECT MAX(viewcount) FROM news_detail)";
                $sql="SELECT news_detail.nheading,news_detail.nid,viewcount,news_detail.nid,news_detail.nimg,news_detail.is_verify,news_detail.date,category.category_name
                    FROM news_detail
                    INNER JOIN category ON news_detail.ncategory = category.cid
                    WHERE  news_detail.is_verify='1'  ORDER BY viewcount DESC LIMIT 0,5;";
                $res = mysqli_query($con,$sql);
                  foreach($res as $row )
                  {
                    $nid=$row['nid'];
                    $img=$row['nimg'];
                    $h1=$row['nheading'];
                    $h=substr($h1,0,20);
                    $d=$row['date'];
                    $c=$row['category_name'];
                 
            ?>
                <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
                    <img  src="<?php echo $img;?>" height="100" width="150" alt="">
                    <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                        <div class="mb-2">
                            <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href=""><?php echo $c;?></a>
                            <a class="text-body text-decoration-none" href="" ><small><?php echo $d;?></small></a>
                        </div>
                        <a class="h6 m-0 text-secondary text-uppercase font-weight-bold text-decoration-none" href="config.php?detail=<?php echo $nid ?>"><?php echo $h;?></a>
                    </div>
                </div>
               <?php } ?>
            </div>
        </div>
        <!-- Popular News End -->

        

        <!-- Tags Start -->
        <div class="mb-3">
            <div class="section-title mb-0">
                <h4 class="m-0 text-uppercase font-weight-bold">Tags</h4>
            </div>
            <div class="bg-white border border-top-0 p-3">
                <div class="d-flex flex-wrap m-n1">
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Politics</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Corporate</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Health</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Education</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Science</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Business</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Foods</a>
                    <a href="" class="btn btn-sm btn-outline-secondary m-1">Travel</a>
                </div>
            </div>
        </div>
        <!-- Tags End -->
</div>