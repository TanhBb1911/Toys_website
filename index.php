<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bb Store</title>
  <!--Boostrap-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">


  <!--fontawesome-->
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>


  <link rel="stylesheet" href="CSS/style.css">
</head>


<body>
  <!--container-->
  <div class="">
    <!--/container-->
    <?php
    session_start();
    include_once("connection.php");
    ?>
    <!--Navagition-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-4 ">
      <div class="container-fluid mx-md-5 row">
        <div class="col-2">
          <a href="index.php"><img src="Image/logo1.png" class="logo" alt="Logo" >
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </a>
        </div>

        <div class="collapse navbar-collapse col-auto justify-content-center" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=content">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=about">About</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="?page=search&&gender=Men">Men</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=search&&gender=Women">Women</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="?page=management">Management133</a>
            </li>
            <li class="nav-item">
              <a href="?page=cart" class="nav-link bi bi-bag">Cart</a>
            </li>

            <?php
            if (isset($_SESSION['us']) && $_SESSION['us'] != "") {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="?page=updatecus" id="btnUser"><i class="glyphicon glyphicon-user" style="margin-left:50px"></i> Welcome, <?php echo $_SESSION['us'] ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=logout" id="btnlogout" class="glyphicon glyphicon-log-out">Logout <i class="bi bi-box-arrow-right"></i></a>
              </li>
            <?php
            } else {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="?page=register" id="btnRegister" style="margin-left:25px">Register&nbsp;<i class="bi bi-person-plus"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="?page=login" id="btnLogin">Login&nbsp;<i class="bi bi-box-arrow-in-right"></i></a>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
    </nav>


    <?php
    if (isset($_GET['page'])) {
      $page = $_GET['page'];
      if ($page == "register") {
        include_once("register.php");
      } elseif ($page == "login") {
        include_once("login.php");
      } elseif ($page == "content") {
        include_once("content.php");
      } elseif ($page == "updatecus") {
        include_once("update_cus.php");
      } elseif ($page == "management") {
        include_once("category_management.php");
      } elseif ($page == "addcategory") {
        include_once("add_category.php");
      } elseif ($page == "updatecategory") {
        include_once("update_category.php");
      } elseif ($page == "managementpro") {
        include_once("product_management.php");
      } elseif ($page == "addproduct") {
        include_once("add_product.php");
      } elseif ($page == "updateproduct") {
        include_once("update_product.php");
      } elseif ($page == "search") {
        include_once("searchbrand.php");
      } elseif ($page == "viewdetail") {
        include_once("view_detail.php");
      } elseif ($page == "logout") {
        include_once("logout.php");
      } elseif ($page == "about") {
        include_once("about.php");
      } elseif ($page == "cart") {
        include_once("shopping_cart.php");
      }elseif ($page == "addsup") {
        include_once("add_sup.php");
      }elseif ($page == "updatesup") {
        include_once("update_sup.php");
      }elseif ($page == "managementsup") {
        include_once("sup_management.php");
      }elseif ($page == "addshop") {
        include_once("add_shop.php");
      }elseif ($page == "updateshop") {
        include_once("update_shop.php");
      }elseif ($page == "managementshop") {
        include_once("shop_management.php");
      }
    } else {
      include_once("Introduction.php");
    }
    ?>


    <!-- Footer boostrap -->
    <footer class="text-center text-lg-start bg-light text-muted">  
      <!-- Section: Social media -->
      <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
        <!-- Left -->
        <div class="me-5 d-none d-lg-block">
          <span><b>Connected with us on social networks:</b> </span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
          <a href="https://www.facebook.com/t.anhnguyen191102" target="_blank" class="me-4 text-reset">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/t_anh1911/?igshid=YmMyMTA2M2Y=&fbc
      lid=IwAR2m7oY4OGLq2pnRMCB-KnVi70SBlZ-MjAzz0cgZn2RtvDC-8YfsfM0UoUc" target="_blank" class="me-4 text-reset">
            <i class="fab fa-instagram"></i>
          </a>
        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links  -->
      <section class="">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold mb-4">
                <i class="fas fa-gem me-3"></i>Bb Center
              </h6>
              <p>
                Product quality and customer experience is the goal we always aim to develop.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4">
                Brands
              </h6>
              <p>
                <a href="#!" class="text-reset">Zenith</a>
              </p>
              <p>
                <a href="#!" class="text-reset"> Breitling</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Tissot</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Certina</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4">
                Useful links
              </h6>
              <p>
                <a href="#!" class="text-reset">Sign In</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Create an Account</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Feedback</a>
              </p>
              <p>
                <a href="#!" class="text-reset">Help</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold mb-4">
                Contact
              </h6>
              <p><i class="fas fa-home me-3"></i>3379, NinhKieu, CanTho</p>
              <p>
                <i class="fas fa-envelope me-3"></i>
                anhntgcc200302@fpt.edu.vn
              </p>
              <p><i class="fas fa-phone me-3"></i> + 84 704 725 944</p>
              <p><i class="fas fa-phone me-3"></i> + 84 939 449 072</p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->
    </footer>
    <!-- Footer -->
    <script type="text/javascript">
      $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
      });
    </script>
</body>
</div>

</html>





