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
                    <h1 class="mt-4">Danh sách sản phẩm gần hết hạn</h1>
                    <div class="card mb-4">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT a.*,b.tennhacungcap 
                                    FROM sanpham as a,nhacungcap as b
                                     WHERE a.nhacungcap_id = b.id 
									AND CURDATE() <= a.ngayhethan
                                     AND DATEDIFF(a.ngayhethan, CURDATE()) <= 15
                                     ORDER BY a.ngayhethan ASC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDel = "exampleModalDel" . $arUser["id"];
                                        $idModelEdit = "exampleModalEdit" . $arUser["id"];
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
                                        </tr>
                                    <?php $stt++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php') ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>