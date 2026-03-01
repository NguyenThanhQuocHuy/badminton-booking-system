<?php
class myDatabase
{
    private $servername = "localhost";
    private $username = "huy";
    private $password = "123456";
    private $dbname = "cnmoi";
    public $conn;

    public function __construct()
    {
        // Tạo kết nối
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Kiểm tra kết nối
        if ($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }
    }

    public function query($sql)
    {
        return $this->conn->query($sql);
    }

    public function close()
    {
        $this->conn->close();
    }
}
