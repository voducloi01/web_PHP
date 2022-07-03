<?php
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}else {
		$id = '';
	}
     $sql_chitiet = mysqli_query($mysqli , "SELECT * FROM `tbl_sanpham` WHERE sanpham_id = '$id'") ;
 ?>


<div class="services-breadcrumb">
    <div class="agile_inner_breadcrumb">
        <div class="container">
            <ul class="w3_short">
                <li>
                    <a href="index.php">Trang Chủ</a>
                    <i>|</i>
                </li>
                <li>Chi Tiết Sản Phẩm</li>
            </ul>
        </div>
    </div>
</div>
<?php 
	 while($row_chitiet = mysqli_fetch_array($sql_chitiet)){
	?>
<div class="banner-bootom-w3-agileits py-5">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
            <span> Chi Tiết Sản Phẩm</span>
        </h3>
        <!-- //tittle heading -->
        <div class="row">
            <div class="col-lg-5 col-md-8 single-right-left ">
                <div class="grid images_3_of_2">
                    <div class="flexslider">
                        <ul class="slides">
                            <li data-thumb="images/si1.jpg">
                                <div class="thumb-image">
                                    <img src="images/<?php echo $row_chitiet['sanpham_image'] ?>" data-imagezoom="true"
                                        class="img-fluid" alt="">
                                </div>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 single-right-left simpleCart_shelfItem">
                <h3 class="mb-3"><?php echo $row_chitiet['sanpham_name'] ?></h3>
                <p class="mb-3">
                    <span class="item_price"><?php echo number_format($row_chitiet['sanpham_giakhuyenmai'])?></span>
                    <del class="mx-2 font-weight-light"><?php echo number_format($row_chitiet['sanpham_gia']) ?></del>
                    <label>Miễn Phí Vận Chuyển</label>
                </p>

                <div class="product-single-w3l">
                    <h3>Thông Tin Sản Phẩm</h3> <br>
                    <p><?php echo $row_chitiet['sanpham_chitiet'] ?> </p> <br> <br>
                    <p> <?php echo $row_chitiet['sanpham_mota'] ?> </p>
                </div>
                <div class="occasion-cart">
                    <div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
                        <form action="?quanly=giohang" method="POST">
                            <fieldset>
                                <input type="hidden" name="tensanpham"
                                    value="<?php echo $row_chitiet['sanpham_name'] ?>" />
                                <input type="hidden" name="sanpham_id"
                                    value="<?php echo $row_chitiet['sanpham_id'] ?>" />
                                <input type="hidden" name="giasanpham"
                                    value="<?php echo $row_chitiet['sanpham_giakhuyenmai'] ?>" />
                                <input type="hidden" name="hinhanh"
                                    value="<?php echo $row_chitiet['sanpham_image'] ?>" />
                                <input type="hidden" name="soluong" value="1" />
                                <input type="submit" name="themgiohang" value="Thêm giỏ hàng" class="button" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- //Sing