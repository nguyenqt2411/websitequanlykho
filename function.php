<?php
include('inc/connect.php');
$idnd = $_SESSION['id'];
//Sản phẩm
if(isset($_POST['addma'])){
    $ten = $_POST['ten'];
    $tinhtrang = $_POST['tinhtrang'];
    $nsx = $_POST['nsx'];
    $nhh = $_POST['nhh'];
    $dmma  = $_POST['dmma'];
    //Upload ảnh
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_parts =explode('.',$_FILES['image']['name']);
    $file_ext=strtolower(end($file_parts));
    $expensions= array("jpeg","jpg","png");
    $image = $_FILES['image']['name'];
    $target = "./image/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $query = "INSERT INTO sanpham ( ten, anh, soluong, nhacungcap_id, tinhtrang, ngaysanxuat, ngayhethan) 
    VALUES ( '{$ten}', '{$image}', 0, '{$dmma}', '{$tinhtrang}', '{$nsx}', '{$nhh}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: sanpham.php?msg=1");
    } 
    else {
        header("Location: sanpham.php?msg=2");
    }
}
if(isset($_POST['editma'])){
    $ten = $_POST['ten'];
    $tinhtrang = $_POST['tinhtrang'];
    $nsx = $_POST['nsx'];
    $nhh = $_POST['nhh'];
    $dmma  = $_POST['dmma'];
    $id  = $_POST['id'];
    //Upload ảnh
    $file_name = $_FILES['image']['name'];
    if(empty($file_name)){
        $query = "UPDATE `sanpham` 
        SET `ten`='{$ten}',`nhacungcap_id`='{$dmma}',`tinhtrang`='{$tinhtrang}',`ngaysanxuat`='{$nsx}', `ngayhethan`='{$nhh}'
        WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
          header("Location: sanpham.php?msg=1");
        } 
        else {
            header("Location: sanpham.php?msg=2");
        }
    }
    else{
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_parts =explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($file_parts));
        $expensions= array("jpeg","jpg","png");
        $image = $_FILES['image']['name'];
        $target = "./image/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $query = "UPDATE `sanpham` 
        SET `ten`='{$ten}',`nhacungcap_id`='{$dmma}',`tinhtrang`='{$tinhtrang}',`ngaysanxuat`='{$nsx}', `ngayhethan`='{$nhh}', `anh`='{$image}'
        WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        if ($result) {
          header("Location: sanpham.php?msg=1");
        } 
        else {
            header("Location: sanpham.php?msg=2");
        }
    }
    
}
if(isset($_POST['deletema'])){
    $id  = $_POST['id'];
    $check = "SELECT * FROM nhaphang WHERE sanpham_id = '{$id}'
    UNION ALL
    SELECT * FROM xuathang WHERE sanpham_id = '{$id}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if($row > 0)
    {
        header("Location: sanpham.php?msg=2");
    }
    else
    {
        $query = "DELETE FROM sanpham WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        header("Location: sanpham.php?msg=1");
    }
    
}
//Nhà cung cấp
if(isset($_POST['adddm'])){
    $tennhacungcap = $_POST['tennhacungcap'];
    $query = "INSERT INTO nhacungcap (tennhacungcap) 
    VALUES ( '{$tennhacungcap}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: nhacungcap.php?msg=1");
    } 
    else {
        header("Location: nhacungcap.php?msg=2");
    }
}
if(isset($_POST['editdm'])){
    $tennhacungcap = $_POST['tennhacungcap'];
    $id  = $_POST['id'];
    $query = "UPDATE `nhacungcap` 
        SET `tennhacungcap`='{$tennhacungcap}'
        WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: nhacungcap.php?msg=1");
    } 
    else {
        header("Location: nhacungcap.php?msg=2");
    }
}
if(isset($_POST['deletedm'])){
    $id  = $_POST['id'];
    $check = "SELECT * FROM sanpham WHERE nhacungcap_id = '{$id}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if($row > 0)
    {
        header("Location: nhacungcap.php?msg=2");
    }
    else
    {
        $query = "DELETE FROM nhacungcap WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        header("Location: nhacungcap.php?msg=1");
    }
}
//Nhập hàng
if(isset($_POST['addnh'])){
    $sp = $_POST['sp'];
    $gianhap = $_POST['gianhap'];
    $soluong = $_POST['soluong'];
    $query = "INSERT INTO nhaphang (sanpham_id, soluong, gia, nguoidung_id) 
    VALUES ( '{$sp}', '{$soluong}', '{$gianhap}', '{$idnd}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
        $update = "UPDATE `sanpham` 
        SET `soluong`= soluong + '{$soluong}'
        WHERE `id`='{$sp}'";
        $resultud = mysqli_query($connect, $update);
      header("Location: nhaphang.php?msg=1");
    } 
    else {
        header("Location: nhaphang.php?msg=2");
    }
}
//Xuất hàng
if(isset($_POST['addxh'])){
    $sp = $_POST['sp'];
    $giaxuat = $_POST['giaxuat'];
    $soluong = $_POST['soluong'];
    $querylm = mysqli_query($connect, "SELECT * FROM sanpham WHERE `id`='{$sp}'");
    $row = mysqli_fetch_array($querylm);
    $slsp = $row['soluong'];
    if($soluong < $slsp){
        $query = "INSERT INTO xuathang (sanpham_id, soluong, gia, nguoidung_id) 
        VALUES ( '{$sp}', '{$soluong}', '{$giaxuat}', '{$idnd}') ";
        $result = mysqli_query($connect, $query);
        if ($result) {
            $update = "UPDATE `sanpham` 
            SET `soluong`= soluong - '{$soluong}'
            WHERE `id`='{$sp}'";
            $resultud = mysqli_query($connect, $update);
          header("Location: xuathang.php?msg=1");
        } 
        else {
            header("Location: xuathang.php?msg=2");
        }
    }
    else{
        header("Location: xuathang.php?msg=2");
    }
    
}

//Người dùng
if(isset($_POST['addnv'])){
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $matkhau  = $_POST['matkhau'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $quyen = $_POST['quyen'];
    $query = "INSERT INTO nguoidung ( hoten, email, matkhau, sodienthoai, ngaysinh, gioitinh, diachi, quyen_id) 
    VALUES ( '{$hoten}', '{$email}', '{$matkhau}', '{$sdt}', '{$ngaysinh}', '{$gioitinh}', '{$diachi}', '{$quyen}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: nguoidung.php?msg=1");
    } 
    else {
        header("Location: nguoidung.php?msg=2");
    }
}
if(isset($_POST['editnv'])){
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $matkhau  = $_POST['matkhau'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $quyen = $_POST['quyen'];
    $id  = $_POST['id'];
    $query = "UPDATE `nguoidung` 
    SET `hoten`='{$hoten}',`email`='{$email}',`sodienthoai`='{$sdt}',`gioitinh`='{$gioitinh}',`ngaysinh`='{$ngaysinh}', `diachi`='{$diachi}', `matkhau`='{$matkhau}', `quyen_id`='{$quyen}'
    WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: nguoidung.php?msg=1");
    } 
    else {
        header("Location: nguoidung.php?msg=2");
    }
}
if(isset($_POST['edittt'])){
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $matkhau  = $_POST['matkhau'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $quyen = $_POST['quyen'];
    $id  = $_POST['id'];
    $query = "UPDATE `nguoidung` 
    SET `hoten`='{$hoten}',`email`='{$email}',`sodienthoai`='{$sdt}',`gioitinh`='{$gioitinh}',`ngaysinh`='{$ngaysinh}', `diachi`='{$diachi}', `matkhau`='{$matkhau}', `quyen_id`='{$quyen}'
    WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: thongtin.php?msg=1");
    } 
    else {
        header("Location: thongtin.php?msg=2");
    }
}
if(isset($_POST['deletenv'])){
    $id  = $_POST['id'];
    $check = "SELECT * FROM nhaphang WHERE nguoidung_id = '{$id}'
    UNION ALL
    SELECT * FROM xuathang WHERE nguoidung_id = '{$id}'";
    $excute = mysqli_query($connect, $check);
    $row = mysqli_num_rows($excute);
    if($row > 0)
    {
        header("Location: nguoidung.php?msg=2");
    }
    else
    {
        $query = "DELETE FROM nguoidung WHERE `id`='{$id}'";
        $result = mysqli_query($connect, $query);
        header("Location: nguoidung.php?msg=1");
    }
}
?>
 