<?php
session_start();
require_once '../../app/classes/database.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin - Login</title>
  <link rel="stylesheet" href="../assets/template/spica/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/template/spica/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/template/spica/css/style.css">
  <link rel="shortcut icon" href="../assets/template/spica/images/favicon.png" />
</head>
<body>
  <div class="container-scroller d-flex">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../assets/template/spica/images/logo-dark.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              
              <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <?php echo $error; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
              
              <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <?php echo $success; ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <?php endif; ?>
              
              <form class="pt-3" method="POST" action="prosesLogin.php">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" name="remember" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="forgot_password.php" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook me-2"></i>Connect using facebook
                  </button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script src="../assets/template/spica/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/template/spica/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../assets/template/spica/js/off-canvas.js"></script>
  <script src="../assets/template/spica/js/hoverable-collapse.js"></script>
  <script src="../assets/template/spica/js/template.js"></script>
</body>
</html>