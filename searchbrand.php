    <div class="container">
        <h1 class="text-center"></h1>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-2">
                    <h2>Supplier</h2>
                    <div class="list-group list-group-flush">
                        <?php
                        $result = pg_query($conn, "SELECT * FROM public.suplier ");
                        if (!$result) {
                            echo "$err";
                        }
                        while ($row = pg_fetch_array($result)) {
                        ?>
                            <a href="?page=search&&SupID=<?php echo $row['sup_id'] ?>" class="list-group-item list-group-item-action py-2"><?php echo $row['sup_name'] ?></a>
                        <?php } ?>
                    </div>
                    <h2>Category</h2>
                    <div class="list-group list-group-flush">
                        <?php
                        $result = pg_query($conn, "SELECT * FROM category ");
                        if (!$result) {
                            echo "$err";
                        }
                        while ($row = pg_fetch_array($result)) {
                        ?>
                            <a href="?page=search&&CatID=<?php echo $row['cat_id'] ?>" class="list-group-item list-group-item-action py-2"><?php echo $row['cat_name'] ?></a>
                        <?php } ?>
                    </div>
                    <hr class="d-sm-none">
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <?php
                        if (isset(($_GET['SupID']))) {
                            $id = $_GET['SupID'];
                            $No = 1;
                            $res = pg_query($conn, "SELECT * FROM product WHERE sup_id = '$id'");
                            if (!$res) {
                                die("Invalid query:  " . pg_errormessage($conn));
                            }
                            while ($row = pg_fetch_array($res)) {
                                if ($No <= 12) {
                        ?>
                                    <div class="col-sm-4 mt-5">
                                        <div class='container-fluid'>
                                            <div class="col-sm-3 mb-5">
                                                <div class="card mx-5 mt-1">
                                                    <img src="Image/<?php echo $row['pro_image'] ?> " width="250px" height="350px">
                                                    <div class="card-body text-center mx-auto">
                                                        <div class='cvp'>
                                                            <h4 class="card-title font-weight-bold"><?php echo $row['pro_name'] ?></h4>
                                                            <p class="card-text"><?php echo $row['price'] ?>$</p>
                                                            <a href="?page=viewdetail&&id=<?php echo $row['pro_id']; ?>" class="btn details px-auto">view details</a><br />
                                                            <form action="?page=cart" method="POST">
                                                                <input type="hidden" name="Qty" value="1">
                                                                <input class="btn cart px-auto" type="submit" name="AddCart" value="Add To Cart">
                                                                <input type="hidden" name="ProName" value="<?php echo $row['pro_name'] ?>">
                                                                <input type="hidden" name="Short" value="<?php echo $row['small_des'] ?>">
                                                                <input type="hidden" name="Price" value="<?php echo $row['price'] ?>">
                                                                <input type="hidden" name="Img" value="<?php echo $row['pro_image'] ?>">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                    $No++;
                                }
                            }
                        }
                        ?>
                        <?php
                        if (isset(($_GET['CatID']))) {
                            $id = $_GET['CatID'];
                            $No = 1;
                            $res = pg_query($conn, "SELECT * FROM product WHERE cat_id = '$id'");
                            if (!$res) {
                                die("Invalid query:  " . pg_errormessage($conn));
                            }
                            while ($row = pg_fetch_array($res)) {
                                if ($No <= 12) {
                        ?>
                                    <div class="col-sm-4 mt-5">
                                        <div class='container-fluid'>
                                            <div class="col-sm-3 mb-5">
                                                <div class="card mx-5 mt-1">
                                                    <img src="Image/<?php echo $row['pro_image'] ?> " width="250px" height="350px">
                                                    <div class="card-body text-center mx-auto">
                                                        <div class='cvp'>
                                                            <h4 class="card-title font-weight-bold"><?php echo $row['pro_name'] ?></h4>
                                                            <p class="card-text"><?php echo $row['price'] ?>$</p>
                                                            <a href="?page=viewdetail&&id=<?php echo $row['pro_id']; ?>" class="btn details px-auto">view details</a><br />
                                                            <form action="?page=cart" method="POST">
                                                                <input type="hidden" name="Qty" value="1">
                                                                <input class="btn cart px-auto" type="submit" name="AddCart" value="Add To Cart">
                                                                <input type="hidden" name="ProName" value="<?php echo $row['pro_name'] ?>">
                                                                <input type="hidden" name="Short" value="<?php echo $row['small_des'] ?>">
                                                                <input type="hidden" name="Price" value="<?php echo $row['price'] ?>">
                                                                <input type="hidden" name="Img" value="<?php echo $row['pro_image'] ?>">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                    $No++;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>