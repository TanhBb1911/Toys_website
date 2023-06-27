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
    $des = $_POST["txtDes"];
    $err = "";

    if ($name == "") {
        $err .= "<li> Enter Category Name, Please</li>";
    }
    if ($err != "") {
        echo "<ul>$err</ul>";
    } else {
        $sq = "SELECT * FROM public.category WHERE cat_name='$name'";
        $result = pg_query($conn, $sq);
        if (pg_num_rows($result) == 0) {
            pg_query($conn, "INSERT INTO category (cat_name, cat_des) VALUES ('$name','$des')");
            echo "<script>alert('Add successfully')</script>";
            echo '<meta http-equiv= "refresh" content="0;URL=?page=management"/>';
        } else {
            echo "<li> Duplicate Categoy Name</li>";
        }
    }
}
?>

<div class="container">
    <h2>Adding Category</h2>
    <form id="addbrand" name="addbrand" method="post" action="" class="form-horizontal" role="form" onsubmit="return addcat()">
        <div class="form-group">
            <label for="txtTen" class="col-sm-2 control-label">Category Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo isset($_POST["txtName"]) ? ($_POST["txtName"]) : ""; ?>'>
            </div>
        </div>

        <div class="form-group">
            <label for="txtMoTa" class="col-sm-2 control-label">Description(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo isset($_POST["txtDes"]) ? ($_POST["txtDes"]) : ""; ?>'>
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