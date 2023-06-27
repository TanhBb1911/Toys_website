<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must be LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != true) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    } else {

?>

        <script>
            function deleteConfirm() {
                if (confirm("Are you sure to delete!")) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

        <?php
        include_once("connection.php");
        if (isset($_GET["function"]) == "del") {
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $sq = "SELECT pro_image FROM product WHERE pro_id = '$id'";
                $res = pg_query($conn, $sq);
                $row = pg_fetch_array($res);
                $filePic = $row['pro_image'];
                unlink("Image/" . $filePic);
                pg_query($conn, "DELETE FROM product WHERE pro_id='$id'");
            }
        } else {
            '<meta http-equiv="refresh" content="0;URL=?page=managementpro"/>';
        }
        ?>


        <div class="container">
            <h1 class="text-center"> Products Management</h1>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-sm-3">
                        <h2>Management</h2>
                        <div class="list-group list-group-flush">
                        <a href="?page=management" class="list-group-item list-group-item-action py-2">Category</a>
                                <a href="?page=managementpro" class="list-group-item list-group-item-action py-2">Product</a>
                                <a href="?page=managementshop" class="list-group-item list-group-item-action py-2">Shop</a>
                                <a href="?page=managementsup" class="list-group-item list-group-item-action py-2">Suplier</a>
                        </div>
                        <hr class="d-sm-none">

                    </div>
                    <div class="col-sm-9">
                        <p>
                            <img src="Image/add.png" alt="Add new" width="16" height="16" border="0" />
                            <a href="?page=addproduct"> Add</a>
                        </p>
                        <form name="frm" method="post" action="">
                            <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><strong>No.</strong></th>
                                        <th><strong> ID</strong></th>
                                        <th><strong> Name</strong></th>
                                        <th><strong>Price</strong></th>
                                        <th><strong>Quantity</strong></th>
                                        <th><strong>Category </strong></th>
                                        <th><strong>Suplier </strong></th>
                                        <th><strong>Image</strong></th>
                                        <th><strong>Edit</strong></th>
                                        <th><strong>Delete</strong></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    include_once("connection.php");
                                    $No = 1;
                                    $result = pg_query($conn, "SELECT * FROM public.product p, public.category c, public.suplier d WHERE p.cat_id = c.cat_id and p.sup_id = d.sup_id  ");
                                    while ($row = pg_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $No; ?></td>
                                            <td><?php echo $row["pro_id"]; ?></td>
                                            <td><?php echo $row["pro_name"]; ?></td>
                                            <td><?php echo $row["price"]; ?></td>
                                            <td><?php echo $row["pro_qty"]; ?></td>
                                            <td><?php echo $row["cat_name"]; ?></td>
                                            <td><?php echo $row["sup_name"]; ?></td>
                                            <td>
                                                <img src="Image/<?php echo $row["pro_image"]; ?>" border=0 height="50" width="50" alt="">
                                            </td>

                                            <td style='text-align:center'> <a href="?page=updateproduct&&id=<?php echo $row['pro_id']; ?>">
                                                    <img src='Image/edit1.png' border='0' /></a></td>
                                            <td style='text-align:center'>
                                                <a href="?page=managementpro&&function=del&&id=<?php echo $row["pro_id"]; ?>" onclick="return deleteConfirm()">
                                                    <img src='Image/delete1.png' border='0' /></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $No++;
                                    }
                                    ?>
                                </tbody>

                            </table>

                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php }
} ?>