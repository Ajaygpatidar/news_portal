<?php
    include 'adminheader.php';
    $sql="SELECT user.name,user.mobile,user.email,user.uid,category.category_name,location.Location_name
    FROM user
    INNER JOIN category ON user.c_id = category.cid
    INNER JOIN location ON user.l_id = location.lid where role='user' && is_verify='1'";
    $res=mysqli_query($con,$sql);
    
?>

<div class="container-fluid">
	<div class="row">
       
        <div class="col-md-12 well" style="margin-top:20px">
          
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
                                   
                                    <a href="config.php?Udelete=<?php echo $uid;?>" class="btn btn-danger btn-xs" >Delete</a>
                                    <a href="config.php?Urealse=<?php echo $uid;?>" class="btn btn-danger btn-xs" >Realse</a></td>
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