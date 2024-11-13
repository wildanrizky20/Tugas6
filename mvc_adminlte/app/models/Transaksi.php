<?php
class Transaksi
{
    private $conn;
    private $table = "transaksi";

    public $id;
    public $pelanggan_id;
    public $tanggal;
    public $total;
    public $detail_transaksi = [];

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT t.*, p.nama as nama_pelanggan 
                FROM " . $this->table . " t
                JOIN pelanggan p ON t.pelanggan_id = p.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        try {
            $this->conn->beginTransaction();

            // Insert main transaction
            $query = "INSERT INTO " . $this->table . " 
                    (pelanggan_id, tanggal, total) 
                    VALUES (:pelanggan_id, :tanggal, :total)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":pelanggan_id", $this->pelanggan_id);
            $stmt->bindParam(":tanggal", $this->tanggal);
            $stmt->bindParam(":total", $this->total);

            $stmt->execute();
            $this->id = $this->conn->lastInsertId();

            // Insert transaction details
            foreach ($this->detail_transaksi as $detail) {
                $query = "INSERT INTO detail_transaksi 
                        (transaksi_id, produk_id, jumlah, harga, subtotal) 
                        VALUES (:transaksi_id, :produk_id, :jumlah, :harga, :subtotal)";
                $stmt = $this->conn->prepare($query);

                $stmt->bindParam(":transaksi_id", $this->id);
                $stmt->bindParam(":produk_id", $detail['produk_id']);
                $stmt->bindParam(":jumlah", $detail['jumlah']);
                $stmt->bindParam(":harga", $detail['harga']);
                $stmt->bindParam(":subtotal", $detail['subtotal']);

                $stmt->execute();

                // Update product stock
                $query = "UPDATE produk SET stok = stok - :jumlah 
                        WHERE id = :produk_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(":jumlah", $detail['jumlah']);
                $stmt->bindParam(":produk_id", $detail['produk_id']);
                $stmt->execute();
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function read_single()
    {
        $query = "SELECT t.*, p.nama as nama_pelanggan 
                FROM " . $this->table . " t
                JOIN pelanggan p ON t.pelanggan_id = p.id 
                WHERE t.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $query_detail = "SELECT d.*, p.nama as nama_produk 
                        FROM detail_transaksi d
                        JOIN produk p ON d.produk_id = p.id 
                        WHERE d.transaksi_id = :id";
        $stmt_detail = $this->conn->prepare($query_detail);
        $stmt_detail->bindParam(":id", $this->id);
        $stmt_detail->execute();

        return ['header' => $stmt, 'detail' => $stmt_detail];
    }

    public function delete()
    {
        try {
            $this->conn->beginTransaction();

            $query_detail = "DELETE FROM detail_transaksi WHERE transaksi_id = :id";
            $stmt_detail = $this->conn->prepare($query_detail);
            $stmt_detail->bindParam(":id", $this->id);
            $stmt_detail->execute();

            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $this->id);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
}
