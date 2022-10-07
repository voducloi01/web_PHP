<div class="ads-grid py-sm-5 py-4">

    <div class="container py-xl-4 py-lg-2">
        <h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"> Build Pc</h3>
        <div>
            <table class="table">
                <tbody>
                    <?php
                    $sql_category_danhmuc1 = mysqli_query($mysqli, 'SELECT * FROM `tbl_category` WHERE category_id = 7 OR category_id = 8
                    OR category_id = 9 OR category_id = 10 OR category_id = 11 OR category_id = 12 OR category_id = 13 OR category_id = 14 
                    OR category_id = 15 OR category_id = 16 OR category_id = 17 OR category_id = 18 OR category_id = 19 OR category_id = 20
                     OR category_id = 21 OR category_id = 22 
                     ');
                    ?>
                    <?php
                    $i = 0;
                    while ($row_category_danhmuc1 = mysqli_fetch_array($sql_category_danhmuc1)) {
                        $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?> . <?php echo  $row_category_danhmuc1['category_name'] ?></td>
                        <td><button class="btn-primary">Thêm
                                <?php echo $row_category_danhmuc1['category_name'] ?></button></td>
                        <td><img src="images/b1.jpg" alt="Girl in a jacket" width="80" height="80"></td>
                    </tr>
                    <?php }

                    ?>

                </tbody>
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
</style>