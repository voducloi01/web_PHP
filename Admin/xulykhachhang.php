<?php
        include_once('../db/connect.php');

      

        if(isset($_GET['xoadonhang'])){
            $mahang = $_GET['xoadonhang'];
            $sql_delete_donhang = mysqli_query($mysqli, "DELETE FROM tbl_donhang WHERE mahang='$mahang'");
            header('location: xulydanhmuc.php');
        }

        ?>
        <?php
        if(isset($_POST['capnhatdonhang'])){
            $xuly = $_POST['xuly'];
            $mahang_xuly = $_POST['mahang_xuly'];
            $sql_update_donhang = mysqli_query($mysqli, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE mahang='$mahang_xuly'");

        } 
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Khách Hàng</title>
            <link rel="stylesheet" href="../css/bootstrap.css">

          
            
        </head>

        <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

 
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
    <a class="nav-item nav-link active" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link active" href="xulydanhmuc.php">Danh mục</a>
      <a class="nav-item nav-link active" href="sanpham.php">Sản Phẩm</a>
      <a class="nav-item nav-link disabled active" href="xulykhachhang.php">Khách hàng</a>
    </div>
  </div>
</nav>
              
<br> <br>
            
            <div class="container">              
                <div class="row">    
                    <div class="col-md-12">
                        <h4> Khách Hàng</h4>
                        <?php $sql_select = mysqli_query($mysqli, "SELECT * FROM tbl_khachhhang,tbl_giaodich WHERE tbl_khachhhang.khachhang_id=tbl_giaodich.khachhang_id GROUP BY tbl_giaodich.magiaodich ORDER BY tbl_khachhhang.khachhang_id DESC") ?>
                    
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Số Thứ Tự</th>        
                                <th>Tên Khách Hàng</th>
                                <th>Số Điện Thoại</th>
                                <th>Địa chỉ</th>
                                <th>Email</th>
                                <th>Ngày Mua</th>
                                <th>Quản Lý</th>

                            </tr>
                            <?php
                            $i = 0;
                            while ($row_khachhang = mysqli_fetch_array($sql_select)) {
                                $i++;


                            ?>
                                <tr>
                                    <td>
                                        <?php echo  $i; ?>
                                    </td>    
                                
                                    <td> <?php echo $row_khachhang['name']; ?></td>

                                    <td> <?php echo $row_khachhang['phone']; ?></td>

                                    <td> <?php echo $row_khachhang['address']; ?></td>
                                    <td> <?php echo $row_khachhang['email']; ?></td>
                                    <td> <?php echo $row_khachhang['ngaythang']; ?></td>


                                    <td> <a href="?quanly=xemgiaodich&khachhang=<?php echo $row_khachhang['magiaodich'] ?>">Xem giao dịch</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h4> Liệt kê đơn hàng</h4>
                        <?php
                        if(isset($_GET['khachhang'])){
                            $magiaodich = $_GET['khachhang'];
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
                                    <td> <?php echo $row_donhang['ngaythang']; ?></td>
                               
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </body>

        </html>