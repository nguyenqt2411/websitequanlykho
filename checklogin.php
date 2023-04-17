<?php
include('inc/connect.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $upass  = $_POST['matkhau'];
    $query = "SELECT * FROM nguoidung WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {
      header("Location: login.php?fail=1");
    } 
    else {
    
      $row = mysqli_fetch_array($result);
      if ($upass != $row['matkhau']) {
        header("Location: login.php?fail=1");
      }
      else{
        header("Location: index.php?msg=1");
      $_SESSION['taikhoanadmin'] = $email;
      $_SESSION['id'] = $row['id'];
      $_SESSION['tenhienthi'] = $row['hoten'];
      $_SESSION['quyen'] = $row['quyen_id'];
      }
    }
    }
 ?> 