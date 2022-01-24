<?php
require 'connection.php';
$bulan_pembayaran = mysqli_query($conn, "SELECT * FROM bulan_pembayaran ORDER BY tahun ASC");
if (isset($_POST['btnAddBulanPembayaran'])) {
    if (addBulanPembayaran($_POST) > 0) {
        setAlert("Bulan Pembayaran has been added", "Successfully added", "success");
        header("Location: uang_kas.php");
    }
}

if (isset($_POST['btnEditBulanPembayaran'])) {
    if (editBulanPembayaran($_POST) > 0) {
        setAlert("Bulan Pembayaran has been changed", "Successfully changed", "success");
        header("Location: uang_kas.php");
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'include/css.php'; ?>
    <title>Uang Kas</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include 'include/usernavbar.php'; ?>

        <?php include 'include/usersidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row justify-content-center mb-2">
                        <div class="col-sm">
                            <h1 class="m-0 text-dark">Uang Kas</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg text-left">
                            <h5>Pilih Bulan Pembayaran</h5>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($bulan_pembayaran as $dbp) : ?>
                            <?php
                            $id_bulan_pembayaran = $dbp['id_bulan_pembayaran'];
                            $total_uang_kas_bulan_ini = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sum(minggu_ke_1 + minggu_ke_2 + minggu_ke_3 + minggu_ke_4) as total_uang_kas_bulan_ini FROM uang_kas WHERE id_bulan_pembayaran = '$id_bulan_pembayaran'"));
                            $total_uang_kas_bulan_ini = $total_uang_kas_bulan_ini['total_uang_kas_bulan_ini'];
                            ?>
                            <div class="col-lg-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h5><a href="detail_bulan_pembayaran.php?id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>" class="text-dark"><?= ucwords($dbp['nama_bulan']); ?></a></h5>
                                        <h6 class="text-muted"><?= $dbp['tahun']; ?></h6>
                                        <h6>Rp. <?= number_format($dbp['pembayaran_perminggu']); ?> / minggu</h6>
                                        <h6>Total Uang Kas Bulan Ini: <span class="my-2 btn btn-success">Rp. <?= number_format($total_uang_kas_bulan_ini); ?></span></h6>
                                        <a href="detail_bulan_pembayaran_user.php?id_bulan_pembayaran=<?= $dbp['id_bulan_pembayaran']; ?>" class="btn btn-info"><i class="fas fa-fw fa-align-justify"></i></a>
                                        <!-- <button type="button" data-toggle="modal" data-target="#editBulanPembayaranModal<?= $dbp['id_bulan_pembayaran']; ?>" class="btn btn-success"><i class="fas fa-fw fa-edit"></i></button> -->
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; By<a href="https://www.instagram.com/isajagapapa/" target="_blank"> is aja gapapa</a></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

    </div>
</body>

</html>