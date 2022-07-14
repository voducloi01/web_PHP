<?php
        if (isset($_POST['dangnhap_home'])) {
            $taikhoan = $_POST['email_login'];
            $matkhau = md5($_POST['password_login']);

            if ($taikhoan == "" || $matkhau == "") {
                echo '<p>Xin vui lòng nhập đầy đủ</p>';
            } else {

               $sql_select_khachhang = mysqli_query($mysqli, "SELECT * FROM `tbl_khachhhang` WHERE  email = '$taikhoan' AND password = '$matkhau' Limit 1");
                $cout = mysqli_num_rows($sql_select_khachhang);
                $row_dangnhap = mysqli_fetch_array($sql_select_khachhang);          
                if ($cout > 0) {
                    $_SESSION['dangnhap_home'] = $row_dangnhap['name'];
                    $_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];
                    echo '<script>alert("Đăng Nhập Thành Công!")</script>';
                     header('location: index.php?quanly=giohang');
                  
                } else {
                    echo '<script> alert("Tài khoảng hoặc mật khẩu sai!" )</script>';
                }
            }
        } elseif(isset($_POST['dangky'])){$name = $_POST['name'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$address = $_POST['address'];
			$email =  $_POST['email'];
			$password = md5( $_POST['password']);
			$note = $_POST['note'];
			$giaohang = $_POST['giaohang'];
			$sql_khachhang = mysqli_query($mysqli,"INSERT INTO `tbl_khachhhang`(`name`, `phone`, `address`, `email`, `note`, `giaohang`,`password`) VALUES ('$name','$phone','$address','$email','$note','$giaohang','$password')");
			$sql_select_khachhang = mysqli_query($mysqli,"SELECT * FROM `tbl_khachhhang` ORDER BY  khachhang_id DESC LIMIT 1");
			$sql_row_khachhang = mysqli_fetch_array($sql_select_khachhang);
			$_SESSION['dangnhap_home'] = $name;
			$_SESSION['khachhang_id'] =  $sql_row_khachhang['khachhang_id'];
            echo '<script>alert("Đăng Ký Thành Công!")</script>';
			header('location: index.php?quanly=giohang');
		}

        ?>
<!-- top-header -->
<div class="agile-main-top">
    <div class="container-fluid">
        <div class="row main-top-w3l py-2">
            <div class="col-lg-4 header-most-top">

            </div>
            <div class="col-lg-8 header-right mt-lg-0 mt-2">
                <!-- header lists -->
                <ul>

                    <?php
								if(isset($_SESSION['dangnhap_home']))
								{
						 ?>

                    <!-- <li class="text-center border-right text-white">
							<a href="index.php?quanly=xemdonhang.php"  class="text-white">
								<i class="fas fa-truck mr-2"></i>Xem đơn hàng: </a>
						</li> -->
                    <li>
                        <div class="col-10 agileits_search">
                            <form class="form-inline"
                                action="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id'] ?>"
                                method="POST">
                                <input type="submit" value="Xem đơn hàng <?php echo $_SESSION['dangnhap_home'] ?>">
                                </input>
                            </form>
                        </div>

                    </li>
                    <?php }
						?>
                    <li class="text-center border-right text-white">
                        <i class="fas fa-phone mr-2"></i> 001 234 5678
                    </li>
                    <li class="text-center border-right text-white">
                        <a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
                            <i class="fas fa-sign-in-alt mr-2"></i> Đăng Nhập </a>
                    </li>
                    <li class="text-center text-white">
                        <a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
                            <i class="fas fa-sign-out-alt mr-2"></i>Đăng Ký </a>
                    </li>


                    <li>
                        <?php
						if (isset($_SESSION['dangnhap_home'])) {
							echo ' <span style="color:#FFFFFF;font-size:15px; padding:20px" >Xin Chào:' . $_SESSION['dangnhap_home'] . '<a  href="index.php?quanly=giohang&dangxuat=1" style="color:#FFFFFF;font-size:15px;> <i style="color:#000;font-size:15px; class="fas fa-sign-out-alt mr-2"></i>  Đăng xuất</a></span>';
						}
						?>
                    </li>
                    </form>
                </ul>
                <!-- //header lists -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="text" class="form-control" placeholder=" " name="email_login" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Mật Khẩu</label>
                        <input type="password" class="form-control" placeholder=" " name="password_login" required="">
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập">
                    </div>

                    <p class="text-center dont-do mt-3"> Nếu chưa có tài khoản
                        <a href="#" data-toggle="modal" data-target="#dangky">
                            Đăng ký</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Đăng Ký</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label class="col-form-label">Tên Khách Hàng</label>
                        <input type="text" class="form-control" placeholder=" " name="name" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Số Điện Thoai</label>
                        <input type="text" class="form-control" placeholder=" " name="phone" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" placeholder=" " name="address" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Email</label>
                        <input type="email" class="form-control" placeholder=" " name="email" required="">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Password</label>
                        <input type="password" class="form-control" placeholder=" " name="password" required="">
                        <input type="hidden" class="form-control" placeholder=" " name="giaohang" value="0">

                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Ghi Chú</label>
                        <textarea class="form-control" name="note"></textarea>
                    </div>
                    <div class="right-w3l">
                        <input type="submit" class="form-control" name="dangky" value="Đăng Ký">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="header-bot">
    <div class="container">
        <div class="row header-bot_inner_wthreeinfo_header_mid">
            <!-- logo -->
            <div class="col-md-3 logo_agile">
                <h1 class="text-center">
                    <a href="index.html" class="font-weight-bold font-italic">
                        <img src="images/mk6.jpg" alt=" " width="100" hight="100" class="img-fluid">
                        <span class="ml-5">Lợi Store</span>
                    </a>

                </h1>
            </div>
            <!-- //logo -->
            <!-- header-bot -->
            <div class="col-md-9 header mt-4 mb-md-0 mb-4">
                <div class="row">
                    <!-- search -->
                    <div class="col-10 agileits_search">
                        <form class="form-inline" action="index.php?quanly=timkiem" method="POST">
                            <input class="form-control mr-sm-2" type="search" placeholder="Tìm Kiếm" aria-label="Search"
                                name="search_product" required>
                            <button class="btn my-2 my-sm-0" type="submit" name="search_button">Tìm Kiếm</button>
                        </form>
                    </div>
                    <!-- //search -->
                    <!-- cart details -->
                    <div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
                        <div class="wthreecartaits wthreecartaits2 cart cart box_1">
                            <form action="index.php?quanly=giohang" method="post" class="last">
                                <input type="hidden" name="cmd" value="_cart">
                                <input type="hidden" name="display" value="1">
                                <button class="btn w3view-cart" type="submit" name="submit" value="">
                                    <i class="fas fa-cart-arrow-down"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- //cart details -->
                </div>
            </div>
        </div>
    </div>
</div>