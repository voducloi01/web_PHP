<?php
        if(isset($_GET['huydon'])&&isset($_GET['magiaodich'])){
            $huydon = $_GET['huydon'];
            $magiaodich =$_GET['magiaodich'];
        } else{
            $huydon = '';
            $magiaodich='';
        }
        $sql_update_donhang = mysqli_query($mysqli, "UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
        $sql_update_giaodich = mysqli_query($mysqli, "UPDATE tbl_donhang SET huydon='$huydon' WHERE mahang='$magiaodich'");

?>
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"> Xem đơn hàng</h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                        <div class="row">
                            <?php
                                    if(isset($_SESSION['dangnhap_home'])) 
                                    echo 'Xem Đơn Hàng' .$_SESSION['dangnhap_home'];
                            ?>
                            <div class="col-md-12">
                                <h4 style="padding: 25px;"> Liệt kê đơn hàng</h4>
                                <?php
									if(isset($_GET['khachhang'])){
										$id_khachhang = $_GET['khachhang'];
									} else {
										$id_khachhang = '';
									}
									$sql_select = mysqli_query($mysqli, "SELECT * FROM tbl_giaodich WHERE tbl_giaodich.khachhang_id ='$id_khachhang'
								ORDER BY tbl_giaodich.giaodich_id DESC") ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Số Thứ Tự</th>
                                        <th>Mã giao dịch</th>
                                        <th>Ngày Đặt</th>
                                        <th> Quản Lý</th>
                                        <th> Tình trạng</th>
                                        <th> Yêu Cầu</th>



                                    </tr>
                                    <?php
										$i = 0;
                            while ($row_donhang = mysqli_fetch_array($sql_select)) {
                                $i++;
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo  $i; ?>
                                        </td>

                                        <td> <?php echo $row_donhang['magiaodich']; ?></td>

                                        <td> <?php echo $row_donhang['ngaythang']; ?></td>
                                        <td> <a
                                                href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>">Xem
                                                Chi Tiết
                                        </td>
                                        <td>
                                            <?php
                                                    if($row_donhang['tinhtrangdon'] ==0) {
                                                        echo 'Đã đặt hàng.';
                                                    }
                                                    else {
                                                        echo 'Đã xử lí|Đang giao hàng.';
                                                    }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if($row_donhang['huydon'] ==0) {?>
                                            <a
                                                href="index.php?quanly=xemdonhang&khachhang=<?php echo $_SESSION['khachhang_id']?>&magiaodich=<?php echo $row_donhang['magiaodich'] ?>&huydon=1">
                                                Hủy Yêu Cầu</a>
                                        </td>
                                        <?php }elseif ($row_donhang['huydon'] ==1) {?>
                                        <p>Đang yêu cầu hủy ....</p>
                                        <?php }
                                        else {
                                            echo 'Đã Hủy';
                                        }?>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <h4> Chi tiết đơn hàng</h4> <br>
                                <?php
                        if(isset($_GET['magiaodich'])){
                            $magiaodich = $_GET['magiaodich'];
                        } else {
                            $magiaodich = '';
                        }
                         $sql_select = mysqli_query($mysqli, "SELECT * FROM tbl_giaodich,tbl_khachhhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id = tbl_sanpham.sanpham_id 
                        AND tbl_giaodich.khachhang_id = tbl_khachhhang.khachhang_id AND tbl_giaodich.magiaodich ='$magiaodich'  ORDER BY tbl_giaodich.giaodich_id DESC") ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <tr>
                                        <th>Số Thứ Tự</th>
                                        <th>Mã giao dịch</th>
                                        <th>Tên sản Phẩm</th>
                                        <th> Số Lượng</th>
                                        <th>Ngày Đặt</th>


                                    </tr>
                                    <?php
                            $i = 0;
                            while ($row_donhang = mysqli_fetch_array($sql_select)) {
                                $i++;
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo  $i; ?>
                                        </td>
                                        <td> <?php echo $row_donhang['magiaodich']; ?></td>
                                        <td> <?php echo $row_donhang['sanpham_name']; ?></td>
                                        <td> <?php echo $row_donhang['soluong']; ?></td>

                                        <td> <?php echo $row_donhang['ngaythang']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>