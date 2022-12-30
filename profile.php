<?php
    
    $uid=$_SESSION['uid'];
    $role=$_SESSION['role'];
    $sql="SELECT user.name,user.mobile,user.email,user.address,user.image, category.category_name,location.Location_name
    FROM user
    INNER JOIN category ON user.c_id = category.cid
    INNER JOIN location ON user.l_id = location.lid WHERE uid=$uid";
 
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res);
    $n=$row['name'];
    $m=$row['mobile'];
    $e=$row['email'];
    $c=$row['category_name'];
    
    $l=$row['Location_name'];
    $a=$row['address'];
    $img=$row['image'];

    if($role=='admin')
    {
        include 'adminheader.php';
    }
    elseif($role=='reporter')
    {
        include 'reporterheader.php';
    }
    elseif($role=='editor')
    {
        include 'editorheader.php';
    }
    elseif($role=='user')
    {
        include 'userheader.php';
    }
  
  ?>
  
<div id="page-wrapper">
    <div class="container-fluid well" style="margin-top:100px">
            <form action="config.php" method="post" enctype="multipart/form-data">
                <center><h3>My Profile</h3></center>
                <div class="row  col-sm-12 " style="margin-top:20px">
                    <div class="col-md-4">
                      
                        <div class="profile-img">
                            
                            <img src="<?php echo $img;?>" alt=""class="img-rounded"  height="190px" width="210px">
                            <input type="file" class="form-control" style="margin-top:15px" name="img">
                            <button type="submit" class="btn btn-success" name="imgupdate">
                            submit
                            </button>
                        </div>
                      
                    </div>
                    
                   
                    <div class="col-md-6 ">
                              
                        <div class="row">
                            <div class="col-md-4">
                                <label>Name:</label>
                            </div>
                            <div class="col-md-4">
                                <p><?php echo $n; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Emai:</label>
                            </div>
                            <div class="col-md-4">
                                <p><?php echo $e ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Phone:</label>
                            </div>
                            <div class="col-md-4">
                                <p><?php echo $m;?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Category:</label>
                            </div>
                            <div class="col-md-4">
                                <p><?php echo $c;?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Location:</label>
                            </div>
                            <div class="col-md-4">
                                <p><?php echo $l;?></p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Address:</label>
                            </div>
                            <div class="col-md-4">
                                <p><?php echo $a; ?></p>
                            </div>
                           

                        </div>
                        <div class="row"  style="margin-top:15px">
                        <div class="col-md-2 ">
                            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">
                            Edit Profile
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                                    </div>
                                  
                                        
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Name:</label>
                                                <input type="text" class="form-control" name="name" value="<?php echo $n; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mobile:</label>
                                                <input type="text" class="form-control" name="mobile" id="exampleInputPassword1" value="<?php echo $m; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">E-mail:</label>
                                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value="<?php echo $e; ?>">
                                            </div>
                                            <label>Address:</label>
                                            <div class="form-group">
                                               
                                                <textarea class="" rows="3" cols="50" name="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="pupdate">Update</button>
                                        </div>
                                    
                                    
                                </div>
                            </div>
                        </div>  
                        </div>  
                        <div class="col-md-2 col-sm-offset-1 ">
                            <button  type="button" class="btn btn-danger " data-toggle="modal" data-target="#myModal1">
                            Change password
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title" id="ModalLabel1">Edit Password</h4>
                                            <script type='text/javascript'>
                                            <?php 
                                            $openPopup = (isset($msg));
                                                echo " var openPopup = $openPopup" ;
                                            ?>
                                                if(openPopup){
                                                    <h3 class="text-danger"><?php  echo $msg; ?></h3>
                                            $('.popup').show();
                                                }jquery
                                            </script>

                                       
                                        
                                    </div>
                                   
                                        
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Enter Old Password:</label>
                                                <input type="password" class="form-control" name="opassword" id="exampleInputEmail1">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">New Password:</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"name="npassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Conform Password:</label>
                                                <input type="password" class="form-control" id="exampleInputEmail1" name="cpassword">
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="passwordupdate">Update</button>
                                        </div>

                                </div>
                            </div>                            
                        </div>
                          
                    </div>
                </div>
            </form>           
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->