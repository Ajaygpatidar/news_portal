<?php
    $uid=$_SESSION['uid'];
    $role=$_SESSION['role'];
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <!-- <sc <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    ript src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> -->
    <!-- <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Mail <span class="caret"></span>
                </button>
            </div>
        </div>
       
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-3 col-md-2">
            
            <a href="#profile" class="btn btn-danger btn-sm btn-block"  role="button" data-toggle="tab"><i class="fa fa-share" aria-hidden="true"></i>  COMPOSE</a></li>
            <hr />
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-inbox" aria-hidden="true"></i><span class="badge pull-right">42</span> Inbox </a>
                </li>
                <li><a href="#messages" data-toggle="tab"><i class="fa fa-envelope" aria-hidden="true"></i> Sent mail</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-md-10">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-inbox">
                </span>Primary</a></li>
               
            </ul>
            <!-- Tab inbox message  -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                    <div class="list-group">
                     
                        <table class="table">
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">From</th>
                            <th scope="col">Message</th>
                            <th scope="col">Attachiement</th>
                            <th scope="col">date</th>
                            
                            </tr>
                            <?php
                                $uid=$_SESSION['uid'];
                                $sql="SELECT message.to_id,message.from_id,message.attachiement,message.date,message.message,user.name,user.email
                                FROM message
                                INNER JOIN user ON message.from_id = user.uid where to_id='$uid'";
                                $res=mysqli_query($con,$sql);
                                foreach($res as $row)
                                { 
                                    $n=$row['name'];
                                    $att=$row['attachiement'];
                                    $f=$row['email'];
                                    $msg=$row['message'];
                                    $d=$row['date'];
                                ?>
                                <tr>
                                <td><span class="glyphicon glyphicon-star-empty"></span> <?php echo $n ?></td>
                                <td><?php echo $f ?></td>
                                <td><?php echo $msg ?></td>
                                <td><a href="<?php echo $att?>"><img src="img/img.png" height="20" width="50px"></a></td>
                                <td><?php echo $d?></td>
                                
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
               </div>
                 <!-- COMPOSE MAIL  -->
                <div class="tab-pane fade in" id="profile">
                    <div class="list-group">
                        <div class="list-group-item">
                            <form  class=" well" action="config.php" method="post"  enctype="multipart/form-data" >
                                <div class="form-group row">
                                
                                    <label  class="col-sm-2 col-form-label">From</label>
                                   
                                    <select name="from" >
                                        <div class="col-sm-6 form-control">
                                        <?php 
                                            $sql="SELECT * FROM user where uid='$uid'";
                                            $res=mysqli_query($con,$sql);
                                            $row=mysqli_fetch_array($res);
                                        
                                            foreach($res as $row)
                                            {
                                                $e=$row['email'];
                                                $uid=$row['uid'];
                                                echo ' <option value='.$uid .'>'.$e.'</option>';
                                            } ?>
                                        </div>
                                    </select>
                                </div>
                            
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">To</label>
                                
                                    <select name="to" >
                                        <div class="col-sm-6 form-control">
                                        <?php 
                                            $sql="SELECT * FROM user";
                                            $res=mysqli_query($con,$sql);
                                            $row=mysqli_fetch_array($res);
                                        
                                            foreach($res as $row)
                                            {
                                                $e=$row['email'];
                                                $uid=$row['uid'];
                                                echo ' <option value='.$uid.'>'.$e.'</option>';
                                            } ?>
                                        </div>
                                    </select>
                            
                                </div> 

                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">Attachiemnet</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="att">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label  class="col-sm-2 col-form-label">Compose email</label>
                                    <div class="col-sm-8">
                                        <textarea  cols="40" rows="4" name="message"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn  btn-primary col-sm-offset-3" style="width:150px" name="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- sent email code here -->
                <div class="tab-pane fade in" id="messages">
                    <div class="list-group">
                        <table class="table">
                            <tr>
                            <th scope="col">To</th>
                            <th scope="col">Message</th>
                            <th scope="col">Attachiement</th>
                            <th scope="col">date</th>
                            
                            </tr>
                            <?php
                                $uid=$_SESSION['uid'];
                                $sql="SELECT message.to_id,message.from_id,message.attachiement,message.date,message.message,user.name,user.email
                                FROM message
                                INNER JOIN user ON message.to_id = user.uid where from_id='$uid'";
                                $res=mysqli_query($con,$sql);
                                foreach($res as $row)
                                { 
                                    $n=$row['name'];
                                    $att=$row['attachiement'];
                                    $f=$row['email'];
                                    $msg=$row['message'];
                                    $d=$row['date'];
                                   

                                ?>
                                <tr>
                                <td><span class="glyphicon glyphicon-star-empty"></span> <?php echo $f ?></td>
                                <td><?php echo $msg ?></td>
                                <td><a href="<?php echo $att?>"><img src="img/img.png" height="20" width="50px"></a></td>
                                <td><?php echo $d?></td>
                                
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
               
            </div>
            <!-- Ad -->
           
        </div>
    </div>
</div>

</body>
</html>

<!------ Include the above in your HEAD tag ---------->
