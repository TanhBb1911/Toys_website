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
        $result = pg_query($conn, "SELECT * FROM suplier where sup_id='$id'");
        $row = pg_fetch_array($result);
        $sup_name = $row['sup_name'];
        $sup_phone = $row['sup_phone'];
        $sup_mail = $row['sup_mail'];
        $sup_id = $row['sup_id'];



    ?>

       <div class="container">
           <h2> Updating Supplier</h2>
           <form id="updatebrand" name="updatebrand" method="post" action="" class="form-horizontal" role="form" onsubmit="return updatecat()">
               <div class="form-group">
                   <label for="txtTen" class="col-sm-2 control-label">Suplier ID(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Suplier ID" readonly value='<?php echo $sup_id; ?>'>
                   </div>
               </div>
               <div class="form-group">
                   <label for="txtTen" class="col-sm-2 control-label">Suplier Name(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Suplier Name" value='<?php echo $sup_name; ?>'>
                   </div>
               </div>

               <div class="form-group">
                   <label for="txtMoTa" class="col-sm-2 control-label">Suplier Phone(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone" value='<?php echo $sup_phone ?>'>
                   </div>
               </div>
               <div class="form-group">
                   <label for="txtMoTa" class="col-sm-2 control-label">Suolier Email(*): </label>
                   <div class="col-sm-10">
                       <input type="text" name="txtmail" id="txtmail" class="form-control" placeholder="Email" value='<?php echo $sup_mail ?>'>
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
            $phone = $_POST["txtPhone"];
            $mail = $_POST["txtmail"];
            $err = "";
            if ($name == "") {
                $err .= "<li> Enter Suplier Name, please</li>";
            }
            if ($err != "") {
                echo "<ul>$err<ul>";
            } else {
                $sq = "SELECT * FROM public.suplier WHERe sup_id <> '$id' and sup_name='$name'";
                $result = pg_query($conn, $sq);
                if (pg_num_rows($result) == 0) {
                    pg_query($conn, " UPDATE public.suplier SET sup_name ='$name', sup_phone = '$phone', sup_mail ='$mail' where sup_id='$id'");
                    echo "<script>alert('Update successfully')</script>";
                    echo '<meta http-equiv="refresh" content="0;URL=?page=managementsup"/>';
                } else {
                    echo "<li>Duplicate Suplier Name </li>";
                }
            }
        }

        ?>


   <?php
    } else {
        echo '<meta http-equiv="refesh" content="0;ULR=sup_management.php"/>';
    }

    ?>