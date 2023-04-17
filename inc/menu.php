<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">

                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Bảng điều khiển
                </a>
                <a class="nav-link" href="nhacungcap.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                    Nhà cung cấp
                </a>
                <a class="nav-link" href="sanpham.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Sản phẩm
                </a>
                <a class="nav-link" href="nhaphang.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-download"></i></div>
                    Nhập hàng
                </a>
                <a class="nav-link" href="xuathang.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                    Xuất hàng
                </a>
                <?php if ($_SESSION['quyen'] == 1) { ?>
                    <a class="nav-link" href="nguoidung.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Người dùng
                    </a>
                <?php } ?>
            </div>
        </div>
    </nav>
</div>