<?php
    $uid=$_SESSION['uid'];
    $lid=$_SESSION['l_id'];
    $cid=$_SESSION['c_id'];
    $role=$_SESSION['role'];
    if($role=='admin')
    {
        $s="UPDATE notification SET A_seen='1'";
        $q=mysqli_query($con,$s);
        include 'adminheader.php';
        $sql="SELECT * from notification order by noti_id DESC ";
       
    }
    elseif($role=='reporter')
    {
        $s="UPDATE notification SET R_seen='1'";
        $q=mysqli_query($con,$s);
        include 'reporterheader.php';
        $sql="SELECT * from notification WHERE role='reporter' and post_id='$uid'  order by noti_id DESC";
        
    }
    elseif($role=='editor')
    {
        $s="UPDATE notification SET E_seen='1'";
        $q=mysqli_query($con,$s);
        include 'editorheader.php';
        $sql="SELECT * from notification WHERE role='editor' and l_id='$lid' and c_id='$cid' andpost_id='$uid'    order by noti_id DESC";
        
    }
    $res=mysqli_query($con,$sql);
?>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-12 ">
         
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">  
                    <thead>
                    <h2 class="text-center well">NOTIFICATION</h2>
                    </thead>
                    <tbody>
                   
                   
                        <?php
                            foreach($res as $row)
                            {
                                $object=$row['noti_object'];
                                $event=$row['noti_event'];
                                $n=$row['username'];
                                $un=substr($n,0,40);
                                $nuid=$row['u_id'];
                                $date=$row['date'];      
                                $role=$row['role'];
                        ?>
                        <tr>
                           
                            
                                <td><?php echo $object?> (<?php echo $un?>) <?php echo $event?> <?php echo $role?> (<?php echo $nuid?>) on <?php echo $date?> </td>
                                  
                               
                        </tr>
                       <?php } ?>
                       
                   
                  
                    </tbody>
                        
                </table>
            </div>
        </div>
      <!-- /.modal-dialog --> 
    </div>
</div>