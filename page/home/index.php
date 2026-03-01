<!doctype html>
<html lang="en">
<style>
.post-entry {
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  transition: all 0.3s ease-in-out;
  height: 100%;
  display: flex;
  flex-direction: column;
}

.post-entry:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.12);
}

.post-thumbnail img {
  width: 100%;
  height: auto;
  border-radius: 12px;
  object-fit: cover;
}

.post-content-entry {
  padding: 20px;
  flex-grow: 1;
}

.post-content-entry h3 {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
  color: #333;
}

.post-content-entry h3 a {
  text-decoration: none;
  color: inherit;
}

.post-content-entry h3 a:hover {
  color: #0056b3;
}

.post-content-entry .meta {
  font-size: 14px;
  color: #777;
}

.post-content-entry .meta a {
  color: #333;
  font-weight: 500;
  text-decoration: none;
}

.post-content-entry .meta a:hover {
  text-decoration: underline;
}
.more {
  font-weight: 600;
  text-decoration: underline;
  color: #333;
}

.more:hover {
  color: #007bff;
  text-decoration: none;
}
</style>
<?php
if (!isset($_GET['home'])) {
	$home = 1;
} else {
	$home = $_GET['home'];
}
?>
    <!-- slider section -->
    <section class="slider_section ">
            <div class="slider_bg_box">
               <img src="layout/images/trangchu_chinh.png" alt="">
            </div>
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                 <h1>
                                    <span>
                                    🎉 Ưu Đãi 30% Mừng Đại Lễ! 
                                    </span>
                                    <br>
                                    Từ 15/04 Đến 30/05
                                 </h1>
                                 <p>
                                 Tận hưởng ưu đãi đặc biệt **giảm 30% giá thuê sân cầu lông** từ 15/04 đến 30/05 nhân dịp lễ 30/4 và 1/5. Đây là cơ hội tuyệt vời để vận động, thư giãn và kết nối cùng bạn bè!
                                 </p>
                                 <div class="btn-box">
                                    <a href="" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item ">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                 <h1>
                                    <span>
                                    Sale 20% Off
                                    </span>
                                    <br>
                                    On Everything
                                 </h1>
                                 <p>
                                    Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                                 </p>
                                 <div class="btn-box">
                                    <a href="" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container ">
                        <div class="row">
                           <div class="col-md-7 col-lg-6 ">
                              <div class="detail-box">
                                 <h1>
                                    <span>
                                    Sale 20% Off
                                    </span>
                                    <br>
                                    On Everything
                                 </h1>
                                 <p>
                                    Explicabo esse amet tempora quibusdam laudantium, laborum eaque magnam fugiat hic? Esse dicta aliquid error repudiandae earum suscipit fugiat molestias, veniam, vel architecto veritatis delectus repellat modi impedit sequi.
                                 </p>
                                 <div class="btn-box">
                                    <a href="" class="btn1">
                                    Shop Now
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container">
                  <ol class="carousel-indicators">
                     <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
                     <li data-target="#customCarousel1" data-slide-to="1"></li>
                     <li data-target="#customCarousel1" data-slide-to="2"></li>
                  </ol>
               </div>
            </div>
         </section>
         <!-- end slider section -->
      </div>
      <!-- why section -->
      <?php
      $connect = new mysqli("localhost", "huy", "123456", "cnmoi");
      $connect->set_charset("utf8");

      if ($connect->connect_error) {
         die("Kết nối thất bại: " . $connect->connect_error);
      }

      $sql = "SELECT * FROM chinhsach LIMIT 3";
      $result = $connect->query($sql);
      ?>

      <section class="product_section layout_padding">
         <div class="blog-section">
            <div class="container">
               <div class="heading_container heading_center">
                  <h2>Bài viết <span>của chúng tôi</span></h2>
               </div>
                  </div>
                  <div class="col-md-6 text-md-end text-start">
                     <a href="index.php?policy" class="more">Xem tất cả</a>
                  </div>
               </div>

               <div class="row">
                  <?php while ($row = $result->fetch_assoc()) { ?>
                  <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                     <div class="post-entry">
                        <a href="index.php?policy" class="post-thumbnail">
                           <img src="layout/images/<?php echo $row['hinhAnh']; ?>" alt="Hình ảnh" class="img-fluid" style="border-radius: 12px; height: 300px;">
                        </a>
                        <div class="post-content-entry">
                           <h3><a href="#"><?php echo $row['ten']; ?></a></h3>
                           <div class="meta">
                              <span>by <a href="#">Nguyễn Thanh Quốc Huy</a></span>
                              <span>on <a href="#"><?php echo date("d/m/Y"); ?></a></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php } ?>
               </div>
            </div>
         </div>
      </section>
      <!-- end why section -->
      
      <!-- arrival section -->
      <section class="arrival_section">
         <div class="container">
            <div class="box">
               <div class="arrival_bg_box">
                  <img src="layout/images/arrival-bg.png" alt="">
               </div>
               <div class="row">
                  <div class="col-md-6 ml-auto">
                     <div class="heading_container remove_line_bt">
                        <h2>
                           Thuê sân cầu lông dễ dàng tại đây!
                        </h2>
                     </div>
                     <p style="margin-top: 20px;margin-bottom: 30px;">
                        Đặt sân nhanh chóng, tiện lợi với mức giá hợp lý. Không còn lo thiếu sân vào giờ cao điểm – chúng tôi luôn sẵn sàng phục vụ bạn 
                        với hệ thống sân hiện đại, sạch sẽ và chuyên nghiệp!
                     </p>
                     <div class="btn-box">
                        <a href="index.php?sanpham">
                        Đặt sân
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end arrival section -->
      
      <!-- product section -->
      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Các kiểu sân cầu lông <span>của chúng tôi</span>
               </h2>
            </div>
            <div class="row">
            <?php
               $conn = mysqli_connect("localhost", "huy", "123456", "cnmoi");
               $results_per_page = 4;

               // Lấy số trang hiện tại từ URL, nếu không có thì mặc định là 1
               $sanpham = isset($_GET['sanpham']) ? (int)$_GET['sanpham'] : 1;

               if ($conn) {
                  // Đếm tổng số kết quả
                  $str = "SELECT * FROM loaisan l JOIN san s ON l.maLoai = s.maLoai";
                  $result = $conn->query($str);
                  $number_of_result = mysqli_num_rows($result);

                  // Tính số trang
                  $number_of_page = ceil($number_of_result / $results_per_page);

                  // Xác định vị trí bắt đầu của kết quả trên trang hiện tại
                  $page_first_result = ($sanpham - 1) * $results_per_page;
                  if ($page_first_result < 0) $page_first_result = 0;

                  // Truy vấn có phân trang
                  $str = "SELECT * FROM loaisan l JOIN san s ON l.maLoai = s.maLoai LIMIT $page_first_result, $results_per_page";
                  $result = $conn->query($str);

                  if (mysqli_num_rows($result) > 0) {
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
                  }
               }
               ?>
            </div>
            <div class="btn-box">
               <a href="index.php?product">
               Tất cả loại sân của chúng tôi
               </a>
            </div>
         </div>
      </section>
      <!-- end product section -->

      <!-- subscribe section -->
      <section class="subscribe_section">
         <div class="container-fuild">
            <div class="box">
               <div class="row">
                  <div class="col-md-6 offset-md-3">
                     <div class="subscribe_form ">
                        <div class="heading_container heading_center">
                           <h3>Subscribe To Get Discount Offers</h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p>
                        <form action="">
                           <input type="email" placeholder="Enter your email">
                           <button>
                           subscribe
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end subscribe section -->
      <!-- client section -->
      <section class="client_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Customer's Testimonial
               </h2>
            </div>
            <div id="carouselExample3Controls" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="layout/images/client.jpg" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>
                              Anna Trevor
                           </h5>
                           <h6>
                              Customer
                           </h6>
                           <p>
                              Dignissimos reprehenderit repellendus nobis error quibusdam? Atque animi sint unde quis reprehenderit, et, perspiciatis, debitis totam est deserunt eius officiis ipsum ducimus ad labore modi voluptatibus accusantium sapiente nam! Quaerat.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="layout/images/client.jpg" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>
                              Anna Trevor
                           </h5>
                           <h6>
                              Customer
                           </h6>
                           <p>
                              Dignissimos reprehenderit repellendus nobis error quibusdam? Atque animi sint unde quis reprehenderit, et, perspiciatis, debitis totam est deserunt eius officiis ipsum ducimus ad labore modi voluptatibus accusantium sapiente nam! Quaerat.
                           </p>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="box col-lg-10 mx-auto">
                        <div class="img_container">
                           <div class="img-box">
                              <div class="img_box-inner">
                                 <img src="layout/images/client.jpg" alt="">
                              </div>
                           </div>
                        </div>
                        <div class="detail-box">
                           <h5>
                              Anna Trevor
                           </h5>
                           <h6>
                              Customer
                           </h6>
                           <p>
                              Dignissimos reprehenderit repellendus nobis error quibusdam? Atque animi sint unde quis reprehenderit, et, perspiciatis, debitis totam est deserunt eius officiis ipsum ducimus ad labore modi voluptatibus accusantium sapiente nam! Quaerat.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="carousel_btn_box">
                  <a class="carousel-control-prev" href="#carouselExample3Controls" role="button" data-slide="prev">
                  <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
                  <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExample3Controls" role="button" data-slide="next">
                  <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                  <span class="sr-only">Next</span>
                  </a>
               </div>
            </div>
         </div>
      </section>
