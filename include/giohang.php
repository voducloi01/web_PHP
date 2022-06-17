<?php
if (isset($_POST['themgiohang'])) {
	$tensanpham = $_POST['tensanpham'];
	$sanpham_id = $_POST['sanpham_id'];
	$hinhanh = $_POST['hinhanh'];
	$gia = $_POST['giasanpham'];
	$soluong = $_POST['soluong'];

	$sql_select_giohang = mysqli_query($mysqli, "SELECT * FROM `tbl_giohang` WHERE sanpham_id ='$sanpham_id'");
	$count =  mysqli_num_rows($sql_select_giohang);
	if ($count > 0) {
		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
		$soluong = 	$row_sanpham['soluong'] + 1;
		$sql_giohang = " UPDATE `tbl_giohang` SET `soluong`='$soluong' WHERE sanpham_id = '$sanpham_id' ";
	} else {
		$soluong = $soluong;
		$sql_giohang = "INSERT INTO `tbl_giohang`( `tensanpham`, `sanpham_id`, `giasanpham`, `hinhanh`, `soluong`) VALUES ('$tensanpham','$sanpham_id','$gia','	$hinhanh','	$soluong')";
	}

	$insert_row =  mysqli_query($mysqli, 	$sql_giohang);

	if ($insert_row == 0) {
		header('Location:index.php?quanly=chitietsanpham&id=' . $sanpham_id);
	}
} elseif (isset($_POST['capnhapsoluong'])) {

	for ($i = 0; $i < count($_POST['product_id']); $i++) {
		$sanpham_id = $_POST['product_id'][$i];
		$soluong = $_POST['soluong'][$i];
		if ($soluong <= 0) {
			$sql_delete = mysqli_query($mysqli, "DELETE FROM `tbl_giohang`  WHERE sanpham_id= '$sanpham_id'");
		} else {

			$sql_update = mysqli_query($mysqli, "UPDATE `tbl_giohang` SET `soluong`='$soluong' WHERE sanpham_id= '$sanpham_id'");
		}
	}
} elseif (isset($_GET['xoa'])) {
	$id = $_GET['xoa'];
	$sql_delete = mysqli_query($mysqli, "DELETE FROM `tbl_giohang`  WHERE giohang_id='$id'");
} elseif (isset($_GET['dangxuat'])) {
	$id = $_GET['dangxuat'];
	if ($id == 1) {
		unset($_SESSION['dangnhap_home']);
	}
} elseif (isset($_POST['thanhtoan'])) {
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$email =  $_POST['email'];
	$password = md5($_POST['password']);
	$note = $_POST['note'];
	$giaohang = $_POST['giaohang'];
	$sql_khachhang = mysqli_query($mysqli, "INSERT INTO `tbl_khachhhang`(`name`, `phone`, `address`, `email`, `note`, `giaohang`,`password`) VALUES ('$name','$phone','$address','$email','$note','$giaohang','$password')");

	if ($sql_khachhang) {
		$sql_select_khachhang = mysqli_query($mysqli, "SELECT * FROM `tbl_khachhhang` ORDER BY khachhang_id DESC LIMIT 1");
		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
		$khachhang_id = $row_khachhang['khachhang_id'];
		$mahang = rand(0, 9999);
		//$_SESSION['dangnhap_home'] = $row_dangnhap['name'];
		$_SESSION['dangnhap_home'] = $row_khachhang['name'];
		$_SESSION['khachhang_id'] = $khachhang_id;
		for ($i = 0; $i < count($_POST['thanhtoan_product_id']); $i++) {

			$sanpham_id = $_POST['thanhtoan_product_id'][$i];
			$soluong = $_POST['thanhtoan_soluong'][$i];
			$sql_donhang = mysqli_query($mysqli, "INSERT INTO `tbl_donhang`(`sanpham_id`, `soluong`, `mahang`, `khachhang_id`) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
			$sql_giaodich = mysqli_query($mysqli, "INSERT INTO `tbl_giaodich`( `sanpham_id`, `soluong`, `magiaodich`,`khachhang_id`) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
			$sql_delete_thanhtoan = mysqli_query($mysqli, "DELETE FROM `tbl_giohang`  WHERE sanpham_id='$sanpham_id'");
		}
	}
} elseif (isset($_POST['thanhtoandangnhap'])) {
	$khachhang_id = $_SESSION['khachhang_id'];
	$mahang = rand(0, 9999);
	for ($i = 0; $i < count($_POST['thanhtoan_product_id']); $i++) {
		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
		$soluong = $_POST['thanhtoan_soluong'][$i];
		$sql_donhang = mysqli_query($mysqli, "INSERT INTO `tbl_donhang`(`sanpham_id`, `soluong`, `mahang`, `khachhang_id`) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
		$sql_giaodich = mysqli_query($mysqli, "INSERT INTO `tbl_giaodich`( `sanpham_id`, `soluong`, `magiaodich`,`khachhang_id`) VALUES ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
		$sql_delete_thanhtoan = mysqli_query($mysqli, "DELETE FROM `tbl_giohang`  WHERE sanpham_id='$sanpham_id'");
	}
}

?>
<?php
		if (isset($_SESSION['dangnhap_home'])) {
			echo '<p style="color:#000;font-size:30px; padding:20px" >Xin Chào Bạn:' . $_SESSION['dangnhap_home'] . '<a href="index.php?quanly=giohang&dangxuat=1">   Đăng xuất</a></p>';
		}
		?>
<div class="privacy py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<span>Thêm sản phẩm vào giỏ hàng của bạn </span>
		</h3>
		
		<!-- //tittle heading -->
		<div class="checkout-right">
			<?php
			$sql_lay_giohang = mysqli_query($mysqli, "SELECT * FROM `tbl_giohang` ORDER BY giohang_id DESC ")
			?>

			<div class="table-responsive">
				<form action="" method="POST">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Sản Phẩm</th>
								<th>Số Lượng</th>
								<th>Tên Sản Phẩm</th>
								<th>Gía</th>
								<th>Gía Tổng</th>
								<th>Quản Lý</th>
								<th></th>
							</tr>
						</thead>
						<?php
						$i = 0;
						$sumtotal = 0;
						while ($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)) {
							$total = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
							$sumtotal += $total;
							$i++;
						?>
							<tbody>
								<tr class="rem1">
									<td class="invert"><?php echo $i  ?></td>
									<td class="invert-image">
										<a href="single.html">
											<img src="images/<?php echo $row_fetch_giohang['hinhanh']  ?>" alt=" " class="img-responsive" height="120">
										</a>
									</td>
									<td class="invert">
										<input type="number" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
										<input type="hidden" name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
									</td>
									<td class="invert"><?php echo $row_fetch_giohang['tensanpham']  ?></td>
									<td class="invert"><?php echo number_format($row_fetch_giohang['giasanpham']) . "vnd"    ?>
									<td class="invert"><?php echo number_format($total) . "vnd" ?>
									</td>
									<td class="invert">
										<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>"> Xóa</a>

			</div>
			</td>
			</tr>

			</tbody>
		<?php
						}
		?>
		<tr>
			<td colspan="7">Tổng tiền :<?php echo number_format($sumtotal) . "vnd" ?> </td>
		</tr>
		<tr>
			<td colspan="6"> <input type="submit" class="btn btn-success" value="Cập nhập giỏ hàng" name="capnhapsoluong"></td>
			<?php
			$sql_select_giohang = mysqli_query($mysqli, "SELECT * FROM tbl_giohang");
			$cout_giohang = mysqli_num_rows($sql_select_giohang);
			?>
			<?php if (isset($_SESSION['dangnhap_home']) && $cout_giohang > 0) {
				while ($row_1 = mysqli_fetch_array($sql_select_giohang)) {
			?>
					<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
					<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">

				<?php } ?>
				<td><input type="submit" class="btn btn-primary" value="Thanh Toán" name="thanhtoandangnhap"></td>
			<?php
			} ?>

		</tr>
		</table>
		</form>
		</div>
	</div>
	<?php
	if (!isset($_SESSION['dangnhap_home'])) {
	?>
		<div class="checkout-left">
			<div class="address_form_agile mt-sm-5 mt-4">
				<h4 class="mb-sm-4 mb-3">Add a new Details</h4>
				<form action="" method="POST" class="creditly-card-form agileinfo_form">
					<div class="creditly-wrapper wthree, w3_agileits_wrapper">
						<div class="information-wrapper">
							<div class="first-row">
								<div class="controls form-group">
									<input class="billing-address-name form-control" type="text" name="name" placeholder="Tên" required="">
								</div>
								<div class="w3_agileits_card_number_grids">
									<div class="w3_agileits_card_number_grid_left form-group">
										<div class="controls">
											<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
										</div>
									</div>
									<div class="w3_agileits_card_number_grid_right form-group">
										<div class="controls">
											<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
										</div>
									</div>
								</div>
								<div class="controls form-group">
									<input type="text" class="form-control" placeholder="Email" name="email" required="">
								</div>
								<div class="controls form-group">
									<input type="text" class="form-control" placeholder="Password" name="password" required="" required="">
								</div>
								<textarea style="resize: none;" class="form-control" placeholder="Ghi Chú" name="note" required="">

									</textarea>
								<div class="controls form-group">
									<select class="option-w3ls" name="giaohang">
										<option>Chọn Hình Thức Thanh Toán</option>
										<option value="1">Thanh Toán Qua ATM</option>
										<option value="0">Thanh Toán Tại Nhà</option>

									</select>
								</div>
							</div>
							<?php
							$sql_lay_giohang1  = mysqli_query($mysqli, "SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
							while ($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang1)) {
							?>
								<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
								<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
							<?php
							}
							?>
							<input type="submit" class="btn btn-success" name="thanhtoan" value="Thanh Toán" style="width : 20%">
						</div>
					</div>
				</form>

			</div>
		</div>
	<?php
	}
	?>
</div>
</div>