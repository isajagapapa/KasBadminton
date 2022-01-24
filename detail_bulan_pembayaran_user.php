<?php
require 'connection.php';
$id_bulan_pembayaran = $_GET['id_bulan_pembayaran'];
$detail_bulan_pembayaran = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bulan_pembayaran WHERE id_bulan_pembayaran = '$id_bulan_pembayaran'"));
$siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama_siswa ASC");
$siswa_baru = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa NOT IN (SELECT id_siswa FROM uang_kas) ORDER BY nama_siswa ASC");
$uang_kas = mysqli_query($conn, "SELECT * FROM uang_kas INNER JOIN siswa ON uang_kas.id_siswa = siswa.id_siswa INNER JOIN bulan_pembayaran ON uang_kas.id_bulan_pembayaran = bulan_pembayaran.id_bulan_pembayaran WHERE uang_kas.id_bulan_pembayaran = '$id_bulan_pembayaran' ORDER BY nama_siswa ASC");

if (isset($_POST['btnEditPembayaranUangKas'])) {
    if (editPembayaranUangKas($_POST) > 0) {
        setAlert("Pembayaran has been changed", "Successfully changed", "success");
        header("Location: detail_bulan_pembayaran.php?id_bulan_pembayaran=$id_bulan_pembayaran");
    }
}

if (isset($_POST['btnTambahSiswa'])) {
    if (tambahSiswaUangKas($_POST) > 0) {
        setAlert("Siswa has been added", "Successfully added", "success");
        header("Location: detail_bulan_pembayaran.php?id_bulan_pembayaran=$id_bulan_pembayaran");
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'include/css.php'; ?>
    <title>Detail Bulan Pembayaran : <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?> <?= $detail_bulan_pembayaran['tahun']; ?></title>
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
                            <h1 class="m-0 text-dark">Detail Bulan Pembayaran : <?= ucwords($detail_bulan_pembayaran['nama_bulan']); ?> <?= $detail_bulan_pembayaran['tahun']; ?></h1>
                            <h4>Rp. <?= number_format($detail_bulan_pembayaran['pembayaran_perminggu']); ?> / minggu</h4>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid bg-white p-3 rounded">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered" id="table_id">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Anggota</th>
                                    <th>Minggu ke 1</th>
                                    <th>Minggu ke 2</th>
                                    <th>Minggu ke 3</th>
                                    <th>Minggu ke 4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($uang_kas as $duk) : ?>

                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= ucwords(htmlspecialchars_decode($duk['nama_siswa'])); ?></td>
                                        <?php if ($duk['minggu_ke_1'] == $duk['pembayaran_perminggu']) : ?>
                                            <td>
                                                <button type="button" class="badge badge-success" style="border: none;">
                                                    <i class="fas fa-fw fa-check"></i> <?= number_format($duk['minggu_ke_1']); ?>
                                                </button>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <button type="button" class="badge badge-danger" style="border: none;">
                                                    <i></i> <?= number_format($duk['minggu_ke_1']); ?>
                                                </button>
                                            </td>
                                        <?php endif ?>

                                        <?php if ($duk['minggu_ke_2'] == $duk['pembayaran_perminggu']) : ?>
                                            <td>
                                                <button type="button" class="badge badge-success" style="border: none;">
                                                    <i class="fas fa-fw fa-check"></i> <?= number_format($duk['minggu_ke_2']); ?>
                                                </button>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <button type="button" class="badge badge-danger" style="border: none;">
                                                    <i></i> <?= number_format($duk['minggu_ke_2']); ?>
                                                </button>
                                            </td>
                                        <?php endif ?>

                                        <?php if ($duk['minggu_ke_3'] == $duk['pembayaran_perminggu']) : ?>
                                            <td>
                                                <button type="button" class="badge badge-success" style="border: none;">
                                                    <i class="fas fa-fw fa-check"></i> <?= number_format($duk['minggu_ke_3']); ?>
                                                </button>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <button type="button" class="badge badge-danger" style="border: none;">
                                                    <i></i> <?= number_format($duk['minggu_ke_3']); ?>
                                                </button>
                                            </td>
                                        <?php endif ?>

                                        <?php if ($duk['minggu_ke_4'] == $duk['pembayaran_perminggu']) : ?>
                                            <td>
                                                <button type="button" class="badge badge-success" style="border: none;">
                                                    <i class="fas fa-fw fa-check"></i> <?= number_format($duk['minggu_ke_4']); ?>
                                                </button>
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <button type="button" class="badge badge-danger" style="border: none;">
                                                    <i></i> <?= number_format($duk['minggu_ke_4']); ?>
                                                </button>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; By<a href="https://www.instagram.com/isajagapapa/" target="_blank">By is aja gapapa</a></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

    </div>
</body>

</html>