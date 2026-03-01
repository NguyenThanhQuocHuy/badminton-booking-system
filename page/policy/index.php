<!DOCTYPE html>
<html>
<?php
if (!isset($_GET['policy'])) {
	$policy = 1;
} else {
	$policy = $_GET['policy'];
}
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "huy"; // thay bằng tên đăng nhập thực tế
$password = "123456"; // thay bằng mật khẩu thực tế
$dbname = "cnmoi";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
	die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng chinhsach
$sql = "SELECT * FROM chinhsach";
$result = $conn->query($sql);

// Lấy mã của chính sách đầu tiên để hiển thị mặc định
$firstPolicyId = null;
if ($result->num_rows > 0) {
	$firstRow = $result->fetch_assoc();
	$firstPolicyId = $firstRow["maChinhSach"];
	$result->data_seek(0); // Đặt lại con trỏ để duyệt lại từ đầu
}
?>

<!doctype html>
<html lang="en">

<style>
	#ChinhSach {
		display: flex;
		justify-content: space-between;
		padding: 20px;
		border: 5px;
	}

	#ChinhSachMenu {
		width: 20%;
		background-color: #f7444e;
		color: #333;
		text-align: left;
		padding: 20px;
		border-radius: 8px;
		box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
		/* Đổ bóng để menu nổi bật */
	}

	#ChinhSachMenu h3 {
		font-size: 28px;
		color: #FFFFFF;
		font-weight: bold;
		margin-bottom: 20px;
		text-align: left;
	}

	#ChinhSachMenu ul {
		list-style-type: none;
		/* Bỏ dấu chấm đầu dòng */
		padding: 0;
	}

	#ChinhSachMenu ul li {
		margin-bottom: 10px;
	}

	#ChinhSachMenu ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 18px;
      font-weight: bold;
      padding: 10px 15px;
      border-radius: 6px;
      display: block;
      background-color: #f7444e;
      margin-bottom: 8px;
      transition: all 0.3s ease;
   }

	#ChinhSachMenu ul li a:hover,
   #ChinhSachMenu ul li a.active {
      background-color: #fff;
      color: #f7444e;
      transform: translateX(5px);
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
   }

	#ChinhSachND {
		width: 80%;
		background-color: #e6e6e6;
		text-align: left;
		padding: 30px;
		border-radius: 8px;
		/* Bo tròn góc */
		box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
		/* Đổ bóng nhẹ */
		color: #333;
		/* Màu chữ dễ đọc */
		line-height: 1.6;
		/* Tăng khoảng cách giữa các dòng chữ */
		padding-bottom: 50px;
		background-size: cover;
		background-blend-mode: lighten;

	}

	#ChinhSachND h1 {
		font-size: 32px;
		/* Kích thước chữ lớn cho tiêu đề */
		color: #4CAF50;
		/* Màu chữ nổi bật cho tiêu đề */
		margin-bottom: 20px;
		/* Khoảng cách dưới tiêu đề */
		text-align: left;
	}

	#ChinhSachND p {
		font-size: 18px;
		/* Kích thước chữ vừa phải cho nội dung */
		margin-bottom: 15px;
		/* Khoảng cách dưới mỗi đoạn văn */
		opacity: 0;
		animation: fadeIn 1s ease-in-out forwards;
	}

	#ChinhSachND ul {
		margin-top: 20px;
		/* Khoảng cách trên cho danh sách */
		padding-left: 20px;
		/* Thụt lề để làm rõ danh sách */
	}

	#ChinhSachND ul li {
		margin-bottom: 10px;
		/* Khoảng cách dưới mỗi mục trong danh sách */
	}

	#ChinhSachND ul li::before {
		content: "•";
		/* Thêm ký hiệu đầu dòng cho danh sách */
		color: #4CAF50;
		/* Màu xanh cho ký hiệu đầu dòng */
		font-weight: bold;
		display: inline-block;
		width: 1em;
		margin-left: -1em;
	}

	#title_ChinhSach {
		border-bottom: 1px solid gray;
		color: #f7444e;
		text-decoration: underline;
		margin-bottom: 20px;
	}

	#title_Muc {
		border-bottom: 1px solid gray;
	}
   .policy-content img {
      border-radius: 12px;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
      margin-top: 10px;
      margin-bottom: 20px;
   }

	@keyframes fadeIn {
		0% {
			opacity: 0;
			transform: translateY(10px);
		}

		100% {
			opacity: 1;
			transform: translateY(0);
		}
	}
</style>

      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Chính sách - sự kiện</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- client section -->
      <section class="client_section layout_padding">
         <div class="why-choose-section" id="ChinhSach">
            <div class="container" id="ChinhSachMenu">
               <h3>Mục lục</h3>
               <ul>
                  <?php
                  // Duyệt qua kết quả truy vấn và hiển thị danh sách chính sách với liên kết tới từng nội dung
                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        echo '<li><a href="javascript:void(0);" onclick="showPolicy(\'policy' . $row["maChinhSach"] . '\')">' . $row["ten"] . '</a></li>';
                     }
                  }
                  ?>
               </ul>
            </div>

            <div class="container" id="ChinhSachND">
               <?php
                  // Đặt lại con trỏ để đọc lại từ đầu
                  $result->data_seek(0);

                  // Hiển thị nội dung chi tiết của từng chính sách và ẩn tất cả, chỉ hiện khi được chọn
                  if ($result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                        // Lấy nội dung và xử lý dấu "●"
                        $noiDung = nl2br($row["noiDung"]); // Chuyển đổi ký tự xuống dòng thành thẻ <br>

                        // Bọc nội dung đã xử lý trong thẻ <ul> nếu có mục
                        if (strpos($noiDung, '<li>') !== false) {
                           $noiDung = '<ul>' . $noiDung . '</ul>';
                        }

                        // Kiểm tra xem có phải là chính sách đầu tiên không và thêm style hiển thị mặc định
                        $displayStyle = ($row["maChinhSach"] == $firstPolicyId) ? 'block' : 'none';

                        echo '<div class="policy-content" id="policy' . $row["maChinhSach"] . '" style="display: ' . $displayStyle . ';">';
                        echo '<header id="title_ChinhSach"><h2>' . $row["ten"] . '</h2></header>';

                        // Hiển thị hình ảnh nếu có
                        if (!empty($row["hinhAnh"])) {
                           echo '<img src="layout/images/' . htmlspecialchars($row["hinhAnh"]) . '" alt="Hình ảnh chính sách" style="max-width:100%; height:auto; margin-bottom: 15px;">';
                        }

                        echo '<p>' . $noiDung . '</p><br>'; // Hiển thị nội dung đã được định dạng
                        echo '</div>';
                     }
                  } else {
                     echo "<p>Không có chính sách nào để hiển thị.</p>";
                  }

                  // Đóng kết nối cơ sở dữ liệu
                  $conn->close();
               ?>
            </div>
         </div>




         <!-- Start Footer Section -->

         <!-- End Footer Section -->

         <script>
            function showPolicy(policyId) {
               // Ẩn tất cả nội dung
               document.querySelectorAll('.policy-content').forEach(p => p.style.display = 'none');
               // Hiện nội dung đã chọn
               document.getElementById(policyId).style.display = 'block';

               // Đặt active cho link được chọn
               document.querySelectorAll('#ChinhSachMenu ul li a').forEach(link => link.classList.remove('active'));
               const activeLink = document.querySelector(`#ChinhSachMenu ul li a[href="javascript:void(0);"][onclick*='${policyId}']`);
               if (activeLink) activeLink.classList.add('active');
            }

            // Hiện mặc định chính sách đầu
            document.addEventListener("DOMContentLoaded", function () {
               const firstPolicyId = "policy<?php echo $firstPolicyId; ?>";
               showPolicy(firstPolicyId);
            });
         </script>
      </section>
      <!-- end client section -->
      <!-- footer section -->
      <!-- footer section -->
      <!-- jQery -->
      <script src="js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
</html>