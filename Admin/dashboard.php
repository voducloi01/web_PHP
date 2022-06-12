
<?php   
        ob_start();
        session_start();
        
    if (!isset($_SESSION['dangnhap'])){
            header('location: index.php ');
    }
?>
<?php
        if (isset($_GET['login'])){
            $dangxuat = $_GET['login'];
        }else {
            $dangxuat = '';
        }if($dangxuat == 'dangxuat'){
            unset($_SESSION['dangnhap']);
            header('location: index.php');
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
     <p>Xin chào <?php echo $_SESSION['dangnhap']?> <a href="?login=dangxuat">Đăng xuất</a></p>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sanpham.php">Sản Phẩm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="xulykhachhang.php">Khách hàng</a>
      </li>
    </ul>
  </div>
</nav>
</body>
</html>