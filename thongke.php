<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('inc/head.php') ?>
</head>

<body class="sb-nav-fixed">
    <?php include('inc/header.php') ?>
    <div id="layoutSidenav">
        <?php include('inc/menu.php') ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <div class="card-header mt-5">
                        <form method="POST" action="" class="register-form" id="register-form">
                            <div class="row" style="justify-content:space-around !important">
                                <div class="col-3">
                                    <input type="text" class="form-control" value="Chọn ngày muốn xem" disabled />
                                </div>
                                <div class="col-4">
                                    <input type="date" class="form-control" name="ngay" required>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-success" name="thongke">
                                        Xem
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Số lượng xuất</th>
                                        <th>Giá xuất</th>
                                        <th>Ngày xuất</th>
                                        <th>Người xuất</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_POST['thongke'])) {
                                        $ngay = $_POST['ngay'];
                                        $sum = 0;
                                        $query = "SELECT a.*,b.ten, b.anh, c.hoten
                                    FROM xuathang as a,sanpham as b, nguoidung as c
                                     WHERE a.sanpham_id = b.id 
                                     AND a.nguoidung_id = c.id
                                     AND DATE(ngay) = '{$ngay}'
                                     ORDER BY a.id DESC";
                                        $result = mysqli_query($connect, $query);
                                        $stt = 1;
                                        while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
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
                                        <?php $stt++;
                                            $sum = $sum + ($arUser["gia"] * $arUser["soluong"]);
                                        } ?>
                                        <!-- Modal Update-->
                                    <?php echo "<h4>Lịch sử xuất hàng ngày " . date("d-m-Y", strtotime($ngay)) . ". Tổng tiền xuất là: " . number_format($sum) . " VNĐ</h4>";
                                    }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php') ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>