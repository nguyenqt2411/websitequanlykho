<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>

<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Danh sách người dùng</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php } else { ?>
                                <div class="alert alert-danger">
                                <strong>Không thể xóa !</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalAdd">
                                Thêm mới
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Mật khẩu</th>
                                        <th>Số điện thoại</th>
                                        <th>Giới tính</th>
                                        <th>Ngày sinh</th>
                                        <th>Địa chỉ</th>
                                        <th>Vai trò</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT a.*, b.ten
                                    FROM nguoidung as a, quyen as b
                                    WHERE a.quyen_id = b.id
                                    ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDel = "exampleModalDel".$arUser["id"] ;
                                        $idModelEdit = "exampleModalEdit".$arUser["id"];
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["hoten"] ?></td>
                                        <td><?php echo $arUser["email"] ?> </td>
                                        <td><?php echo $arUser["matkhau"] ?> </td>
                                        <td><?php echo $arUser["sodienthoai"] ?></td>
                                        <td><?php echo $arUser["gioitinh"] ?> </td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaysinh"])) ?></td>
                                        <td><?php echo $arUser["diachi"] ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td style="width : 130px !important">
                                        <?php if($arUser["quyen_id"] == 2) {?>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelEdit ?>">
                                                Sửa
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDel ?>">
                                                Xóa
                                            </button>
                                            <?php } ?>
                                            <!--Dele-->
                                            <div class="modal fade" id="<?php echo $idModelDel ?>" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Nhân viên : <?php echo $arUser["hoten"] ?>
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-danger" name="deletenv"> Xóa</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Dele-->
                                        </td>

                                    </tr>
                                    <!-- Modal Update-->
                                    <div class="modal fade" id="<?php echo $idModelEdit ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhập</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
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
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Địa chỉ:</label>
                                                                <input type="text" class="form-control" id="category-film" name="diachi" value="<?php echo $arUser["diachi"] ?>" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Vai trò:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="quyen" required>
                                                                    
                                                                    <?php
                                                                     $lspud = mysqli_query($connect, "SELECT * FROM quyen");
                                                                     while ($arLspud = mysqli_fetch_array($lspud, MYSQLI_ASSOC)) {
                                                                     if($arLspud['id'] == $arUser["quyen_id"]){   
                                                                    ?>
                                                                    <option value="<?php echo $arLspud['id'] ?>" selected ><?php echo $arLspud['ten'] ?></option>
                                                                    <?php } else{ ?>
                                                                        <option value="<?php echo $arLspud['id'] ?>" ><?php echo $arLspud['ten'] ?></option>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="editnv">Lưu</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    <?php $stt++;} ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
                                                    <div class="col">
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Họ tên:</label>
                                                                <input type="text" class="form-control" id="category-film" name="hoten" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Email:</label>
                                                                <input type="email" class="form-control" id="category-film" name="email" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Mật khẩu:</label>
                                                                <input type="text" class="form-control" id="category-film" name="matkhau" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Số điện thoại:</label>
                                                                <input type="text" class="form-control" id="category-film" name="sdt" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Giới tính:</label>
                                                                <select class="form-select" aria-label="Default select example" name="gioitinh" required>
                                                                    <option value="" selected>Chọn giới tính</option>
                                                                    <option value="Nam">Nam</option>
                                                                    <option value="Nữ">Nữ</option>
                                                                </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày sinh:</label>
                                                                <input type="date" class="form-control" id="category-film" name="ngaysinh" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Địa chỉ:</label>
                                                                <input type="text" class="form-control" id="category-film" name="diachi" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Vai trò:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="quyen" required>
                                                                    <option value="" selected>Chọn vai trò</option>
                                                                    <?php
                                                                     $lsp = mysqli_query($connect, "SELECT * FROM quyen");
                                                                     while ($arLsp = mysqli_fetch_array($lsp, MYSQLI_ASSOC)) {
                                                                    ?>
                                                                    <option value="<?php echo $arLsp['id'] ?>" ><?php echo $arLsp['ten'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="addnv">Lưu</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
    <script>
    CKEDITOR.replace("editor");
    </script>
    <script>
for (var i = 1; i < 200; i++) {
    var name = "editor" + i
    CKEDITOR.replace(name);

}

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>