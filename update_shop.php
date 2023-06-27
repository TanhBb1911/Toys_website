<script>
    function updateshop() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.updatebrand

        if (f.txtName.value == "" || f.txtDes.value == "") {
            alert("Enter fileds with marks(*), please");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("Shop name can't contain special character, please enter again");
            f.txtName.focus();
            return false;
        }
        return true;
    }
</script>
<?php
include_once("connection.php");
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $result = pg_query($conn, "SELECT * FROM shop where shop_id='$id'");
    $row = pg_fetch_array($result);
    $shop_name = $row['shop_name'];
    $shop_phone = $row['shop_phone'];
    $shop_mail = $row['shop_mail'];
    $shop_address = $row['shop_address'];
    $shop_id = $row['shop_id'];



?>

    <div class="container">
        <h2> Updating Shop </h2>
        <form id="updatebrand" name="updatebrand" method="post" action="" class="form-horizontal" role="form" onsubmit="return updateshop()">
            <div class="form-group">
                <label for="txtTen" class="col-sm-2 control-label">Shop ID(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Shop ID" readonly value='<?php echo $shop_id; ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="txtTen" class="col-sm-2 control-label">Shop Name(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Shop Name" value='<?php echo $shop_name; ?>'>
                </div>
            </div>

            <div class="form-group">
                <label for="txtMoTa" class="col-sm-2 control-label">Shop Phone(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone" value='<?php echo $shop_phone ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="txtMoTa" class="col-sm-2 control-label">Shop Email(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtmail" id="txtmail" class="form-control" placeholder="Email" value='<?php echo $shop_mail ?>'>
                </div>
            </div>
            <div class="form-group">
                <label for="txtMoTa" class="col-sm-2 control-label">Shop Address(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtaddress" id="txtaddress" class="form-control" placeholder="Address" value='<?php echo $shop_address ?>'>
                </div>
            </div>



            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                </div>
            </div>
        </form>
    </div>


    <?php
    if (isset($_POST["btnUpdate"])) {
        $id = $_POST["txtID"];
        $name = $_POST["txtName"];
        $phone = $_POST["txtPhone"];
        $mail = $_POST["txtmail"];
        $address = $_POST["txtaddress"];
        $err = "";
        if ($name == "") {
            $err .= "<li> Enter Shop Name, please</li>";
        }
        if ($err != "") {
            echo "<ul>$err<ul>";
        } else {
            $sq = "SELECT * FROM public.shop WHERE shop_id <> '$id' and shop_name='$name'";
            $result = pg_query($conn, $sq);
            if (pg_num_rows($result) == 0) {
                pg_query($conn, "UPDATE public.shop SET shop_name = '$name', shop_phone = '$phone', shop_mail = '$mail' , shop_address = '$address' where shop_id='$id'");
                echo "<script>alert('Update successfully')</script>";
                echo '<meta http-equiv="refresh" content="0;URL=?page=managementshop"/>';
            } else {
                echo "<li>Duplicate Shop Name </li>";
            }
        }
    }

    ?>


<?php
} else {
    echo '<meta http-equiv="refesh" content="0;ULR=shop_management.php"/>';
}

?>