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
            <title>Đơn Hàng</title>
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
                    <?php
                    if (isset($_GET['quanly'])== 'xemdonhang') {
                        $mahang = $_GET['mahang'];
                        $sql_chitiet = mysqli_query($mysqli, "SELECT * FROM tbl_donhang,tbl_sanpham WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id AND tbl_donhang.mahang = '$mahang'");
                        
    
                    ?>
                 <div class="col-md-7">
                    <p> Xem chi tiết đơn hàng</p>
                   <form action="" method="POST">
                    <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Số Thứ Tự</th>      
                                <th>Mã hàng</th>           
                                <th>Tên sản phẩm</th>
                                <th>Số lượng </th>
                                <th>Gía </th>
                                <th>Tổng tiền</th>
                                <th>Ngày Đặt</th>
                               

                            </tr>
                            <?php
                            $i = 0;
                            while ($row_donhang = mysqli_fetch_array($sql_chitiet)) {
                                $i++;


                            ?>
                                <tr>
                                    <td>   <?php echo  $i; ?></td>
                                    <td> <?php echo $row_donhang['mahang']; ?></td>
                                    <td> <?php echo $row_donhang['sanpham_name']; ?></td>
                                    <td> <?php echo $row_donhang['soluong']; ?></td>
                                    <td> <?php echo number_format($row_donhang['sanpham_giakhuyenmai'])."vnd" ?></td>
                                    <td> <?php echo number_format($row_donhang['soluong']*$row_donhang['sanpham_giakhuyenmai'])."vnd"  ?></td>
                                    <td> <?php echo $row_donhang['ngaythang']; ?></td>
                                    <input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['mahang'] ?>" >                      
                                </tr>
                            <?php } ?>
                        </table>
                        <select class="form-control" name="xuly">
                            <option value="1">Đã xử lí</option>
                            <option value="0">chưa xử lí</option>

                        </select>
                        <br>
                        <input type="submit" class="btn btn-success " name="capnhatdonhang" value="Cập nhập đơn hàng" >
                        </form>
                   </div>
                    <?php
                    }  else {
                       
                   

                    ?>
                    <div class="col-md-7">

                        <p> Đơn hàng</p>
                    </div>
                        
                    <?php
                    }
            
                    ?>
                  
                        
                
                    <div class="col-md-5">
                        <h4> Liệt kê đơn hàng</h4>
                        <?php $sql_select = mysqli_query($mysqli, "SELECT * FROM tbl_sanpham,tbl_khachhhang,tbl_donhang WHERE tbl_donhang.sanpham_id = tbl_sanpham.sanpham_id 
                        AND tbl_donhang.khachhang_id = tbl_khachhhang.khachhang_id   ORDER BY tbl_donhang.donhang_id DESC") ?>
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <th>Số Thứ Tự</th>           
                                <th>Mã Hàng</th>
                                <th>Tình trạng đơn hàng</th>
                                <th>Tên Khách Hàng</th>
                                <th>Ngày Đặt</th>
                                <th>Ghi Chú</th>
                                <th>Quản Lý</th>

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

                                    <td> <?php echo $row_donhang['mahang']; ?></td>
                                    <td> <?php 
                                    if($row_donhang['tinhtrang']== 0){
                                        echo 'Chưa  xử lý' ;
                                    }else{
                                        echo 'Đã  xử lý' ;
                                    }
                                     ?></td>

                                    <td> <?php echo $row_donhang['name']; ?></td>
                                    <td> <?php echo $row_donhang['ngaythang']; ?></td>
                                    <td> <?php echo $row_donhang['note']; ?></td>

                                    <td> <a href="?xoadonhang=<?php echo $row_donhang['mahang'] ?>">Xóa</a> || <a href="?quanly=xemdonhang&mahang=<?php echo $row_donhang['mahang'] ?>">Xem đơn hàng</a> </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </body>

        </html>