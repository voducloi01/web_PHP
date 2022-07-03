        <?php
        include_once('../db/connect.php');

        if (isset($_POST['themdanhmuc'])) {

            $danhmuc  = $_POST['danhmuc'];
            $sql_insert = mysqli_query($mysqli, "INSERT INTO tbl_category (`category_name`) values ('$danhmuc')");
        } elseif (isset($_POST['capnhatdanhmuc'])) {
            $id_danhmuc = $_POST['id_danhmuc'];
            $tendanhmuc  = $_POST['danhmuc'];
            $sql_capnhatdanhmuc = mysqli_query($mysqli, "UPDATE `tbl_category` SET `category_name`='$tendanhmuc' WHERE category_id = '$id_danhmuc'");
            header('location: xulydanhmuc.php');
        }
        if (isset($_GET['xoa'])) {
            $id = $_GET['xoa'];
            $sql_delete = mysqli_query($mysqli, "DELETE FROM `tbl_category` WHERE category_id = '$id'");
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Danh Mục</title>
            <link rel="stylesheet" href="../css/bootstrap.css">



        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">


                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="xulydonhang.php">Đơn hàng <span
                                class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link active" href="xulydanhmuc.php">Danh mục</a>
                        <a class="nav-item nav-link active" href="sanpham.php">Sản Phẩm</a>
                        <a class="nav-item nav-link disabled active" href="xulykhachhang.php">Khách hàng</a>
                    </div>
                </div>
            </nav>

            <br> <br>

            <div class="container">
                <div class="row">
                    <?php
                    if (isset($_GET['quanly'])) {
                        $capnhat = $_GET['quanly'];
                    } else {
                        $capnhat = "";
                    }
                    if ($capnhat == 'capnhat') {
                        $id_capnhat = $_GET['id'];
                        $sql_capnhap = mysqli_query($mysqli, "SELECT * FROM tbl_category WHERE category_id='$id_capnhat'");
                        $row_capnhap = mysqli_fetch_array($sql_capnhap);

                    ?>
                    <div class="col-md-4">
                        <h4> cập nhập Danh mục</h4>
                        <label for="">Tên danh mục </label>
                        <form action="" method="POST">
                            <input type="text" name="danhmuc" class="form-control"
                                value="<?php echo $row_capnhap['category_name'] ?>" placeholder="Tên danh mục">

                            <input type="hidden" name="id_danhmuc" class="form-control"
                                value="<?php echo $row_capnhap['category_id'] ?>" placeholder="Tên danh mục">
                            <input type="submit" name="capnhatdanhmuc" class="btn btn-success"
                                value="Cập nhập danh mục">

                        </form>
                    </div>
                    <?php
                    } else {


                    ?>
                    <div class="col-md-4">
                        <h4>Thêm Danh mục</h4>
                        <label for="">Tên danh mục </label>
                        <form action="" method="POST">
                            <input type="text" name="danhmuc" class="form-control" placeholder="Tên danh mục">
                            <input type="submit" name="themdanhmuc" class="btn btn-success" value="Thêm danh mục">

                        </form>
                    </div>
                    <?php } ?>

                    <div class="col-md-8">
                        <h4> Liệt kê danh mục</h4>
                        <?php $sql_select = mysqli_query($mysqli, "SELECT * FROM tbl_category  ORDER BY category_id DESC") ?>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Số Thứ Tự</th>
                                <th>Tên Danh Mục</th>
                                <th>Quản Lý</th>
                            </tr>
                            <?php
                            $i = 0;
                            while ($row_category = mysqli_fetch_array($sql_select)) {
                                $i++;


                            ?>
                            <tr>
                                <td>
                                    <?php echo  $i; ?>
                                </td>
                                <td> <?php echo $row_category['category_name']; ?></td>
                                <td> <a href="?xoa=<?php echo $row_category['category_id'] ?>"><button>Xóa</button></a>
                                    || <a href="?quanly=capnhat&id=<?php echo $row_category['category_id'] ?>"><button>Cập
                                            nhập</button></a> </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </body>

        </html>