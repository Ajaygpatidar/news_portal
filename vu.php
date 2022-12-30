<?php
     include 'adminheader.php';
    $sql="SELECT user.name,user.mobile,user.email,user.uid,category.category_name,location.Location_name
    FROM user
    INNER JOIN category ON user.c_id = category.cid
    INNER JOIN location ON user.l_id = location.lid WHERE role='user' and is_verify='0' and is_delete='0'";
    $res=mysqli_query($con,$sql);
   
?>

<div class="container-fluid">
	<div class="row">
       
        <div class="col-md-12 well" style="margin-top:20px">
          <h2 class="text-center"> Verified User</h2>
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">  
                    <thead>
                        <th>Select All</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                        
                        
                            <?php                  
                            foreach($res as $row)
                            { 
                                $uid=$row['uid'];
                                $n=$row['name'];
                                $m=$row['mobile'];
                                $e=$row['email'];
                                $c=$row['category_name'];
                                $l=$row['Location_name'];
                                
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="checkthis" /></td>
                                    <td><?php echo $n ?></td>
                                    <td><?php echo $m ?></td>
                                    <td><?php echo $e ?></td>
                                    <td><?php echo $c ?></td>
                                    <td><?php echo $l ?></td>
                                    <td>
                                    <a href="#<?php echo $uid;?>" type="submit"  class="btn btn-success btn-xs"  data-toggle="modal">Edit</a>
                                            <div class="modal fade" id="<?php echo $uid;?>" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                            <h4 class="modal-title text-warning" id="myModalLabel">Edit Reporter</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="config.php?Uedit=<?php echo $uid;?>" method="post">

                                                            <div class="form-group">
                                                                <label>Name:</label>
                                                                <input type="text" class="form-control" name="name" value="<?php echo $n;?>" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Mobile:</label>
                                                                <input type="text" class="form-control" name="mobile" value="<?php echo $m;?>" required="required">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Email:</label>
                                                                <input type="email" class="form-control" name="email" value="<?php echo $e;?>" required="required">
                                                            </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" name="Uedit">submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <a href="config.php?Udelete=<?php echo $uid;?>" class="btn btn-danger btn-xs" >Delete</a>
                                        <a href="config.php?Ublock=<?php echo $uid;?>" class="btn btn-danger btn-xs" >Block</a>
                                    </td>
                                </tr>
                        <?php
                        }?>
                  
                    </tbody>
                        
                </table>
            </div>
        </div>
      <!-- /.modal-dialog --> 
    </div>
</div>