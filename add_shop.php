<script>
    function addshop() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.addbrand
        if (f.txtName.value == "" || f.txtDes.value == "") {
            alert("Enter fileds with marks(*), please");
            return false;
        }
        if (format.test(f.txtName.value)) {
            alert("Category name can't contain special character, please enter again");
            f.txtName.focus();
            return false;
        }
        return true;
    }
</script>
<?php
include_once("connection.php");
if (isset($_POST["btnAdd"])) {
    $name = $_POST["txtName"];
    $phone = $_POST["txtPhone"];
    $mail = $_POST["txtMail"];
    $address = $_POST["txtAddress"];
    $err = "";

    if ($name == "") {
        $err .= "<li> Enter Shop Name, Please</li>";
    }
    if ($err != "") {
        echo "<ul>$err</ul>";
    } else {
        $sq = "SELECT * FROM public.shop WHERE shop_name='$name'";
        $result = pg_query($conn, $sq);
        if (pg_num_rows($result) == 0) {
            pg_query($conn, "INSERT INTO shop (shop_name, shop_phone, shop_mail, shop_address) VALUES ('$name','$phone','$mail','$address')");
            echo "<script>alert('Add successfully')</script>";
            echo '<meta http-equiv= "refresh" content="0;URL=?page=managementshop"/>';
        } else {
            echo "<li> Duplicate Shop Name</li>";
        }
    }
}
?>

<div class="container">
    <h2>Adding Shop</h2>
    <form id="addbrand" name="addbrand" method="post" action="" class="form-horizontal" role="form" onsubmit="return addshop()">
        <div class="form-group">
            <label for="txtTen" class="col-sm-2 control-label">Shop Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Shop Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="txtMoTa" class="col-sm-2 control-label">Phone(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone" value='<?php echo isset($_POST["txtPhone"]) ? ($_POST["txtPhone"]) : ""; ?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="txtMoTa" class="col-sm-2 control-label">Email(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtMail" id="txtMail" class="form-control" placeholder="Email" value='<?php echo isset($_POST["txtMail"]) ? ($_POST["txtMail"]) : ""; ?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="txtMoTa" class="col-sm-2 control-label">Address(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Address" value='<?php echo isset($_POST["txtAddress"]) ? ($_POST["txtAddress"]) : ""; ?>'>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
            </div>
        </div>
    </form>
</div>