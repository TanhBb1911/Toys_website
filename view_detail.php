<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<?php
include_once("connection.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sq = "SELECT * FROM  product p, category c, shop d WHERE p.shop_id = d.shop_id and p.cat_id = c.cat_id and
     pro_id='$id'";
    $res = pg_query($conn, $sq);
    $row = pg_fetch_array($res)

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 col-sm-6 py-5">
                <div class="white-box text-center">
                    <img src="Image/<?php echo $row['pro_image'] ?>" width="320" height="500" style="border-radius: 15px;">
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-6 text-center">
                <h2 class="box-title mt-5 class=" mb-3 id="home"><span> TOY DESCRIPTION</span> </h2>
                <div class="white-box text-center">
                    <h4>Name: &nbsp;<?php echo $row['pro_name'] ?></h4>
                    <h4>Category: &nbsp;<?php echo $row['cat_name'] ?></h4>
                    <h4>Shop: &nbsp;<?php echo $row['shop_name'] ?></h4>
                    <h4>Price:&nbsp;<?php echo $row['price'] ?></h4>
                </div>
                <div class="white-box text-center">
                <h4>Discription:</h4>   <?php echo $row['detail_des'] ?>
                </div>
                <div>
                    <form action="?page=cart" method="POST">
                        <input type="hidden" name="Qty" value="1">
                        <input class="btn btn-primary btn-rounded" type="submit" name="AddCart" value="Add To Cart">
                        <input type="hidden" name="ProName" value="<?php echo $row['pro_name'] ?>">
                        <input type="hidden" name="Short" value="<?php echo $row['small_des'] ?>">
                        <input type="hidden" name="Price" value="<?php echo $row['price'] ?>">
                        <input type="hidden" name="Img" value="<?php echo $row['pro_image'] ?>">
                    </form>

                    <br>
                    <form method="POST">
                        <button type="submit" name="btnBuyNow" class="btn btn-primary btn-rounded">Buy Now</button>
                    </form>
                    <?php
                        if(isset($_POST['btnBuyNow']))
                        {
                            echo "<script>alert('Buying successfully!')</script>";
                        }
                    ?>
                </div>
                <div class="pt-5">
                    <h6 class="mb-0"><a href="?page=content" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                </div>

            <?php
        }
            ?>
            </div>
        </div>
    </div>