<script>
    function addpro() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.pro
        if (format.test(f.txtName.value)) {
            alert("Category name can't contain special character, please enter again");
            f.txtName.focus();
            return false;   
        }
        if (f.txtID.value == "" || f.txtName.value == "" || f.txtDes.value == ""|| f.txtShort.value == ""|| f.txtDetail.value == ""|| f.txtPrice.value == "") {
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

function bind_Category_List($conn)
{
    $sqlstring = "SELECT cat_id, cat_name FROM public.category";
    $result = pg_query($conn, $sqlstring);
    echo "<select name='CategoryList' class='form-control'>
		<option value='0'> Choose catogory</option>";
    while ($row = pg_fetch_array($result)) {

        echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_name'] . "</option>";
    }
    echo "</select>";
}


function bind_Sup_List($conn)
{
    $sqlstring = "SELECT sup_id, sup_name FROM public.suplier";
    $result = pg_query($conn, $sqlstring);
    echo "<select name='SuplierList' class='form-control'>
		<option value='0'> Choose Suplier</option>";
    while ($row = pg_fetch_array($result)) {

        echo "<option value='" . $row['sup_id'] . "'>" . $row['sup_name'] . "</option>";
    }
    echo "</select>";
}

function bind_Shop_List($conn)
{
    $sqlstring = "SELECT shop_id, shop_name FROM public.shop";
    $result = pg_query($conn, $sqlstring);
    echo "<select name='ShopList' class='form-control'>
		<option value='0'> Choose Shop</option>";
    while ($row = pg_fetch_array($result)) {

        echo "<option value='" . $row['shop_id'] . "'>" . $row['shop_name'] . "</option>";
    }
    echo "</select>";
}


if (isset($_POST["btnAdd"])) {
    $proname = $_POST["txtName"];
    $short = $_POST["txtShort"];
    $detail = $_POST["txtDetail"];
    $price = $_POST["txtPrice"];
    $qty = $_POST["txtQty"];
    $pic = $_FILES["txtImage"];
    $category = $_POST["CategoryList"];
    $sup = $_POST["SuplierList"];
    $shop = $_POST["ShopList"];
    $err = "";

    if (trim($proname) == "") {
        $err .= "<li> Enter Product Name, please</li>";
    }
    if ($category == "0") {
        $err .= "<li> Choose Brand of Product, please</li>";
    }
    if (!is_numeric($price)) {
        $err .= "<li> Product price must be number, please </li>";
    }
    if (!is_numeric($qty)) {
        $err .= "<li> Product price must be number, please</li>";
    }
    if ($err != "") {
        echo "<ul> $err</ul>";
    } else {
        if (
            $pic['type'] == "image/jpg" || $pic['type'] == "image/jpeg"
            || $pic['type'] == "image/png" || $pic['type'] == "image/gif"
        ) {
            if ($pic['size'] <= 20000000) {
                $sq = "SELECT * FROM public.product WHERE pro_name='$proname'";
                $result = pg_query($conn, $sq);
                if (pg_num_rows($result) == 0) {
                    copy($pic['tmp_name'], "Image/" . $pic['name']);
                    $filePic = $pic['name'];
                    $sqlstring = "INSERT INTO public.product (pro_name, small_des, detail_des, price, pro_date, pro_qty, pro_image, cat_id, sup_id, shop_id)
					VALUES('$proname','$short','$detail','$price','" . date('Y-m-d H:i:s') . "','$qty','$filePic','$category','$sup','$shop')";
                    pg_query($conn, $sqlstring);
                    echo "<script>alert('Add Successfully')</script>";
                    echo '<meta http-equiv="refresh" content="0;URL=?page=managementpro"/>';
                } else {
                    echo "<li>Duplicate product ID or Name</li>";
                }
            } else {
                echo "Size of image too big";
            }
        } else {
            echo "Image fotmat is not correct";
        }
    }
}
?>
<div class="container py-5">
    <h2 align="center">Adding new Product</h2>

    <form id="pro" name="pro" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form"  onsubmit="return addpro()">
        <!-- <div class="form-group">
            <label for="txtID" class="col-sm-2 control-label">Product ID(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value='' />
            </div>
        </div> -->
        <div class="form-group">
            <label for="txtName" class="col-sm-2 control-label">Product Name(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value='' />
            </div>
        </div>
        <div class="form-outline">
            <label for="" class="col-sm-2 control-label">Product Category(*): </label>
            <div class="col-sm-10">
                <?php bind_Category_List($conn); ?>
            </div>
        </div>
        <div class="form-outline">
            <label for="" class="col-sm-2 control-label">Product Suplier(*): </label>
            <div class="col-sm-10">
                <?php bind_Sup_List($conn); ?>
            </div>
        </div> <div class="form-outline">
            <label for="" class="col-sm-2 control-label">Product Shop(*): </label>
            <div class="col-sm-10">
                <?php bind_Shop_List($conn); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="lblGia" class="col-sm-2 control-label">Price(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='' />
            </div>
        </div>

        <div class="form-group">
            <label for="lblShort" class="col-sm-2 control-label">Short description(*): </label>
            <div class="col-sm-10">
                <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='' />
            </div>
        </div>

        <div class="form-group">
            <label for="lblDetail" class="col-sm-2 control-label">Detail description(*): </label>
            <div class="col-sm-10">
                <textarea name="txtDetail" rows="9" class="ckeditor  form-control"></textarea>
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
                <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="" />
            </div>
        </div>

        <div class="form-group">
            <label for="sphinhanh" class="col-sm-2 control-label">Image(*): </label>
            <div class="col-sm-10">
                <input type="file" name="txtImage" id="txtImage" class="form-control" value="" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new" />
                <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='product_management.php'" />

            </div>
        </div>
    </form>
</div>