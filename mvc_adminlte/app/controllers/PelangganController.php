<?php
class PelangganController
{
    private $pelanggan;

    public function __construct($db)
    {
        $this->pelanggan = new Pelanggan($db);
    }

    public function index()
    {
        $data = $this->pelanggan->read();
        include_once 'app/views/pelanggan/index.php';
    }

    public function create()
    {
        if ($_POST) {
            $this->pelanggan->nama = $_POST['nama'];
            $this->pelanggan->alamat = $_POST['alamat'];
            $this->pelanggan->telepon = $_POST['telepon'];

            if ($this->pelanggan->create()) {
                header("Location: index.php?page=pelanggan");
            }
        }
        include_once 'app/views/pelanggan/create.php';
    }

    public function edit()
    {
        if (isset($_GET['id'])) {
            $this->pelanggan->id = $_GET['id'];
            if ($_POST) {
                $this->pelanggan->nama = $_POST['nama'];
                $this->pelanggan->alamat = $_POST['alamat'];
                $this->pelanggan->telepon = $_POST['telepon'];

                if ($this->pelanggan->update()) {
                    header("Location: index.php?page=pelanggan");
                }
            }
            $data = $this->pelanggan->read_single();
            include_once 'app/views/pelanggan/edit.php';
        }
    }

    public function delete()
    {
        if (isset($_GET['id'])) {
            $this->pelanggan->id = $_GET['id'];
            if ($this->pelanggan->delete()) {
                header("Location: index.php?page=pelanggan");
            }
        }
    }
}
