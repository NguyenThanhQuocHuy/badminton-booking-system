<!DOCTYPE html>
<html>
<style>
	#search:hover {
		background-color: black !important;
	}

   .pagination {
      display: flex;
      justify-content: center;
      margin-top: 30px;
      margin-bottom: 20px;
   }
   .pagination a {
		text-decoration: none;
		width: 50px;
		/* Tăng chiều rộng */
		height: 50px;
		/* Tăng chiều cao */
		border: 2px solid #ccc;
		/* Thêm đường viền sáng */
		padding: 10px;
		/* Tăng không gian xung quanh chữ */
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 18px;
		/* Tăng kích thước chữ */
		border-radius: 5px;
		/* Thêm bo góc */
		margin: 5px;
		/* Khoảng cách giữa các nút */
		transition: all 0.3s ease;
		/* Thêm hiệu ứng chuyển động */
	}

	.pagination a:hover {
		background-color: black;
		/* Thêm hiệu ứng nền khi hover */
		color: white;
		/* Thay đổi màu chữ khi hover */
		transform: scale(1.1);
		/* Phóng to nút khi hover */
	}

	.pagination .active {
		background-color: black;
		/* Nền trang hiện tại */
		color: white;
		font-weight: bold;
		/* In đậm chữ */
		border-color: black;
		/* Thêm đường viền cùng màu với nền */
	}
</style>
    <?php
        if (!isset($_GET['sanpham'])) {
            $sanpham = 1;
        } else {
            $sanpham = $_GET['sanpham'];
        }
	?>
      <!-- inner page section -->
      <section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Sân cầu lông</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- product section -->
      <section class="product_section layout_padding">
      <form method="POST">
         <div class="row" style="position: relative; left: 330px; top: -40px">
            <input type="text" placeholder="Nhập loại sân muốn thuê..." name="searchInput" style="width: 800px;">
            <button style="width: 70px; height: 45px; border: 0; background-color: #f7444e; color: white" id="search"
               name="searchBtn">Tìm</button>
         </div>
      </form>
      <div class="untree_co-section product-section before-footer-section">
         <div class="container">
         <div class="row">
               <?php
               $conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");
               $search = $_GET['search'];
               $results_per_page = 4;

               // Lấy số trang hiện tại từ URL, nếu không có thì mặc định là 1
               $sanpham = isset($_GET['sanpham']) ? (int)$_GET['sanpham'] : 1;

               if ($conn) {
                  // Đếm tổng số kết quả
                  $str = "SELECT * FROM loaisan l JOIN san s ON l.maLoai = s.maLoai WHERE tenLoai like '%$search%'";
                  $result = $conn->query($str);
                  $number_of_result = mysqli_num_rows($result);

                  // Tính số trang
                  $number_of_page = ceil($number_of_result / $results_per_page);

                  // Xác định vị trí bắt đầu của kết quả trên trang hiện tại
                  $page_first_result = ($sanpham - 1) * $results_per_page;
                  if ($page_first_result < 0) $page_first_result = 0;

                  // Truy vấn có phân trang
                  $str = "SELECT * FROM loaisan l JOIN san s ON l.maLoai = s.maLoai WHERE tenLoai like '%$search%' LIMIT $page_first_result, $results_per_page";
                  $result = $conn->query($str);

                  if (mysqli_num_rows($result) > 0) {
                     echo "<h1 align='center' style ='margin-top: 5px;'>Kết quả tìm kiếm: $search</h1>";
                     // Cách dòng bằng margin-bottom
                     echo "<div class='mt-4 row'>"; // mt-4 là margin-top: 1.5rem (~24px)
                     
                     while ($row = mysqli_fetch_assoc($result)) {
                           $gia = number_format($row['giaThue'], 0, '.', '.');
                           echo "<div class='col-12 col-md-4 col-lg-3 mb-5'>
                              <a href='index.php?productdetails={$row['maSan']}'>
                                 <div class='product-item equal-height'>
                                    <img src='layout/images/{$row['hinhAnh']}' style='width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 10px;' class='img-fluid product-thumbnail'>
                                    <div class='product-content'>
                                       <h3 class='product-title'><b>Loại:</b> {$row['tenLoai']}</h3>
                                       <h4 class='product-title'><b>Số hiệu:</b> {$row['tenSan']}</h4>
                                       <h4 class='product-title'><b>Kích thước:</b> {$row['kichThuoc']}</h4>
                                       <strong class='product-price'>{$gia} VND/giờ</strong>
                                    </div>
                                    <span class='icon-cross'>
                                       <img src='layout/images/cross.svg' class='img-fluid'>
                                    </span>
                                 </div>
                              </a>
                           </div>";
                     }
                     echo "</div>"; // đóng row chứa sản phẩm
                     // Phân trang bắt đầu ở đây
                     echo "<div class='pagination'>";
                     for ($i = 1; $i <= $number_of_page; $i++) {
                        if ($i == $sanpham) {
                           echo '<a class="active" href="index.php?sanpham=' . $i . '">' . $i . '</a> ';
                        } else {
                           echo '<a href="index.php?sanpham=' . $i . '">' . $i . '</a> ';
                        }
                     }
                     echo "</div>";
                  }else {
                     echo "<h1 align='center'>Không tìm thấy</h1>";
                     echo "<script>
                     document.addEventListener('DOMContentLoaded', function() {
                        const searchInput = document.querySelector('input[name=\"searchInput\"]');
                        if (searchInput) {
                              searchInput.focus();
                        }
                     });
                  </script>";
                        }
               }
               ?>


               <!-- End Column 4 -->

            </div>
         </div>
      </div>
      </section>
      <!-- end product section -->
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
   </body>
</html>
<?php
if (isset($_POST['searchBtn'])) {
	$search = $_POST["searchInput"];
	$_SESSION['search'] = $search;
	header("Location: index.php?search=$search");
}
?>