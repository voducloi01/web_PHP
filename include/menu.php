<?php
$sql_category = mysqli_query($mysqli, 'SELECT * FROM `tbl_category` ORDER BY category_id DESC ');
?>

<div class="navbar-inner">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="agileits-navi_search">
                <form action="#" method="post">
                    <select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
                        <option value="">Danh Mục Sản Phẩm </option>
                        <?php
                        while ($row_category = mysqli_fetch_array($sql_category)) {
                        ?>
                        <option value="<?php echo $row_category['category_id'] ?>">
                            <?php echo $row_category['category_name'] ?></option>
                        <?php }
                        ?>
                    </select>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto text-center mr-xl-5 wrappeCenter">
                    <li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link" href="index.php">Trang chủ
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php
                    $sql_category_danhmuc = mysqli_query($mysqli, 'SELECT * FROM `tbl_category` ORDER BY category_id DESC ');
                    ?>

                    <!-- <li class="nav-item  mr-lg-2 mb-lg-0 mb-2">
                        <a class="nav-link "
                            href="?quanly=danhmuc&id= <?php echo $row_category_danhmuc['category_id'] ?>" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <?php echo $row_category_danhmuc['category_name'] ?>
                        </a>

                    </li> -->
                    <li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
                        <div class="dropdown">
                            <button class="dropbtn">Danh Mục LapTop</button>
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


                    </li>


                    <li class=" nav-item">
                        <a class="nav-link" href="contact.html">Liên Hệ</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<style>
.dropbtn {

    color: black;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 0px 16px;
    text-decoration: none;
    display: block;
    height: 45px;
}

.dropdown-content a:hover {
    background-color: #f1f1f1
}

.dropdown:hover .dropdown-content {
    display: block;
}



.dropbtn {
    background-color: #f8f9fa;
}

.wrappeCenter {
    display: flex;
    align-items: center;
}
</style>