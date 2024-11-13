<?php include 'app/views/layout/header.php'; ?>
<?php
$header = $data['header']->fetch(PDO::FETCH_ASSOC);
$details = $data['detail'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaksi Page</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Transaksi ke <?php echo $header['id']; ?></h3>

            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informasi Transaksi</h5>
                        <p>Tanggal: <?php echo date('d/m/Y', strtotime($header['tanggal'])); ?></p>
                        <p>Pelanggan: <?php echo $header['nama_pelanggan']; ?></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h5>Total Transaksi</h5>
                        <h3>Rp <?php echo number_format($header['total'], 0, ',', '.'); ?></h3>
                    </div>
                </div>

                <h5>Detail Produk</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($detail = $details->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo $detail['nama_produk']; ?></td>
                                <td>Rp <?php echo number_format($detail['harga'], 0, ',', '.'); ?></td>
                                <td><?php echo $detail['jumlah']; ?></td>
                                <td>Rp <?php echo number_format($detail['subtotal'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <a href="index.php?page=transaksi" class="btn btn-secondary mt-4">Kembali</a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include 'app/views/layout/footer.php'; ?>