</script>
    <?php
    include_once("connection.php");
    if (isset($_POST['btnlogin'])) {
      $us = $_POST['username'];
      $pa = $_POST['password'];
      $err = "";
      if ($us == "") {
        $err .= "Enter Username, please<br/>";
      }
      if ($pa == "") {
        $err .= "Enter Password, please<br/>";
      }
      if ($err != "") {
        echo $err;
      } else {
        $pass = md5($pa);
        $res = pg_query($conn, "SELECT username, password, role FROM public.user WHERE username = '$us' AND password = '$pass'") or die(($conn));
        $row = pg_fetch_array($res);
        if (pg_num_rows($res) == true) {
          $_SESSION['us'] = $us;
          $_SESSION['admin'] = $row['role'];
          echo "<script>alert('You are login Successfully')</script>";
          echo '<meta http-equiv="refresh" content="0;URL=index.php" />';
        } else {
          echo "<script>alert('You are login fail, Please check your password or user name')</script>";
        }
      }
    }
    ?>
    <section class="vh-100">
      <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="Image/login.jpg" class="img-fluid my-3">
            <link rel="stylesheet" href="CSS/style.css">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form name="login" method="POST">
              <h2 align="center">Sign in at Bb Center</h2>
              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0 mt-5"></p>
              </div>

              <!-- Username input -->
              <div class="form-outline mb-4">
                <input type="text" name="username" id="usname" class="form-control form-control-lg" placeholder="Enter Username" />
                <label class="form-label" for="inputus">Username</label>
              </div>

              <!-- Password input -->
              <div class="form-outline mb-3">
                <input type="password" name="password" id="pasword" class="form-control form-control-lg" placeholder="Enter password" />
                <label class="form-label" for="inputpas">Password</label>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mb-0">
                  <input class="form-check-input me-2" type="checkbox" value="" id="txtus" />
                  <label class="form-check-label" for="form2Example3">
                    Remember me
                  </label>
                </div>
                <a href="#!" class="text-body">Forgot password?</a>
              </div>

              <div class="text-center text-lg-start mt-4 pt-2">
                <button type="submit" name="btnlogin" class="btn btn-primary btn-lg" name="btnlogin" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="?page=register" class="link-danger">Register</a></p>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>
