<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>

<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
    <?php if(isset($_SESSION['id'])){
                $id = $_SESSION['id'];
                $query = "SELECT * FROM nguoidung WHERE id ='{$id}'";
                $result = mysqli_query($connect, $query);
                $arUser = mysqli_fetch_array($result, MYSQLI_ASSOC);
            } ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Thông tin cá nhân</h1>
                    <div class="card mb-4">
                        
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                       
                        <div class="card-body">
                        <form action="function.php" method="POST" >
                        <input type="hidden" class="form-control" id="id" name="quyen" value="<?php echo $arUser["quyen_id"] ?>">
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <div class="col">
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Họ tên:</label>
                                                                <input type="text" class="form-control" value="<?php echo $arUser["hoten"] ?>" id="category-film" name="hoten" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Email:</label>
                                                                <input type="text" class="form-control" value="<?php echo $arUser["email"] ?>" id="category-film" name="email" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Mật khẩu:</label>
                                                                <input type="text" class="form-control" id="category-film" value="<?php echo $arUser["matkhau"] ?>" name="matkhau" required>
                                                        </div>
                                                        
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Số điện thoại:</label>
                                                                <input type="text" class="form-control" id="category-film" value="<?php echo $arUser["sodienthoai"] ?>" name="sdt" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Giới tính:</label>
                                                                <select class="form-select" aria-label="Default select example" name="gioitinh" required>
                                                                    <?php if($arUser["gioitinh"] == "Nam"){ ?>
                                                                    <option value="Nam" selected>Nam</option>
                                                                    <option value="Nữ">Nữ</option>
                                                                    <?php }else{?>
                                                                        <option value="Nam" >Nam</option>
                                                                    <option value="Nữ" selected>Nữ</option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày sinh:</label>
                                                                <input type="date" class="form-control" id="category-film" name="ngaysinh" value="<?php echo $arUser["ngaysinh"] ?>" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Địa chỉ:</label>
                                                                <input type="text" class="form-control" id="category-film" name="diachi" value="<?php echo $arUser["diachi"] ?>" required>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        
                                                    
                                                    
                                                        <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="edittt">Lưu</button>
                                                </div>
                                                    </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>