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
                <div class="card-header mt-3">
                       
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalAdd">
                                Nhập hàng
                            </button>
                        </div>
                    <h1 class="mt-4">Lịch sử nhập hàng</h1>
                    <div class="card mb-4">
                    <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Số lượng nhập</th>
                                        <th>Giá nhập</th>
                                        <th>Ngày nhập</th>
                                        <th>Người nhập</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT a.*,b.ten, b.anh, c.hoten
                                    FROM nhaphang as a,sanpham as b, nguoidung as c
                                     WHERE a.sanpham_id = b.id 
                                     AND a.nguoidung_id = c.id
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
                                        <td><?php echo number_format($arUser['gia']) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngay"])) ?> </td>
                                        <td><?php echo $arUser["hoten"] ?> </td>

                                    </tr>
                                    <?php $stt++;} ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Nhập hàng</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
                                                    <div class="col">
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="sp" required>
                                                                    <option value="" selected>Chọn sản phẩm</option>
                                                                    <?php
                                                                     $lsp = mysqli_query($connect, "SELECT * FROM sanpham WHERE tinhtrang = 'Hoạt động' ORDER BY id DESC");
                                                                     while ($arLsp = mysqli_fetch_array($lsp, MYSQLI_ASSOC)) {
                                                                    ?>
                                                                    <option value="<?php echo $arLsp['id'] ?>" ><?php echo $arLsp['ten'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Số lượng nhập:</label>
                                                                <input type="number" class="form-control" id="category-film" name="soluong" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Giá nhập:</label>
                                                                <input type="number" class="form-control" id="category-film" name="gianhap" required>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="addnh">Lưu </button>
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