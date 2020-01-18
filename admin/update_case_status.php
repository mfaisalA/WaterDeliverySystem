<?php require_once 'includes/header.php'; ?>
<?php 
    $edit = null;
    $edit_id = null;
    if($_GET['edit_id']){
        $edit_id = $_GET['edit_id'];
        $selSql = "SELECT * FROM cases 
        WHERE id = $edit_id";
        $rs = mysqli_query($con, $selSql);
        $edit = mysqli_fetch_assoc($rs);
    }else{
        header('location: cases_inprocess_list.php?success=false&msg=Requested record not found !');
    }

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    if($post){
        extract($post);
        $valid = false;
        $msg = "Something went wrong unable to process your request!";
        $judgeId = $_SESSION['admin_id'];
        $status = 0;

        $sql = "UPDATE cases 
        SET case_status = $case_status, next_hearing_date = '$next_hearing_date', judge_remarks = '$judge_remarks'
        WHERE id = $case_id ";
        if(mysqli_query($con, $sql)){
            $valid = true;
            $msg = "Status updated successfully";
        }

        header('location: cases_inprocess_list.php?success='.$valid.'&msg='.$msg);
    }
 ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">   
        <div class="row">
            <ol class="breadcrumb top-bar-margin">
                <li><a href="pen_appointments.php"><span class="glyphicon glyphicon-list-alt"></span> </a></li>
                <li class="active">Require Approval</li>
            </ol>
        </div><!--/.row-->
        <br>
        <div class="panel panel-success">
        <div class="panel-heading">
            <h3><span class="glyphicon glyphicon-list-alt"></span> Case Details</h3>
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
                            <th colspan="2">Plaintiff Info</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php                         
                            $plaintiff_cpr = $edit['plaintiff_cpr'];
                            $plainSql = "SELECT * FROM citizens 
                            WHERE passport = $plaintiff_cpr";
                            $rs = mysqli_query($con, $plainSql);
                            $plaintiffInfo = mysqli_fetch_assoc($rs);
                         ?>

                        <tr>
                            <th style="width: 25%">
                             C.P.R    
                            </th>
                            <td>
                                <?=$edit['plaintiff_cpr']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Full Name    
                            </th>
                            <td>
                                <?=$plaintiffInfo['firstname'].' '.$plaintiffInfo['lastname']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Email    
                            </th>
                            <td>
                                <?=$plaintiffInfo['email']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Contact    
                            </th>
                            <td>
                                <?=$plaintiffInfo['contact']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Address    
                            </th>
                            <td>
                                <?=$plaintiffInfo['address']?>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="2">Defendant Info</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php                         
                            $defendant_cpr = $edit['defendant_cpr'];
                            $defSql = "SELECT * FROM citizens 
                            WHERE passport = $defendant_cpr";
                            $rs = mysqli_query($con, $defSql);
                            $defendantInfo = mysqli_fetch_assoc($rs);
                         ?>

                        <tr>
                            <th style="width: 25%">
                             C.P.R    
                            </th>
                            <td>
                                <?=$edit['defendant_cpr']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Full Name    
                            </th>
                            <td>
                                <?=$defendantInfo['firstname'].' '.$defendantInfo['lastname']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Email    
                            </th>
                            <td>
                                <?=$defendantInfo['email']?>
                            </td>
                        </tr>

                        <tr>
                            <th>
                             Contact    
                            </th>
                            <td>
                                <?=$defendantInfo['contact']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Address    
                            </th>
                            <td>
                                <?=$defendantInfo['address']?>
                            </td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr>
                            <th colspan="2">Case Info</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                             Required Service    
                            </th>
                            <td>
                                <?=getServiceNameFromId($con,$edit['case_type'])?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Registeration Date   
                            </th>
                            <td>
                                <?=date('d-M-y', strtotime($edit['created_at']))?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Case Summary   
                            </th>
                            <td>
                                <?=$edit['case_summary']?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Attachments
                            </th>
                            <td>
                                <a href="uploads/<?=$edit['attachment_link'] ?>" class="btn btn-default btn-xs">view file</a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Next Hearing Date   
                            </th>
                            <td>
                                <?=($edit['next_hearing_date'] != NULL)? date('d-M-y', strtotime($edit['next_hearing_date'])) : 'No date given yet'?>
                            </td>
                        </tr>
                        <tr>
                            <th>
                             Judge's Remarks   
                            </th>
                            <td>
                                <?=(!empty($edit['judge_remarks']))? $edit['judge_remarks'] : 'No remarks given yet'?>
                            </td>
                        </tr>
                       

                        <tr>
                            <th>Case Status</th>
                            <td>
                                <?=getCaseStatusFromId($edit['case_status'])?>
                            </td>
                        </tr>
                    </tbody>

                <?php 
                    $userType = $_SESSION['user_type'];
                    if($userType == 'judge'){?>
                    <thead>
                        <tr>
                            <th colspan="2">Judge's Decision/Remarks</th>
                        </tr>
                    </thead>
                    <tbody>

                    <form action="" method="post">
                        <tr>
                            <th>Next Hearing Date </th>
                            <td>
                               <input type="date" class="form-control" name="next_hearing_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d',strtotime($edit['next_hearing_date'])) ?>" >
                            </td>
                        </tr>
                        <tr>
                            <th>Update Status</th>
                            <td>
                                <select name="case_status" class="form-control" required>
                                    <option <?php echo ($edit['case_status'] == 2) ? 'selected' : '' ?> value="2">Accepted By Judge</option>
                                    <option <?php echo ($edit['case_status'] == 3) ? 'selected' : '' ?>  value="3">Rejected By Judge</option>
                                    <option <?php echo ($edit['case_status'] == 4) ? 'selected' : '' ?>  value="4">Documnets Required</option>
                                    <option <?php echo ($edit['case_status'] == 5) ? 'selected' : '' ?>  value="5">Waiting For Next Hearing</option>
                                    <option <?php echo ($edit['case_status'] == 6) ? 'selected' : '' ?>  value="6">Case Closed</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Judge's Remarks</th>
                            <td>
                                <textarea name="judge_remarks" class="form-control" cols="30" rows="10"><?php echo $edit['judge_remarks'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="pull-right">
                                <input type="hidden" name="case_id" value="<?php echo $edit['id'];  ?>">
                                <input name="update_btn" type="submit" value="Update" class="btn btn-warning"/>
                            </td>
                        </tr>
                </form>
                    </tbody>
                </table>
            <?php } ?>
                
                <br>
            </div>
        </div>
      </div>    
                                
    </div>  <!--/.main-->

    <?php require_once 'includes/import_scripts.php'; ?>
    <script>
        $(document).ready(function(){
            $('#navInProcess').addClass('active');
        });
    </script>
</body>

</html>
