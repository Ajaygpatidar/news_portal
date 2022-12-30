<?php
    include 'db_cannect.php';
    $uid=$_SESSION['uid'];
    $role=$_SESSION['role'];
    $c=$_SESSION['c_id'];
    $l=$_SESSION['l_id'];
   
   
    
    if($role=='admin')
    {
        include 'adminheader.php';
        $sql="SELECT * FROM news_detail WHERE is_verify='1' and is_delete='0'";
        $res=mysqli_query($con,$sql);
       
    }
   
    elseif($role=='editor')
    {
        include 'editorheader.php';
        $sql="SELECT * FROM news_detail WHERE  is_verify='1' and ncategory='$c' and nlocation='$l' and is_delete='0'";
         $res=mysqli_query($con,$sql);
       
    }
?>

<div class="container-fluid">
	<div class="row">
       
        <div class="col-md-12 well" style="margin-top:20px">
       
            <h2 class="text-center"> Verified News</h2>
       
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">  
                    <thead>
                        <th>Select All</th>
                        <th>heading</th>
                        <th>image</th>
                        <th>Description</th>
                        <th>date</th>
                        <th><center>Action</center></th>
                        <th>count</th>
                    </thead>
                    <tbody>
                            <?php                  
                               
                            foreach($res as $row)
                            {  
                                $uid=$row['nid'];
                                $head=$row['nheading'];
                                $h=substr($head,0,20);
                                $img=$row['nimg'];
                                $des=$row['ndescription'];
                                $d=substr($des,0,20);
                                $date=$row['date'];
                                
                                ?>
                                <tr>
                                    <td><input type="checkbox" class="checkthis"></td>
                                    
                                    <td><?php echo $h ?></td>
    
                                    <td><img src="<?php echo $img ?>" height="50px"></td>
                                    <td><?php echo $d ?></td>
                                    <td><?php echo $date?></td>
                                    <td>
                                        <a href="config.php?Nedit=<?php echo $uid;?>" type="submit"  class="btn btn-success "  data-toggle="modal"><span class="fa fa-pencil-square-o" aria-hidden="true"></span></a>
                                        <a href="config.php?Ndelete=<?php echo $uid;?>" class="btn btn-danger " ><span class="fa fa-trash" aria-hidden="true"></span></a>
                                        <a href="config.php?Nview=<?php echo $uid;?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="config.php?Enonverifynews=<?php echo $uid;?>" class="btn btn-success">Block</a>
                                        
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