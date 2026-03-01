<?php
require_once 'connect.php';

class User
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new myDatabase();
        $this->conn = $this->db->conn;
    }

    public function register($hoTen, $email, $password, $confirmPassword, $sdt, $diachi, $agree)
    {
        if (!empty($hoTen) && !empty($email) && !empty($sdt) && !empty($password) && !empty($confirmPassword)) {
            // Kiểm tra các trường bắt buộc
            $email_check_query = "SELECT * FROM taikhoan WHERE email='$email' LIMIT 1";
            $result = $this->conn->query($email_check_query);
            $user = $result->fetch_assoc();
            // Kiểm tra email đã tồn tại chưa
            if ($user) { // Nếu email đã tồn tại
                echo '<script lang="javascript">
                                alert("Email đã được sử dụng. Vui lòng sử dụng email khác.");
                            </script>';
            } elseif ($password !== $confirmPassword) {
                echo '<script lang="javascript">
                                alert("Mật khẩu và xác nhận mật khẩu không khớp.");
                            </script>';
            } elseif (!$agree) {
                echo '<script lang="javascript">
                                alert("Bạn phải đồng ý với các chính sách và điều khoản.");
                            </script>';
            } else {
                // Lưu thông tin vào bảng nguoidung
                $nguoidung_query = "INSERT INTO nguoidung (ten, email, sdt, diaChi) VALUES ('$hoTen', '$email', '$sdt', '$diachi')";
                if ($this->conn->query($nguoidung_query) === TRUE) {
                    $maNguoiDung = $this->conn->insert_id;

                    // Lưu thông tin vào bảng taikhoan
                    $pass_md5 = md5($password);
                    $taikhoan_query = "INSERT INTO taikhoan (email, password, maNguoiDung) VALUES ('$email', '$pass_md5', '$maNguoiDung')";
                    if ($this->conn->query($taikhoan_query) === TRUE) {
                        // Lưu thông tin vào bảng khachhang
                        $khachhang_query = "INSERT INTO khachhang (maNguoiDung) VALUES ('$maNguoiDung')";
                        if ($this->conn->query($khachhang_query) === TRUE) {
                            echo '<script lang="javascript">
                                    alert("Đăng ký thành công!"); 
                                    window.location.href = "index.php?login";
                                </script>';
                        } else {
                            echo '<script>alert("Lỗi: ' . $this->conn->error . '");</script>';
                        }
                    } else {
                        echo '<script lang="javascript">
                                alert("Lỗi: " . $taikhoan_query . "<br>" . $this->conn->error);
                            </script>';
                    }
                } else {
                    echo '<script lang="javascript">
                                alert("Lỗi: " . $nguoidung_query . "<br>" . $this->conn->error);
                            </script>';
                }
            }
        } else {
            echo '<script lang="javascript">
                                alert("Vui lòng nhập đầy đủ thông tin");
                            </script>';
        }
    }

    public function __destruct()
    {
        $this->db->close();
    }
}

// Mã hóa mật khẩu
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);
