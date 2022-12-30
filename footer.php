  
  
  
  <!-- Footer Start -->
  <div class="container-fluid bg-dark pt-5 px-sm-3 px-md-5 mt-5">
        <div class="row py-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="mb-4 text-white text-uppercase font-weight-bold">Get In Touch</h5>
                <p class="font-weight-medium"><i class="fa fa-map-marker-alt mr-2"></i>Infochord Technologies PVT LTD, Hyderbad</p>
                <p class="font-weight-medium"><i class="fa fa-phone-alt mr-2"></i>+91-9893011345</p>
                <p class="font-weight-medium"><i class="fa fa-envelope mr-2"></i>infochord@example.com</p>
                <h6 class="mt-4 mb-3 text-white text-uppercase font-weight-bold">Follow Us</h6>
                <div class="d-flex justify-content-start">
                                            
                <a class="btn btn-primary" href="https://www.facebook.com/infochord/" target="blank"><small class="fab fa-facebook-f"></small></a>
                <a class="btn btn-primary " href="https://twitter.com/infochord" target="blank"><small class="fab fa-twitter"></small></a>
                <a class="btn btn-primary" href="https://in.linkedin.com/company/infochord" target="blank"><small class="fab fa-linkedin-in"></small></a>
                <a class="btn btn-primary " href="https://www.instagram.com/accounts/login/" target="blank"><small class="fab fa-instagram"></small></a>
                <a class="btn btn-primary " href="https://www.google.com/maps/place/Infochord+Technologies+Pvt.+Ltd./@17.4461232,78.4639348,17z/data=!4m5!3m4!1s0x3bcb90a686f2967b:0x92c3a0be43785aa0!8m2!3d17.4461181!4d78.4661235" target="blank"><small class="fab fa-google-plus-g"></small></a>
                <a class="btn btn-primary y" href="https://www.youtube.com/channel/UCzCCaxQcD5n6fUUOw89wX5Q" target="blank"><small class="fab fa-youtube"></small></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="mb-4 text-white text-uppercase font-weight-bold">Popular News</h5>
                <div class="mb-3">
                <?php
                $sql="SELECT news_detail.nheading,news_detail.viewcount,news_detail.is_verify,news_detail.date,category.category_name
                    FROM news_detail
                    INNER JOIN category ON news_detail.ncategory = category.cid
                    WHERE  news_detail.is_verify='1'  ORDER BY viewcount DESC LIMIT 0,3;";
                $res = mysqli_query($con,$sql);
                  foreach($res as $row )
                  {
                   
                    $h1=$row['nheading'];
                    $head=substr($h1,0,40);
                    $d=$row['date'];
                    $c=$row['category_name'];
                 
            ?>
                    <div class="mb-2">
                        <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href=""><?php echo $c ?></a>
                        <a class="text-body text-decoration-none"  href=""><small><?php echo $d ?></small></a>
                    </div>
                    <a class="small text-body text-uppercase font-weight-medium text-decoration-none" href="detail.php"><?php echo $head ?></a>
                    <?php } ?>
                </div>
               
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="mb-4 text-white text-uppercase font-weight-bold">Categories</h5>
                <div class="m-n1"> 
                   <?php
                        $sql="SELECT * FROM category order by cid limit 1,5";
                        $res=mysqli_query($con,$sql);  
                        foreach($res as $row)
                        { 
                        $name=$row['category_name'];
                        ?>
                         <a href="" class="btn btn-sm btn-secondary m-1"><?php echo $name ?></a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="mb-4 text-white text-uppercase font-weight-bold"> Photos</h5>
                <div class="row">
                    <?php
                        $sql="SELECT * FROM news_detail where is_verify='1' order by nid DESC limit 0,6";
                        $res=mysqli_query($con,$sql);  
                        foreach($res as $row)
                        { 
                            $nid=$row['nid'];
                            $img=$row['nimg'];
                        ?>
                        <div class="col-5 mb-2">
                            <a href="config.php?detail=<?php echo $nid;?>"><img class="w-100" src="<?php echo $img ?>" alt=""></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4 px-sm-3 px-md-5" style="background: #111111;">
        <p class="m-0 text-center">&copy; <a href="#">Ap News </a>. All Rights Reserved. 
		
		<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
		Design by <a href="https://htmlcodex.com">Ajay Patidar</a></p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>