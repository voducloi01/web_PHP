<?php
include  "PHPMailer-master/src/PHPMailer.php";
include  "PHPMailer-master/src/Exception.php";
include  "PHPMailer-master/src/OAuth.php";
include  "PHPMailer-master/src/POP3.php";
include  "PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
if (isset($_POST['thanhtoandangnhap'])) {
    //  $taikhoan = $_POST['email_login'];
    $tensanpham  = $_POST['nameproduct'];
    $sl = $_POST['quantity'];
    $tongtien = $_POST['sumtotal'];
    try {

        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ducloi1244@gmail.com';
        $mail->Password = 'dedsvivegzatfknh';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        //Recipients
        $mail->setFrom('ducloi1244@gmail.com', 'Duc Loi');
        $mail->addAddress('hungphi1244@gmail.com', 'Hung Phi');
        $mail->addCC('ducloi1244@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'hoadoncuaban';
        $message = "Tên sản phẩm :" . $tensanpham . "<br>" . " Số Lượng :" . $sl . "<br>" . "Tổng tiền:" . number_format($tongtien);
        $mail->Body = $message;
        $mail->send();
        echo '<script> alert ("Gửi mail thành công!")</script>';
    } catch (Exception $e) {
        echo '<script> alert ("Gửi mail thất bại!")</script>', $mail->ErrorInfo;
    }
}
?>
<?php
if (isset($_POST['build'])) {
    $tensanpham = $_POST['tensanpham'];
    $sanpham_id = $_POST['sanpham_id'];
    $hinhanh = $_POST['hinhanh'];
    $gia = $_POST['giasanpham'];
    $soluong = $_POST['soluong'];

    $sql_select_giohang = mysqli_query($mysqli, "SELECT * FROM `buildpc` WHERE sanpham_id ='$sanpham_id'");
    $count =  mysqli_num_rows($sql_select_giohang);
    if ($count > 0) {
        $row_sanpham = mysqli_fetch_array($sql_select_giohang);
        $soluong =     $row_sanpham['soluong'] + 1;
        $sql_giohang = " UPDATE `buildpc` SET `soluong`='$soluong' WHERE sanpham_id = '$sanpham_id' ";
    } else {
        $soluong = $soluong;
        $sql_giohang = "INSERT INTO `buildpc`( `tensanpham`, `sanpham_id`, `giasanpham`, `hinhanh`, `soluong`) VALUES ('$tensanpham','$sanpham_id','$gia','	$hinhanh','	$soluong')";
    }
    $insert_row =  mysqli_query($mysqli, $sql_giohang);

    if ($insert_row == 0) {
        header('Location:index.php?quanly=chitietsanpham&id=' . $sanpham_id);
    }
} elseif (isset($_POST['capnhapsoluong'])) {

    for ($i = 0; $i < count($_POST['product_id']); $i++) {
        $sanpham_id = $_POST['product_id'][$i];
        $soluong = $_POST['soluong'][$i];
        if ($soluong <= 0) {
            $sql_delete = mysqli_query($mysqli, "DELETE FROM `buildpc`  WHERE sanpham_id= '$sanpham_id'");
        } else {

            $sql_update = mysqli_query($mysqli, "UPDATE `buildpc` SET `soluong`='$soluong' WHERE sanpham_id= '$sanpham_id'");
        }
    }
} elseif (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_delete = mysqli_query($mysqli, "DELETE FROM `buildpc`  WHERE pc_id='$id'");
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
            $sql_delete_thanhtoan = mysqli_query($mysqli, "DELETE FROM `buildpc`  WHERE sanpham_id='$sanpham_id'");
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
        $sql_delete_thanhtoan = mysqli_query($mysqli, "DELETE FROM `buildpc`  WHERE sanpham_id='$sanpham_id'");
    }
}

?>

<div class="ads-grid py-sm-5 py-4">

    <div class="container py-xl-4 py-lg-2">
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"> Build Pc</h3>
        <div class="btn-group wrap_btn">
            <?php
            $sql_category_danhmuc1 = mysqli_query($mysqli, 'SELECT * FROM `tbl_category` WHERE category_id >= 7 ');

            ?>
            <?php
            $i = 0;
            while ($row_category_danhmuc1 = mysqli_fetch_array($sql_category_danhmuc1)) {
                $i++;
            ?>
            <button type="button" class="btn btn-primary mb-4 custom_btn">
                <a class="text-white"
                    href="?quanly=totalBuild&id=<?php echo $row_category_danhmuc1['category_id'] ?>">Thêm
                    <?php echo $row_category_danhmuc1['category_name'] ?></a>
            </button>
            <?php }

            ?>

        </div>

        <div class="checkout-right">
            <?php
            $sql_lay_giohang = mysqli_query($mysqli, "SELECT * FROM `buildpc` ORDER BY pc_id DESC ")
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
                        <input type="hidden" name="quantity" value="<?php echo $row_fetch_giohang['soluong'] ?>">

                        <input type="hidden" name="nameproduct" value="<?php echo $row_fetch_giohang['tensanpham'] ?>">

                        <input type="hidden" name="total"
                            value="<?php echo $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'] ?>">

                        <input type="hidden" name="sumtotal" value="<?php echo $sumtotal ?>">

                        <input type="hidden" name="giatien"
                            value="<?php echo $row_fetch_giohang['giasanpham'] * $row_fetch_giohang['giasanpham'] ?>">
                        <?php


                            ?>
                        <tbody>
                            <tr class="rem1">
                                <td class="invert"><?php echo $i  ?></td>
                                <td class="invert-image">
                                    <a href="single.html">
                                        <img style="width:155px"
                                            src="images/<?php echo $row_fetch_giohang['hinhanh']  ?>" alt=" "
                                            class="img-responsive" height="120">
                                    </a>
                                </td>
                                <td class="invert">

                                    <input type="number" name="soluong[]"
                                        value="<?php echo $row_fetch_giohang['soluong'] ?>">
                                    <input type="hidden" name="product_id[]"
                                        value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
                                </td>
                                <td class="invert"><?php echo $row_fetch_giohang['tensanpham']  ?></td>
                                <td class="invert">
                                    <?php echo number_format($row_fetch_giohang['giasanpham']) . "vnd"    ?>
                                <td class="invert"><?php echo number_format($total) . "vnd" ?>
                                </td>
                                <td class="invert">
                                    <a href="?quanly=buildPc&xoa=<?php echo $row_fetch_giohang['pc_id'] ?>">
                                        Xóa</a>

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
                <td colspan="6"> <input type="submit" class="btn btn-success" value="Cập nhập giỏ hàng"
                        name="capnhapsoluong"></td>
                <?php
            $sql_select_giohang = mysqli_query($mysqli, "SELECT * FROM buildpc");
            $cout_giohang = mysqli_num_rows($sql_select_giohang);
            ?>
                <?php if (isset($_SESSION['dangnhap_home']) && $cout_giohang > 0) {
                while ($row_1 = mysqli_fetch_array($sql_select_giohang)) {
            ?>
                <input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
                <input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">

                <?php } ?>
                <td>

                    <input type="submit" class="btn btn-primary" value="Thanh Toán" name="thanhtoandangnhap">

                </td>

                </form>
                <?php
            } ?>
            </tr>
            </table>
        </div>

    </div>

</div>
<style>
.wrapper {
    width: 250px;
}

.wrapper_list {
    display: flex;

}

.wrap_btn {
    display: inline-block;
    text-align: center;
}


.custom_btn {
    width: 220px;
}
</style>