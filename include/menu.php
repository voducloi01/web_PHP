<?php
$sql_category = mysqli_query($mysqli, 'SELECT * FROM `tbl_category` ORDER BY category_id DESC ');
?>

<div class="navbar-inner">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5 wrappeCenter">
                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2 dropdown">
                        <button class="dropbtn"><a style="color: black;" href="index.php">Trang chủ</a></button>
                    </li>
                    <?php
                    $sql_category_danhmuc = mysqli_query($mysqli, 'SELECT * FROM `tbl_category` ORDER BY category_id DESC ');
                    ?>
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <div class="dropdown">
                            <button class="dropbtn" style="color : black">LapTop & Phụ Kiện</button>
                            <div class="dropdown-content">
                                <?php
                                while ($row_category_danhmuc = mysqli_fetch_array($sql_category_danhmuc)) {
                                ?>
                                <a class="nav-link "
                                    href="?quanly=danhmuc&id= <?php echo $row_category_danhmuc['category_id'] ?>"
                                    role="button" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $row_category_danhmuc['category_name'] ?>
                                </a>
                                <?php }

                                ?>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2 dropdown">
                        <button class="dropbtn"> <a style="color: black ;" href="?quanly=buildPc">Build PC
                            </a></button>

                    </li>
                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2 dropdown">
                        <button class="dropbtn"> <a style="color: black ;" href="?quanly=giohang">Giỏ hàng
                            </a></button>

                    </li>
                    <li class="nav-item mr-lg-2 mb-lg-0 mb-2 dropdown">
                        <button class="dropbtn"> <a style="color: black ;" href="contact.html">Liên Hệ</a></button>

                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<style>
.dropbtn {
    background-color: #f8f9fa;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
}


.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    width: 250px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #0879c9;
}
</style>