<?php

require_once 'app/config/Database.php';
require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/ProdukController.php';
require_once 'app/controllers/PelangganController.php';
require_once 'app/controllers/TransaksiController.php';
require_once 'app/models/Produk.php';
require_once 'app/models/Pelanggan.php';
require_once 'app/models/Transaksi.php';

$database = new Database();
$db = $database->getConnection();

$page = isset($_GET['page']) ? $_GET['page'] : 'beranda';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch($page) {
    case 'beranda':
        $controller = new HomeController($db);
        break;
    case 'produk':
        $controller = new ProdukController($db);
        break;
    case 'pelanggan':
        $controller = new PelangganController($db);
        break;
    case 'transaksi':
        $controller = new TransaksiController($db);
        break;
    default:
        $controller = new HomeController($db);
}

$controller->$action();

?>