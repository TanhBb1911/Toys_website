<script>
    function addcat() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.addbrand
        if ( f.txtName.value == "" || f.txtDes.value == "") {
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
    $err = "";

    if ($name == "") {
        $err .= "<li> Enter Suplier Name, Please</li>";
    }
    if ($err != "") {
        echo "<ul>$err</ul>";
    } else {
        $sq = "SELECT * FROM public.suplier WHERE sup_name='$name'";
        $result = pg_query($conn, $sq);
        if (pg_num_rows($result) == 0) {
            pg_query($conn, "INSERT INTO suplier (sup_name, sup_phone, sup_mail) VALUES ('$name','$phone','$mail')");
            echo "<script>alert('Add successfully')</script>";
            echo '<meta http-equiv= "refresh" content="0;URL=?page=managementsup"/>';
        } else {
            echo "<li> Duplicate Suplier Name</li>";
        }
    }
}
?>

<div class="container">
    <h2>Adding Suplier</h2>
    <form id="addbrand" name="addbrand" method="post" action="" class="form-horizontal" role="form" onsubmit="return addcat()">
        <div class="form-group">
            <label for="txtTen" class="col-sm-2 control-label">Suplier Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Suplier Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
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
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
                <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='add_category.php'" />

            </div>
        </div>
    </form>
</div>