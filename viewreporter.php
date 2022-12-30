<?php
    include 'db_cannect.php';
    include 'adminheader.php';
    $sql="SELECT user.name,user.mobile,user.email,user.uid,category.category_name,location.Location_name
    FROM user
    INNER JOIN category ON user.c_id = category.cid
    INNER JOIN location ON user.l_id = location.lid where role='reporter' && is_verify='0' && is_delete='0'";
    $res=mysqli_query($con,$sql);
   
?>

<div class="container-fluid">
	<div class="row">
       
        <div class="col-md-12 well" style="margin-top:20px">
            <h2 class="text-center">View Reporter</h2>
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
                        <th>count</th>
                    </thead>
                    <tbody>
                        
                        
                            <?php                  
                            foreach($res as $row)
                            {  
                                $n=$row['name'];
                                $m=$row['mobile'];
                                $e=$row['email'];
                                $c=$row['category_name'];
                                $l=$row['Location_name'];
                                $uid=$row['uid'];
                                
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
                                                            <form action="config.php?Redit=<?php echo $uid;?>" method="post">

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
                                                                <label for="category">Category:</label>
                                                                    <select name="cat" class="form-control" >
                                                                        
                                                                    <?php
                                                                        $sql="SELECT * FROM category";
                                                                        $res=mysqli_query($con,$sql);
                                                                    foreach($res as $row)
                                                                    {
                                                                        $cid=$row['cid'];
                                                                        $cn=$row['category_name'];
                                                                        
                                                                        echo ' <option value='.$cid.'>'.$cn.'</option>';
                                                                    } ?>
                                                                    
                                                                    </select>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label for="location">Location:</label>
                                                                    <select name="loc" class="form-control" >
                                                                        
                                                                    <?php
                                                                        $sql="SELECT * FROM location";
                                                                        $res=mysqli_query($con,$sql);
                                                                    foreach($res as $row)
                                                                    {
                                                                        $lid=$row['lid'];
                                                                        $ln=$row['Location_name'];
                                                                        
                                                                        echo ' <option value='.$lid.'>'.$ln.'</option>';
                                                                    } ?>
                                                                    
                                                                    </select>
                                                            </div>  
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary" name="Redit">submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <a href="config.php?Rdelete=<?php echo $uid;?>" class="btn btn-danger btn-xs" >Delete</a>
                                            <a href="config.php?RS=<?php echo $uid;?>" class="btn btn-danger btn-xs" >Suspend</a>
                                        </td>
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