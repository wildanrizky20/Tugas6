<?php include 'app/views/layout/header.php'; ?>

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
                <h3 class="card-title">Tambah Transaksi</h3>

                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <form method="POST" id="transaksiForm" class="col-md-9">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="pelanggan_id" class="form-label">Pelanggan</label>
                            <select class="form-select" name="pelanggan_id" required>
                                <option value="">Pilih Pelanggan</option>
                                <?php while ($pelanggan = $pelanggan_data->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?php echo $pelanggan['id']; ?>">
                                        <?php echo $pelanggan['nama']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <h4>Detail Produk</h4>
                        <div id="produkContainer">
                            <div class="row mb-2 produk-row">
                                <div class="col-md-4">
                                    <select class="form-select produk-select" name="produk_id[]" required>
                                        <option value="">Pilih Produk</option>
                                        <?php
                                        $produk_array = [];
                                        while ($produk = $produk_data->fetch(PDO::FETCH_ASSOC)) {
                                            $produk_array[] = $produk;
                                            echo '<option value="' . $produk['id'] . '" data-harga="' . $produk['harga'] . '" data-stok="' . $produk['stok'] . '">' . $produk['nama'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control jumlah" name="jumlah[]" min="1" placeholder="Jumlah" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control harga" name="harga[]" readonly>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" class="form-control subtotal" readonly>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger btn-remove">X</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" id="addProduk">Tambah Produk</button>
                    </div>

                    <div class="mb-3">
                        <h4>Total: <span id="totalTransaksi">0</span></h4>
                        <input type="hidden" name="total" id="totalInput">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=transaksi" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('produkContainer');
        const addButton = document.getElementById('addProduk');
        const totalSpan = document.getElementById('totalTransaksi');
        const totalInput = document.getElementById('totalInput');
        const produkTemplate = container.querySelector('.produk-row').cloneNode(true);

        // Add new product row
        addButton.addEventListener('click', function() {
            const newRow = produkTemplate.cloneNode(true);
            setupRow(newRow);
            container.appendChild(newRow);
        });

        // Setup initial row
        setupRow(container.querySelector('.produk-row'));

        function setupRow(row) {
            const select = row.querySelector('.produk-select');
            const jumlah = row.querySelector('.jumlah');
            const harga = row.querySelector('.harga');
            const subtotal = row.querySelector('.subtotal');
            const removeBtn = row.querySelector('.btn-remove');

            select.addEventListener('change', function() {
                const option = this.options[this.selectedIndex];
                harga.value = option.dataset.harga || '';
                calculateSubtotal();
            });

            jumlah.addEventListener('input', calculateSubtotal);

            removeBtn.addEventListener('click', function() {
                if (container.children.length > 1) {
                    row.remove();
                    calculateTotal();
                }
            });

            function calculateSubtotal() {
                const qty = parseFloat(jumlah.value) || 0;
                const price = parseFloat(harga.value) || 0;
                subtotal.value = qty * price;
                calculateTotal();
            }
        }

        function calculateTotal() {
            let total = 0;
            container.querySelectorAll('.subtotal').forEach(function(el) {
                total += parseFloat(el.value) || 0;
            });
            totalSpan.textContent = total.toLocaleString('id-ID');
            totalInput.value = total;
        }
    });
</script>

<?php include 'app/views/layout/footer.php'; ?>