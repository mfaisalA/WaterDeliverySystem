<?php require_once 'includes/header.php'; ?>
<?php 
    $edit = null;
    $edit_id = null;
    if($_GET['edit_id']){
        $edit_id = $_GET['edit_id'];
        $selSql = "SELECT * FROM subscriptions 
        WHERE id = $edit_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: subscriptions.php?success=false&msg=Requested record not found !');
    }

 ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
        <div class="row">
            <ol class="breadcrumb top-bar-margin">
                <li><a href="subscriptions.php"><span class="glyphicon glyphicon-list-alt"></span> </a></li>
                <li class="active">Manage Subscriptions</li>
            </ol>
        </div><!--/.row-->
        <br>
        <div class="panel panel-info">
        <div class="panel-heading">
            <h3><span class="glyphicon glyphicon-list-alt"></span> Subscription Details</h3>
            <div id="errorDiv" class="col-sm-8 col-sm-offset-2">
    <?php
                if(isset($_GET['success'])){
                    if($_GET['success'] == 1){
                        echo '
                            <div class="alert alert-success text-center">'.$_GET['msg'].'
            </div>';
                    }else{
                        echo '
            <div class="alert alert-danger text-center">'.$_GET['msg'].'
            </div>';
                    } 
                }
                 ?>
      </div>
      <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <br>
            <div class="col-sm-8"  style="padding: 10px; border-right: 1px solid #ccc;border-bottom: 1px solid #ccc">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Subscription Info</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $package_id = $edit['package_id'];
                            $rsPack = mysqli_query($con, "SELECT * FROM packages WHERE id = $package_id");
                            $packageInfo = mysqli_fetch_assoc($rsPack);
                         ?>

                        <tr>
                            <th style="width: 25%">
                             Package    
                            </th>
                            <td>
                                <?=$packageInfo['num_bottles']?> Number of Bottles <small>(per week)</small>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Water Type    
                            </th>
                            <td>
                                <?=getTypeNameFromId($con,$packageInfo['type_id'])?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Duration    
                            </th>
                            <td>
                                <?=ucwords($edit['duration'])?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Start Date    
                            </th>
                            <td>
                                <?=date('D, d M Y', strtotime($edit['start_date']))?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Expiry Date    
                            </th>
                            <td>
                                <?=date('D, d M Y', strtotime($edit['expire_date']))?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Total Price   
                            </th>
                            <td>
                                <?=$edit['total'] ?> BD
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Status    
                            </th>
                            <td>
                                <?=getSubscriptionStatus($con, $edit['id'])?>
                            </td>
                        </tr>

                        
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="2">Delivery Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                             Customer Name    
                            </th>
                            <td>
                                <?= $edit['user_name']?>
                            </td>
                        </tr>


                        <tr>
                            <th>
                             Contact    
                            </th>
                            <td>
                                <?=$edit['user_contact']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Delivery Address    
                            </th>
                            <td>
                                <?=$edit['user_address']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Weekly Delivery Schedule    
                            </th>
                            <td>
                                <table class="table table-bordered">
                                <thead>
                                    <tr><th>Sun</th><th><?php echo $edit['sun'] ?></th><th>Mon</th><th><?php echo $edit['mon'] ?></th><th>Tue</th><th><?php echo $edit['tue'] ?></th><th>Wed</th><th><?php echo $edit['wed'] ?></th></tr>
                                    <tr><th>Thu</th><th><?php echo $edit['thu'] ?></th><th>Fri</th><th><?php echo $edit['fri'] ?></th><th>Sat</th><th><?php echo $edit['sat'] ?></th></tr>
                                </thead>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Delivery Time    
                            </th>
                            <td>
                                <?=$edit['delivery_time']?>
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
                
                
                <br>
            </div>
        </div>
      </div>    
                                
    </div>  <!--/.main-->

    <?php require_once 'includes/import_scripts.php'; ?>
    <script>
        $(document).ready(function(){
            $('#navSubscriptions').addClass('active');
        });
    </script>
</body>

</html>
