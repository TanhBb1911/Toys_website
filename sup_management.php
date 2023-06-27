<?php
if (isset($_SESSION['us']) == false) {
    echo "<script>alert('You must be LOG-IN')</script>";
    echo '<meta http-equiv="refresh" content="0;URL=?page=login"/>';
} else {
    if (isset($_SESSION['admin']) && $_SESSION['admin'] != true) {
        echo "<script>alert('You are not administrator')</script>";
        echo '<meta http-equiv="refresh" content="0;URL=Index.php"/>';
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
                pg_query($conn, "DELETE FROM public.suplier WHERE sup_id='$id'");
                
            }
        }
        ?>

        <form name="frm" method="post" action="">
            <div class="container">
                <h1 class="text-center"> Suplier Management</h1>
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-sm-3">
                            <h2>Management Systems</h2>
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
                                <a href="?page=addsup"> Add</a>
                            </p>
                            <table id="tablecategory" class="table table-striped table-bordered" width="100">
                                <thead>
                                    <tr>
                                        <th><strong>No.</strong></th>
                                        <th><strong>Suplier Name</strong></th>
                                        <th><strong>Phone</strong></th>
                                        <th><strong>Mail</strong></th>
                                        <th><strong>Edit</strong></th>
                                        <th><strong>Delete</strong></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    include_once("connection.php");
                                    $No = 1;
                                    $result = pg_query($conn, "SELECT * FROM suplier");
                                    while ($row = pg_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $No; ?></td>
                                            <td><?php echo $row["sup_name"]; ?></td>
                                            <td><?php echo $row["sup_phone"]; ?></td>
                                            <td><?php echo $row["sup_mail"]; ?></td>
                                            <td style='text-align:center'>
                                                <a href="?page=updatesup&&id=<?php echo $row["sup_id"]; ?>">
                                                    <img src="Image/edit1.png" border='0'></a>
                                            </td>
                                            <td style='text-align:center'>
                                                <a href="?page=managementsup&&function=del&&id=<?php echo $row["sup_id"]; ?>" onclick="return deleteConfirm()">
                                                    <img src='Image/delete1.png' border='0' /></a>
                                            </td>
                                        </tr>
                                    <?php
                                        $No++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </form>
<?php }
} ?>