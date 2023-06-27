<script>
    function updatepro() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.pro

        if (format.test(f.txtName.value)) {
            alert("Category name can't contain special character, please enter again");
            f.txtName.focus();
            return false;
        }
        if (f.txtID.value == "" || f.txtName.value == "" || f.txtDes.value == "" || f.txtShort.value == "" || f.txtDetail.value == "" || f.txtPrice.value == "") {
            alert("Enter fileds with marks(*), please");
            return false;
        }
        if (format.test(f.txtDes.value)) {
            alert("Description can't contain special character, please enter again");
            f.txtDes.focus();
            return false;
        }
        if (isNaN(f.txtPrice.value) == false) {
            alert("The  Price must be a number")
            return false;
        }
        return true;
    }
</script>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
include_once("connection.php");

function bind_Category_List($conn, $selectedValue)
{
    $sqlstring = "SELECT cat_id, cat_name FROM category";
    $result = pg_query($conn, $sqlstring);
    echo "<select name='CategoryList' class='form-control'>
		<option value='0'> Choose catogory</option>";
    while ($row = pg_fetch_array($result)) {
        if ($row['cat_id'] == $selectedValue) {
            echo "<option value ='" . $row['cat_id'] . "' selected>" . $row['cat_name'] . "</option>";
        } else {
            echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
        }
    }
    echo "</select>";
}


function bind_Suplier_List($conn, $selectedValue)
{
    $sqlstring = "SELECT sup_id, sup_name FROM suplier";
    $result = pg_query($conn, $sqlstring);
    echo "<select name='SuplierList' class='form-control'>
		<option value='0'> Choose Suplier</option>";
    while ($row = pg_fetch_array($result)) {
        if ($row['sup_id'] == $selectedValue) {
            echo "<option value ='" . $row['sup_id'] . "' selected>" . $row['sup_name'] . "</option>";
        } else {
            echo "<option value='" . $row['sup_id'] . "'>" . $row['sup_name'] . "</option>";
        }
    }
    echo "</select>";
}


function bind_Shop_List($conn, $selectedValue)
{
    $sqlstring = "SELECT shop_id, shop_name FROM shop";
    $result = pg_query($conn, $sqlstring);
    echo "<select name='ShopList' class='form-control'>
		<option value='0'> Choose Suplier</option>";
    while ($row = pg_fetch_array($result)) {
        if ($row['shop_id'] == $selectedValue) {
            echo "<option value ='" . $row['shop_id'] . "' selected>" . $row['shop_name'] . "</option>";
        } else {
            echo "<option value='" . $row['shop_id'] . "'>" . $row['shop_name'] . "</option>";
        }
    }
    echo "</select>";
}


?>
<?php
if (isset($_POST["btnUpdate"])) {
    $id = $_POST["txtID"];
    $proname = $_POST["txtName"];
    $short = $_POST['txtShort'];
    $detail = $_POST['txtDetail'];
    $price = $_POST['txtPrice'];
    $qty = $_POST['txtQty'];
    $pic = $_FILES['txtImage'];
    $category = $_POST['CategoryList'];
    $suplier = $_POST['SuplierList'];
    $shop = $_POST['ShopList'];
    $err = "";

    if (trim($proname) == "") {
        $err .= "<li> Enter Prodcut Name, Please</li>";
    }
    if ($category == "0") {
        $err .= "<li> Choose Brand of Prodcut, Please</li>";
    }
    if (!is_numeric($price)) {
        $err .= "<li> Price of Product must be Number, Please</li>";
    }
    if (!is_numeric($qty)) {
        $err .= "<li> Quanity of Product must be Number, Please</li>";
    }
    if ($err != "") {
        echo "<ul>$err</ul>";
    } else {
        if ($pic['name'] != "") {
            if ($pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg" || $pic['type'] == "image/png" || $pic['type'] == "image/gif") {
                if ($pic['size'] <= 614400) {
                    $sq = "SELECT * FROM product WHERE pro_id != $id AND pro_name = $proname";
                    $result = pg_query($conn, $sq);
                    if (pg_num_rows($result) == 0) {
                        copy($pic['tmp_name'], "Image/" . $pic['name']);
                        $filePic = $pic['name'];

                        $sqlstring = "UPDATE product SET
                         pro_name ='$proname', price='$price', small_des='$short', detail_des='$detail', pro_qty='$qty',pro_image='$filePic', 
                         cat_id=$category, sup_id=$suplier,shop_id=$shop,
                         pro_date ='" . date('Y-m-d H:i:s') . "' WHERE pro_id='$id'";
                        pg_query($conn, $sqlstring);
                        echo "<script>alert('Update Successfully')</script>";
                        echo '<meta http-equiv="refresh" content="0;URL=?page=managementpro"/>';
                    } else {
                        echo "<li> Duplicate product Name</li>";
                    }
                } else {
                    echo "Size of image too big";
                }
            } else {
                echo "Image format is not correct";
            }
        } else {
            $sq = "SELECT * FROM product where pro_id != $id AND pro_name ='$proname'";
            $result = pg_query($conn, $sq);
            if (pg_num_rows($result) == 0) {
                $sqlstring = "UPDATE product SET
                         pro_name ='$proname', price='$price', small_des='$short', detail_des='$detail', pro_qty='$qty', 
                         cat_id=$category, sup_id=$suplier,shop_id=$shop,
                         pro_date ='" . date('Y-m-d H:i:s') . "' WHERE pro_id='$id'";

                pg_query($conn, $sqlstring);
                echo '<meta http-equiv="refresh" content="0;URL=?page=managementpro"/>';
            } else {
                echo "<li>Duplicate product name</li>";
            }
        }
    }
}
?>
<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqlstring = "SELECT pro_name, small_des, detail_des, price, pro_date, pro_qty,
    pro_image, cat_id, sup_id, shop_id FROM product WHERE pro_id = '$id'";

    $result = pg_query($conn, $sqlstring);
    $row = pg_fetch_array($result);

    $proname = $row['pro_name'];
    $short = $row['small_des'];
    $detail = $row['detail_des'];
    $price = $row['price'];
    $qty = $row['pro_qty'];
    $pic = $row['pro_image'];
    $category = $row['cat_id'];
    $suplier = $row['sup_id'];
    $shop = $row['shop_id'];
?>

    <div class="container">
        <h2 align="center">Updating Product</h2>

        <form id="pro" name="pro" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form" onsubmit="return updatepro()">
            <div class="form-group">
                <label for="txtTen" class="col-sm-2 control-label">Product ID(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product_ID" readonly value='<?php echo $id; ?>' />
                </div>
            </div>
            <div class="form-group">
                <label for="txtTen" class="col-sm-2 control-label">Product Name(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product_Name" value='<?php echo $proname; ?>' />
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Product Category(*): </label>
                <div class="col-sm-10 ">
                    <?php bind_Category_List($conn, $category); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Product Suplier(*): </label>
                <div class="col-sm-10">
                    <?php bind_Suplier_List($conn, $suplier); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Product Shop(*): </label>
                <div class="col-sm-10">
                    <?php bind_Shop_List($conn, $shop); ?>
                </div>
            </div>

            <div class="form-group">
                <label for="lblGia" class="col-sm-2 control-label">Price(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price; ?>' />
                </div>
            </div>

            <div class="form-group">
                <label for="lblShort" class="col-sm-2 control-label">Short description(*): </label>
                <div class="col-sm-10">
                    <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='<?php echo $short ?>' />
                </div>
            </div>

            <div class="form-group ">
                <label for="lblDetail" class="col-sm-2 control-label">Detail description(*): </label>
                <div class="col-sm-10">
                    <textarea name="txtDetail" rows="4" class="ckeditor form-control"><?php echo $detail ?></textarea>
                    <script language="javascript">
                        CKEDITOR.replace('txtDetail', {
                            skin: 'kama',
                            extraPlugins: 'uicolor',
                            uiColor: '#eeeeee',
                            toolbar: [
                                ['Source', 'DocProps', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates'],
                                ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteWord', '-', 'Print', 'SpellCheck'],
                                ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'],
                                ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
                                ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Subscript', 'Superscript'],
                                ['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', 'Blockquote'],
                                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull'],
                                ['Link', 'Unlink', 'Anchor', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                                ['Image', 'Flash', 'Table', 'Rule', 'Smiley', 'SpecialChar'],
                                ['Style', 'FontFormat', 'FontName', 'FontSize'],
                                ['TextColor', 'BGColor'],
                                ['UIColor']
                            ]
                        });
                    </script>

                </div>
            </div>

            <div class="form-group">
                <label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*): </label>
                <div class="col-sm-10">
                    <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?= $qty ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="sphinhanh" class="col-sm-2 control-label">Image(*): </label>
                <div class="col-sm-10">
                    <img src='Image/<?php echo $pic; ?>' border='0' width="50" height="50" />
                    <input type="file" name="txtImage" id="txtImage" class="form-control" value="" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                    <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='Product_Management.php'" />

                </div>
            </div>
        </form>
    </div>


<?php
} else {
    echo '<meta http-equiv="refresh" content="0;URL=?page=managementpro">';
}
?>