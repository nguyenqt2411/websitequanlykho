
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>
<?php 
    if (isset($_GET['msg'])) {
        echo "
                    <script>
                        function Redirect() {
                        window.location = 'index.php';
                        }
                        alert('Đăng nhập thành công !') 
                        Redirect()
                    </script>
                    ";
    }
    ?>
<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
        <div id="layoutSidenav_content">
            <main>
            <?php
        $sumbd = mysqli_query($connect, "SELECT COUNT(id) as 'tongso' 
        FROM nhacungcap 
        ");
        $artinhnk = mysqli_fetch_array($sumbd);
        $sumkh = mysqli_query($connect, "SELECT COUNT(id) as 'tongso' 
        FROM sanpham 
        ");
        $artinhkh = mysqli_fetch_array($sumkh);

    ?>
                <div class="container-fluid px-4">

                <div class="row mt-4">
        <div class="col-xl-3 col-md-6">
          <div class="card bg-primary text-white mb-4">
            <div class="card-body">Số lượng nhà cung cấp : <strong> <?php echo $artinhnk['tongso'] ?></strong> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" href="nhacungcap.php">Xem chi tiết</a>
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card bg-warning text-white mb-4">
            <div class="card-body">Số lượng sản phẩm : <strong> <?php echo $artinhkh['tongso'] ?></strong> </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <a class="small text-white stretched-link" href="sanpham.php">Xem chi tiết</a>
              <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <img style="width : 1000px; margin : 0px 200px" src="https://leveler.vn/wp-content/uploads/2022/08/He-thong-quan-ly-kho-hang-WMS-scaled.jpg" />
                
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>