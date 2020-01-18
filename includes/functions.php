<?php 

      function uploadImage($file, $uniqueName, $directory){
   $response = array();

      $file_name = $file['name'];
      $file_size =$file['size'];
      $file_tmp_path =$file['tmp_name'];
      $file_type=$file['type'];
      $file_ext=strtolower(end(explode('.',$file['name'])));
    
      $extensions= array("png", "jpg", "jpeg");
    
      if(in_array($file_ext,$extensions)=== false){
        $errors[]="Invalid file type, please choose a PNG/JPG/JPEG.";
      }
    
       
      $MB = 1048576;  // 1048576 = 1MB
      // max size 2 MB
      if($file_size > 2*$MB || $file_size == 0){
        $errors[]='Image size must be less than 2 MB';
      }

      if(empty($errors)){
      $new_name = $uniqueName.rand(100,10000).'.'.$file_ext;
      $path = $directory.$new_name;

      if(move_uploaded_file($file_tmp_path, $path)){
        $response['success'] = true;
        $response['img_saved_name'] = $new_name;
      }else{
        $response['success'] = false;
        $response['msg'] = "Error uploading file!";
      }

      
    }else{
          $response['success'] = false;
        $response['msg'] = implode(' | ',$errors);
    }

    return $response;

}

function getMaxOrderId($con){
  $sql = "SELECT MAX(order_id) FROM orders
              WHERE order_status = 1";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getMaxProductId($con){
  $sql = "SELECT MAX(id) FROM products";
    $rs = $con->query($sql);
    return $rs->fetch_row()[0];
}

function getTypeNameFromId($con, $id){
  $sql = "SELECT name FROM water_types 
  WHERE id = $id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}

function getCustomerNameFromId($con, $cus_id){
  $sql = "SELECT name FROM users 
  WHERE id = $cus_id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}

function getLaterDate($date, $period){
  return date("Y-m-d", 
    strtotime( date( "Y-m-d", 
      strtotime( $date ) ) . $period ) );

}

function getNumOfBottles($con, $id){
  $sql = "SELECT num_bottles FROM packages 
  WHERE id = $id";
  $rs = mysqli_query($con, $sql);
  return mysqli_fetch_row($rs)[0];

}
function getSubscriptionStatus($con, $id){
$rs = mysqli_query($con, "SELECT id FROM subscriptions WHERE subscriptions_status = 1");
if(mysqli_num_rows($rs) > 0){
  $rs = mysqli_query($con, "SELECT id FROM subscriptions WHERE expire_date >= NOW() AND id = $id");
    if(mysqli_num_rows($rs) > 0){
      return 'Valid';
    }else{
      return 'Expired';
}
}else{
  return 'Canceled';
}



  // if($id == 1){
  //   return 'Active';
  // }
  // if($id == 2){
  //   return 'Expired';
  // }
  // if($id == 0){
  //   return 'Canceled';
  // }
}

?>