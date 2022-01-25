<?php
require 'connection.php';
$pengeluaran = mysqli_query($conn, "SELECT * FROM pengeluaran INNER JOIN user ON pengeluaran.id_user = user.id_user");

if (isset($_POST['btnAddPengeluaran'])) {
    if (addPengeluaran($_POST) > 0) {
        setAlert("Pengeluaran has been added", "Successfully added", "success");
        header("Location: pengeluaran.php");
    }
}

if (isset($_POST['btnEditPengeluaran'])) {
    if (editPengeluaran($_POST) > 0) {
        setAlert("Pengeluaran has been changed", "Successfully changed", "success");
        header("Location: pengeluaran.php");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'include/css.php'; ?>
    <title>Pengeluaran</title>
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
                    <div class="row mb-2">
                        <div class="col-sm">
                            <h1 class="m-0 text-dark">Pengeluaran</h1>
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="table_id">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Username</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Pengeluaran</th>
                                            <th>Jumlah Pengeluaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($pengeluaran as $dp) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $dp['username']; ?></td>
                                                <td><?= $dp['keterangan']; ?></td>
                                                <td><?= date("d-m-Y, H:i:s", $dp['tanggal_pengeluaran']); ?></td>
                                                <td>Rp. <?= number_format($dp['jumlah_pengeluaran']); ?></td>                                                
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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