<?php
require_once 'connect.php';

class Promotion
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new myDatabase();
        $this->conn = $this->db->conn;
    }

    // Thêm khuyến mãi
    public function addPromotion($tenKM, $noiDungChuongTrinh, $phanTramKM)
    {
        $sql = "INSERT INTO khuyenmai (tenKM, noiDungChuongTrinh, phanTramKM) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $tenKM, $noiDungChuongTrinh, $phanTramKM);
        $stmt->execute();
        $stmt->close();
        $this->resetPromotionIDs();
    }

    // Sửa khuyến mãi
    public function editPromotion($maKM, $tenKM, $noiDungChuongTrinh, $phanTramKM)
    {
        $sql = "UPDATE khuyenmai SET tenKM=?, noiDungChuongTrinh=?, phanTramKM=? WHERE maKM=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $tenKM, $noiDungChuongTrinh, $phanTramKM, $maKM);
        $stmt->execute();
        $stmt->close();
    }

    // Xóa khuyến mãi
    public function deletePromotion($maKM)
    {
        $sql = "DELETE FROM khuyenmai WHERE maKM=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $maKM);
        $stmt->execute();
        $stmt->close();
        $this->resetPromotionIDs();
    }

    // Đặt lại mã Khuyến Mãi 
    private function resetPromotionIDs()
    {
        $sql = "SET @new_id = 0";
        $this->conn->query($sql);
        $sql = "UPDATE khuyenmai SET maKM = (@new_id := @new_id + 1) ORDER BY maKM";
        $this->conn->query($sql);
        $sql = "ALTER TABLE khuyenmai AUTO_INCREMENT = 1";
        $this->conn->query($sql);
    }

    // Lấy danh sách khuyến mãi
    public function getPromotions()
    {
        $sql = "SELECT * FROM khuyenmai";
        $result = $this->conn->query($sql);
        $promotions = [];
        while ($row = $result->fetch_assoc()) {
            $promotions[] = $row;
        }
        return $promotions;
    }

    public function __destruct()
    {
        $this->db->close();
    }
}
