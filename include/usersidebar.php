<?php
$jml_pengeluaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(jumlah_pengeluaran) as jml_pengeluaran FROM pengeluaran"));
$jml_pengeluaran = $jml_pengeluaran['jml_pengeluaran'];

$jml_uang_kas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as jml_uang_kas FROM uang_kas"));
$jml_uang_kas = $jml_uang_kas['jml_uang_kas'];
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <!-- <img src="assets/img/img_properties/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <i class='fas fa-shuttlecock fa-9x' style='color:#ffffff'></i>
        <span class="brand-text font-weight-light">UANG KAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <div class="bg-success nav-link text-white">
                        <i class="nav-icon fas fa-money-bill-wave"></i>
                        <p>
                            Sisa Uang: <?= number_format($jml_uang_kas - $jml_pengeluaran); ?>
                        </p>
                    </div>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="index.php" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="uang_kas_user.php" class="nav-link">
                        <i class="fas fa-dollar-sign nav-icon"></i>
                        <p>Uang Kas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pengeluaran_user.php" class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Pengeluaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Tentang Pembuat</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>