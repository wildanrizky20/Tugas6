<?php
class ProdukController
{
    private $produk;

    public function __construct($db)
    {
        $this->produk = new Produk($db);
    }

    public function index()
    {
        $data = $this->produk->read();
        include_once 'app/views/produk/index.php';
    }

    public function create()
    {
        if ($_POST) {
            $this->produk->nama = $_POST['nama'];
            $this->produk->harga = $_POST['harga'];
            $this->produk->stok = $_POST['stok'];

            if ($this->produk->create()) {
                header("Location: index.php?page=produk");
            }
        }
        include_once 'app/views/produk/create.php';
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $this->produk->id = $_GET['id'];
            if ($_POST) {
                $this->produk->nama = $_POST['nama'];
                $this->produk->harga = $_POST['harga'];
                $this->produk->stok = $_POST['stok'];

                if ($this->produk->update()) {
                    header("Location: index.php?page=produk");
                }
            }
            $data = $this->produk->read_single();
            include_once 'app/views/produk/edit.php';
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->produk->id = $_GET['id'];
            if ($this->produk->delete()) {
                header("Location: index.php?page=produk");
            }
        }
    }
}
