
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
                    <h1 class="mt-4">Danh sách sản phẩm</h1>
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
                                        <th>Tên</th>
                                        <th>Ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Nhà cung cấp</th>
                                        <th>Tình trạng</th>
                                        <th>Ngày sản xuất</th>
                                        <th>Ngày hết hạn</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    $query = "SELECT a.*,b.tennhacungcap 
                                    FROM sanpham as a,nhacungcap as b
                                     WHERE a.nhacungcap_id = b.id 
                                     ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDel = "exampleModalDel".$arUser["id"] ;
                                        $idModelEdit = "exampleModalEdit".$arUser["id"];
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td> <img style="width: 300px !important;height: 200px !important;" src="./image/<?php echo $arUser['anh'] ?>"></td>
                                        <td><?php echo $arUser["soluong"] ?></td>
                                        <td><?php echo $arUser["tennhacungcap"] ?></td>
                                        <td><?php echo $arUser["tinhtrang"] ?> </td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaysanxuat"])) ?> </td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngayhethan"])) ?> </td>
                                        <td style="width : 140px !important">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelEdit ?>">
                                                Sửa
                                            </button>
                                            <?php if($_SESSION['quyen'] == 1){ ?>
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
                                                            Sản phẩm : <?php echo $arUser["ten"] ?>
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-danger" name="deletema"> Xóa</button>

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
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhật</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data" >
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <div class="col">
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Nhà cung cấp:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="dmma" required>
                                                                    
                                                                    <?php
                                                                     $lspud = mysqli_query($connect, "SELECT * FROM nhacungcap");
                                                                     while ($arLspud = mysqli_fetch_array($lspud, MYSQLI_ASSOC)) {
                                                                     if($arLspud['id'] == $arUser["nhacungcap_id"]){   
                                                                    ?>
                                                                    <option value="<?php echo $arLspud['id'] ?>" selected ><?php echo $arLspud['tennhacungcap'] ?></option>
                                                                    <?php } else{ ?>
                                                                        <option value="<?php echo $arLspud['id'] ?>" ><?php echo $arLspud['tennhacungcap'] ?></option>
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ảnh:</label>
                                                                <input type="hidden" name="size" value="1000000"> 
                                                                <input type="file" class="form-control" name="image" />
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Tên sản phẩm:</label>
                                                                <input type="text" class="form-control" id="category-film" value="<?php echo $arUser["ten"] ?>" name="ten" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Tình trạng:</label>
                                                                <select class="form-select" aria-label="Default select example" name="tinhtrang" required>
                                                                <?php if($arUser["tinhtrang"] == "Hoạt động"){ ?>
                                                                    <option value="Hoạt động" selected>Hoạt động</option>
                                                                    <option value="Tạm dừng">Tạm dừng</option>
                                                                    <?php }else{?>
                                                                        <option value="Hoạt động" >Hoạt động</option>
                                                                    <option value="Tạm dừng" selected>Tạm dừng</option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày sản xuất:</label>
                                                                <input type="date" class="form-control" id="category-film" value="<?php echo $arUser["ngaysanxuat"] ?>" name="nsx" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày hết hạn:</label>
                                                                <input type="date" class="form-control" id="category-film" value="<?php echo $arUser["ngayhethan"] ?>" name="nhh" required>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="editma">Lưu</button>
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
                                        <div class="modal-dialog modal-lg">
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
                                                                class="col-form-label">Nhà cung cấp:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="dmma" required>
                                                                    <option value="" selected>Chọn nhà cung cấp</option>
                                                                    <?php
                                                                     $lsp = mysqli_query($connect, "SELECT * FROM nhacungcap");
                                                                     while ($arLsp = mysqli_fetch_array($lsp, MYSQLI_ASSOC)) {
                                                                    ?>
                                                                    <option value="<?php echo $arLsp['id'] ?>" ><?php echo $arLsp['tennhacungcap'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ảnh:</label>
                                                                <input type="hidden" name="size" value="1000000"> 
                                                                <input type="file" class="form-control" name="image" required/>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Tên sản phẩm:</label>
                                                                <input type="text" class="form-control" id="category-film" name="ten" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Tình trạng:</label>
                                                                <select class="form-select" aria-label="Default select example" name="tinhtrang" required>
                                                                    <option value="" selected>Chọn tình trạng</option>
                                                                    <option value="Hoạt động">Hoạt động</option>
                                                                    <option value="Tạm dừng">Tạm dừng</option>
                                                                </select>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày sản xuất:</label>
                                                                <input type="date" class="form-control" id="category-film" name="nsx" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày hết hạn:</label>
                                                                <input type="date" class="form-control" id="category-film" name="nhh" required>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="addma">Lưu</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>