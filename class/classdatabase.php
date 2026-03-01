<?php
class database
{
    private function connect()
    {
        $conn = new mysqli("localhost", "huy", "123456", "cnmoi");
        if ($conn->connect_errno) {
            echo "<script>Alert('Ket noi khong thanh cong')</script>";
            exit();
        } else
            return $conn;
    }
    public function xuatdulieu($sql)
    {
        $arr = array();
        $link = $this->connect();
        $result = $link->query($sql);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc())
                $arr[] = $row;
            return $arr;
        } else
            return 0;
    }
    public function xoadulieu($sql)
    {
        $link = $this->connect();
        try {
            if ($link->query($sql)) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $e) {
            // Trả về thông báo lỗi chi tiết cho người dùng
            return $e->getMessage();
        }
    }

    public function themdulieu($sql)
    {
        $link = $this->connect();
        if ($link->query($sql))
            return 1;
        else
            return 0;
    }
    public function suadulieu($sql)
    {
        $link = $this->connect();
        if ($link->query($sql))
            return 1;
        else
            return 0;
    }

    public function selectnhanvien()
    {
        $str = '';
        $sql = "SELECT roleName FROM roles"; // Giả sử bạn có bảng roles để lấy chức vụ
        $arr = $this->xuatdulieu($sql);
        foreach ($arr as $item) {
            $str .= '<option value="' . $item["roleName"] . '">' . $item["roleName"] . '</option>';
        }
        return $str;
    }
    public function selectnguoidung($value = '')
    {
        $str = '';
        $sql = "select * from nguoidung";
        $arr = $this->xuatdulieu($sql);
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]["maNguoiDung"] == $value)
                $str .= '<option selected value="' . $arr[$i]["maNguoiDung"] . '">' . $arr[$i]["maNguoiDung"] . '</option>';
            else
                $str .= '<option value="' . $arr[$i]["maNguoiDung"] . '">' . $arr[$i]["maNguoiDung"] . '</option>';
        }
        return $str;
    }
    public function layMaNguoiDungMoiNhat()
    {
        $link = $this->connect();
        $result = $link->query("SELECT MAX(maNguoiDung) AS maNguoiDungMoi FROM nguoidung");
        $row = $result->fetch_assoc();
        return $row['maNguoiDungMoi'] ?? null;
    }
    public function layRoleMoiNhat()
    {
        $sql = "SELECT roleId FROM roles ORDER BY roleId DESC LIMIT 1";
        $result = $this->xuatdulieu($sql);
        return $result ? $result[0]['roleId'] : null;
    }

}
?>