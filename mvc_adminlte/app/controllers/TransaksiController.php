<?php
class TransaksiController
{
    private $transaksi;
    private $produk;
    private $pelanggan;

    public function __construct($db)
    {
        $this->transaksi = new Transaksi($db);
        $this->produk = new Produk($db);
        $this->pelanggan = new Pelanggan($db);
    }

    public function index()
    {
        $data = $this->transaksi->read();
        include_once 'app/views/transaksi/index.php';
    }

    public function create()
    {
        if ($_POST) {
            $this->transaksi->pelanggan_id = $_POST['pelanggan_id'];
            $this->transaksi->tanggal = $_POST['tanggal'];
            $this->transaksi->total = $_POST['total'];

            // Process detail transaksi
            $produk_ids = $_POST['produk_id'];
            $jumlah = $_POST['jumlah'];
            $harga = $_POST['harga'];

            for ($i = 0; $i < count($produk_ids); $i++) {
                if ($produk_ids[$i] != '' && $jumlah[$i] > 0) {
                    $this->transaksi->detail_transaksi[] = [
                        'produk_id' => $produk_ids[$i],
                        'jumlah' => $jumlah[$i],
                        'harga' => $harga[$i],
                        'subtotal' => $jumlah[$i] * $harga[$i]
                    ];
                }
            }

            if ($this->transaksi->create()) {
                header("Location: index.php?page=transaksi");
            }
        }
        $pelanggan_data = $this->pelanggan->read();
        $produk_data = $this->produk->read();
        include_once 'app/views/transaksi/create.php';
    }

    public function view()
    {
        if (isset($_GET['id'])) {
            $this->transaksi->id = $_GET['id'];
            $data = $this->transaksi->read_single();
            include_once 'app/views/transaksi/view.php';
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->transaksi->id = $_GET['id'];
            if ($this->transaksi->delete()) {
                header("Location: index.php?page=transaksi");
            }
        }
    }
}
