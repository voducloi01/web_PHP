        <?php
        ob_start();
        session_start();
        include '../db/connect.php';
     //session_destroy();
     //  unset('dangnhap');
        if (isset($_POST['dangnhap'])) {

            $taikhoan = $_POST['taikhoan'];
            $matkhau = md5($_POST['matkhau']);

            if ($taikhoan == "" || $matkhau == "") {
                echo '<p>Xin vui lòng nhập đầy đủ</p>';
            } else {

                $sql_select_admin = mysqli_query($mysqli, "SELECT * FROM `tbl_admin` WHERE email='$taikhoan' AND password1 = '$matkhau' LIMIT 1");
                $cout = mysqli_num_rows($sql_select_admin);
                $row_dangnhap = mysqli_fetch_array($sql_select_admin);          
                if ($cout > 0) {
                    $_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
                    $_SESSION['admin_id'] = $row_dangnhap['admin_id'];
                    header('location: dashboard.php');
                } else {
                    echo '<p>Tài khoản hoặc mật khẩu sai </p>';
                }
            }
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="../css/bootstrap.css">
        </head>

        <body>
            <h2 align="center">Đăng nhập Admin</h2>
            <div class="col-md-4">
                <div class="form-group">
                    <form action="" method="POST">
                        <label for="">Tài Khoản</label>
                        <input type="text" name="taikhoan" placeholder="Điền email" class="form-control"><br />
                        <label for="">Mật Khẩu</label>

                        <input type="password" name="matkhau" placeholder="Điền Mật khẩu" class="form-control"><br />
                        <input type="submit" name="dangnhap" value="Đăng nhập" class="btn btn-primary"><br />
                    </form>
                </div>
            </div>
        </body>

        </html>