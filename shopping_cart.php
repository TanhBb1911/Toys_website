<?php
include_once('connection.php');
if (isset($_SESSION['us']) == false) {
  echo "<script>alert('You must be Log In')</script>";
  echo '<meta http-equiv="refresh" content="0;URL=?page=login"/>';
} else {

?>
  <?php
  if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
  if (isset($_GET['delcart']) && ($_GET['delcart']) == 1) unset($_SESSION['cart']);
  if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
    array_splice($_SESSION['cart'], $_GET['delid'], 1);
  }

  if (isset($_POST['AddCart']) && ($_POST['AddCart'])) {
    $name = $_POST['ProName'];
    $short = $_POST['Short'];
    $price = $_POST['Price'];
    $img = $_POST['Img'];
    $qty = $_POST['Qty'];

    $check = 0;
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
      if ($_SESSION['cart'][$i][0] == $name) {
        $check = 1;
        $query = $qty + $_SESSION['cart'][$i][2];
        $_SESSION['cart'][$i][2] = $query;
        break;
      }
    }

    if ($check == 0) {
      $cartItem = [$name, $short, $qty, $price, $img];
      $_SESSION['cart'][] = $cartItem;
    }
  }

  function Show()
  {
    if (isset($_SESSION['cart']) && (is_array($_SESSION['cart']))) {
      if (sizeof($_SESSION['cart']) > 0) {
        $sum = 0;
        for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
          $temp = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
          $sum += $temp;

          echo
          '
          <div class="row align-items-center">
          <div class="col-md-3">
            <img src="Image/' . $_SESSION['cart'][$i][4] . ' " class="img-fluid" height="150" width="120">
          </div>
          <div class="col-md-2 d-flex justify-content-center">
          <div>
            <p class="small text-muted mb-4 pb-2">Name</p>
            <p class="lead fw-normal mb-0"><h6 class="text-muted">' . $_SESSION['cart'][$i][0] . '</h6></p>
          </div>
        </div>
          <div class="col-md-2 d-flex justify-content-center">
            <div>
              <p class="small text-muted mb-4 pb-2">Quantity</p>
              <p class="lead fw-normal mb-0">' . $_SESSION['cart'][$i][2] . '</p>
            </div>
          </div>
          <div class="col-md-2 d-flex justify-content-center">
            <div>
              <p class="small text-muted mb-4 pb-2">Price</p>
              <p class="lead fw-normal mb-0">' . $_SESSION['cart'][$i][3] . '$</p>
            </div>
          </div>
          <div class="col-md-2 d-flex justify-content-center">
            <div>
              <p class="small text-muted mb-4 pb-2">Total price:</p>
                          <h4> ' . $temp . '$</h4>           
            </div>
          </div>
          <div class="col-md-1 d-flex justify-content-center">
            <div>
            <a href="?page=cart&&delid=' . $i . '" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
            </div>
          </div>
        </div>
        <hr class="my-4">';
        }

        echo '<div class="card mb-5">
<div class="card-body p-4">
  <div class="float-end">
    <p class="mb-0 me-5 d-flex align-items-center">
      <span class="small text-muted me- 2">Order total:</span> ' . $sum . '$<span class="lead fw-normal"></span>
    </p>
  </div>
</div>
</div>';
      } else {
        echo '<div class="card-body">
                <div class="text-center fw-bold fst-italic">
                    Your cart is empty!
                </div>
            </div>';
      }
    }
  }

  ?>
  <section class="vh-100" style="background-color: #D8D8D8; ">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="card p-5 text-center">
          <p><span class="h2">Shopping Cart </span></p>
          <hr class="my-4">
          <div class="card-body">
          <?php
          Show();
        }
          ?>
          </div>

          <div class="row p-3">
            <div class="col-6">
              <a href="?page=content"> <button type="button" class="btn btn-warning btn-lg text-start">Continue shopping</button></a>
            </div>
            <div class="col-6 text-end">
              <form method="POST">
                <button type="submit" name="btnBuyNowCart" class="btn btn-primary btn-rounded">Buy Now</button>
              </form>
              <?php
              if (isset($_POST['btnBuyNowCart'])) {
                echo "<script>alert('Buying successfully!')</script>";
                
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>