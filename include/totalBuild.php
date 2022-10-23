<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$sqli_cate = mysqli_query($mysqli, "SELECT * FROM tbl_category,tbl_sanpham where tbl_category.category_id = tbl_sanpham.category_id AND tbl_sanpham.category_id = '$id'  ORDER BY tbl_sanpham.sanpham_id DESC");

?>
<div class="ads-grid py-sm-5 py-4">
    <div class="container py-xl-4 py-lg-2">
        <!-- tittle heading -->
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"> Sản Phẩm </h3>
        <!-- //tittle heading -->
        <div class="row">
            <!-- product left -->
            <div class="agileinfo-ads-display col-lg-9">
                <div class="wrapper">
                    <!-- first section -->
                    <div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
                        <div class="row">
                            <?php while ($row_cate = mysqli_fetch_array($sqli_cate)) {

                            ?>
                            <div class="col-md-4 product-men mt-5">
                                <div class="men-pro-item simpleCart_shelfItem">
                                    <div class="men-thumb-item text-center">
                                        <img style="width:205px;    height: 155px;"
                                            src="images/<?php echo $row_cate['sanpham_image'] ?>" alt="">
                                        <div class="men-cart-pro">
                                            <div class="inner-men-cart-pro">
                                                <a href="?quanly=chitietsanpham&id=<?php echo $row_cate['sanpham_id'] ?>"
                                                    class="link-product-add-cart">Xem sản phẩm</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-info-product text-center border-top mt-4">
                                        <h4 class="pt-1">
                                            <a
                                                href="?quanly=chitietsanpham&id=<?php echo $row_cate['sanpham_id']  ?>"><?php echo $row_cate['sanpham_name'] ?></a>
                                        </h4>
                                        <div class="info-product-price my-2">
                                            <span
                                                class="item_price"><?php echo number_format($row_cate['sanpham_giakhuyenmai']) . 'VNĐ' ?>
                                            </span> <br>
                                            <del><?php echo number_format($row_cate['sanpham_gia']) . 'VNĐ' ?></del>
                                        </div>
                                        <div
                                            class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">

                                            <form action="?quanly=buildPc" method="POST">
                                                <fieldset>
                                                    <input type="hidden" name="tensanpham"
                                                        value="<?php echo $row_cate['sanpham_name'] ?>" />
                                                    <input type="hidden" name="sanpham_id"
                                                        value="<?php echo $row_cate['sanpham_id'] ?>" />
                                                    <input type="hidden" name="giasanpham"
                                                        value="<?php echo $row_cate['sanpham_giakhuyenmai'] ?>" />
                                                    <input type="hidden" name="hinhanh"
                                                        value="<?php echo $row_cate['sanpham_image'] ?>" />
                                                    <input type="hidden" name="soluong" value="1" />
                                                    <input type="submit" name="build" value="Thêm giỏ hàng"
                                                        class="button" />
                                                </fieldset>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
                <div class="side-bar p-sm-4 p-3">
                    <div class="search-hotel border-bottom py-2">
                        <h3 class="agileits-sear-head mb-3">Tìm Kiếm</h3>
                        <form action="#" method="post">
                            <input type="search" placeholder="Sản Phẩm" name="search" required="">
                            <input type="submit" value=" ">
                        </form>
                    </div>
                    <!-- price -->
                    <div class="range border-bottom py-2">
                        <h3 class="agileits-sear-head mb-3">Giá tiền</h3>
                        <div class="w3l-range">
                            <ul>
                                <li>
                                    <a href="#">Dưới 1 triệu</a>
                                </li>

                            </ul>
                        </div>
                    </div>

                    <div class="customer-rev border-bottom left-side py-2">
                        <h3 class="agileits-sear-head mb-3">Khách hàng Review</h3>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span>5.0</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- //reviews -->
                    <!-- electronics -->
                    <div class="left-side border-bottom py-2">


                        <div class="f-grid py-2">
                            <h3 class="agileits-sear-head mb-3">Sản Phẩm Bán Chạy</h3>
                            <div class="box-scroll">
                                <div class="scroll">
                                    <?php
                                    $sqli_sanpham_slidebar = mysqli_query($mysqli, "SELECT * FROM `tbl_sanpham` WHERE sanpham_hot='0' ORDER BY sanpham_id DESC");
                                    while ($row_sanpham_slidebar = mysqli_fetch_array($sqli_sanpham_slidebar)) {
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-2 col-3 left-mar">
                                            <img src="images/<?php echo $row_sanpham_slidebar['sanpham_image'] ?>"
                                                alt="" class="img-fluid">
                                        </div>
                                        <div class="col-lg-9 col-sm-10 col-9 w3_mvd">
                                            <a href=""><?php echo $row_sanpham_slidebar['sanpham_name'] ?>"</a>
                                            <a href=""
                                                class="price-mar mt-2"><?php echo number_format($row_sanpham_slidebar['sanpham_giakhuyenmai']) . "vnd" ?></a>
                                            <del><?php echo number_format($row_sanpham_slidebar['sanpham_gia']) . "vnd" ?>
                                            </del>
                                        </div>
                                    </div>
                                    <?php }
                                    ?>

                                </div>
                            </div>
                        </div>
                        <!-- //best seller -->
                    </div>
                    <!-- //product right -->
                </div>
            </div>
        </div>
    </div>