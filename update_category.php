<script>
    function updatecat() {
        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
        f = document.updatebrand

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
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $result = pg_query($conn, "SELECT * FROM category where cat_id='$id'");
        $row = pg_fetch_array($result);
        $cat_name = $row['cat_name'];
        $cat_des = $row['cat_des'];
        $cat_id = $row['cat_id'];



    ?>

       <div class="container">
           <h2> Updating Product Category</h2>
           <form id="updatebrand" name="updatebrand" method="post" action="" class="form-horizontal" role="form" onsubmit="return updatecat()">
               <div class="form-group">
                   <label for="txtTen" class="col-sm-2 control-label">Category ID(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Catepgy ID" readonly value='<?php echo $cat_id; ?>'>
                   </div>
               </div>
               <div class="form-group">
                   <label for="txtTen" class="col-sm-2 control-label">Category Name(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Catepgy Name" value='<?php echo $cat_name; ?>'>
                   </div>
               </div>

               <div class="form-group">
                   <label for="txtMoTa" class="col-sm-2 control-label">Description(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtDes" id="txtDes" class="form-control" placeholder="Description" value='<?php echo $cat_des ?>'>
                   </div>
               </div>

               <div class="form-group">
                   <div class="col-sm-offset-2 col-sm-10">
                       <input type="submit" class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update" />
                       <input type="button" class="btn btn-primary" name="btnIgnore" id="btnIgnore" value="Ignore" onclick="window.location='Category_Management.php'" />

                   </div>
               </div>
           </form>
       </div>


       <?php
        if (isset($_POST["btnUpdate"])) {
            $id = $_POST["txtID"];
            $name = $_POST["txtName"];
            $des = $_POST["txtDes"];
            $err = "";
            if ($name == "") {
                $err .= "<li> Enter Category Name, please</li>";
            }
            if ($err != "") {
                echo "<ul>$err<ul>";
            } else {
                $sq = "SELECT * FROM public.category WHERe cat_id <> '$id' and cat_name='$name'";
                $result = pg_query($conn, $sq);
                if (pg_num_rows($result) == 0) {
                    pg_query($conn, " UPDATE public.category SET cat_name ='$name', cat_des='$des' where cat_id='$id'");
                    echo "<script>alert('Update successfully')</script>";
                    echo '<meta http-equiv="refresh" content="0;URL=?page=management"/>';
                } else {
                    echo "<li>Duplicate Category Name </li>";
                }
            }
        }

        ?>


   <?php
    } else {
        echo '<meta http-equiv="refesh" content="0;ULR=category_management.php"/>';
    }

    ?>