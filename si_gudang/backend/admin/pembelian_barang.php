<?php
include('../../koneksi.php');
session_start();


if (isset($_GET['no_pembelian'])) {
    $no_pembelian = $_GET['no_pembelian'];
    $data = mysqli_query($koneksi, "SELECT * FROM detail_pembelian WHERE no_pembelian='$no_pembelian'");
} else {
    // Tangani jika parameter tidak tersedia, misal:
    $no_pembelian = '';
    $data = null;
    // Optional: tampilkan pesan error atau redirect
    echo "<p style='color:red;'>Parameter no_pembelian tidak ditemukan di URL.</p>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Data Barang</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../assets/template/spica/template/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/template/spica/template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../assets/template/spica/template/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../assets/template/spica/template/images/favicon.png" />
</head>

<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <?php include('navbar.php'); ?>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:./partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="navbar-brand-wrapper">
            <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
          </div>
          <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1">Welcome <?php echo $_SESSION['tipe_user']?></h4>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item">
              <h4 class="mb-0 font-weight-bold d-none d-xl-block">Mar 12, 2019 - Apr 10, 2019</h4>
            </li>
            <li class="nav-item dropdown me-1">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-calendar mx-0"></i>
                <span class="count bg-info">2</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="../../assets/template/spica/template/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      The meeting is cancelled
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="../../assets/template/spica/template/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      New product launch
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                      <img src="../../assets/template/spica/template/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                      Upcoming board meeting
                    </p>
                  </div>
                </a>
              </div>
            </li>
            <li class="nav-item dropdown me-2">
              <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-email-open mx-0"></i>
                <span class="count bg-danger">1</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-information mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Just now
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      Private message
                    </p>
                  </div>
                </a>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                      2 days ago
                    </p>
                  </div>
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
        <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
          <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Here..." aria-label="search" aria-describedby="search">
              </div>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="../../assets/template/spica/template/images/faces/face5.jpg" alt="profile"/>
                <span class="nav-profile-name">Eleanor Richardson</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item">
                  <i class="mdi mdi-settings text-primary"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="logout.php">
  <i class="mdi mdi-logout text-primary"></i>
  Logout
</a>

              </div>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link icon-link">
                <i class="mdi mdi-plus-circle-outline"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link icon-link">
                <i class="mdi mdi-web"></i>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link icon-link">
                <i class="mdi mdi-clock-outline"></i>
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><h3>Pilih Data Barang</h3></h4>
                            <p class="card-description">
                                <div align="right">
                                    <a href="detail_pembelian.php?no_pembelian=<?php echo $no_pembelian; ?>&action=detail_pembelian"><button class="btn btn-danger" type="button">Kembali</button>
                                    </a>
                                </div>
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="6%">No</th>
                                            <th width="16%">Kode Barang</th>
                                            <th width="16%">Kode Jenis</th>
                                            <th width="15%">Nama Barang</th>
                                            <th width="7%">Stok</th>
                                            <th width="13%">Harga Beli</th>
                                            <th width="14%">Harga Jual</th>
                                            <th width="16%">Gambar Produk</th>
                                            <th width="13%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include ("../../koneksi.php");
                                            $halaman = 10;
                                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                                            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                                            $query_mysql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                                            $total = mysqli_num_rows($query_mysql);
                                            $pages = ceil($total/$halaman);
                                            $query = mysqli_query($koneksi, "SELECT * FROM tb_barang LIMIT $mulai, $halaman") or die(mysqli_error());
                                            $nomor = $mulai+1;
                                            while($data = mysqli_fetch_array($query)){
                                        ?>

                                        <tr>
                                            <td><?php echo $nomor++; ?></td>
                                            <td><?php echo $data['kd_barang']; ?></td>
                                            <td><?php echo $data['kode_jenis']; ?></td>
                                            <td><?php echo $data['nama_barang']; ?></td>
                                            <td><?php echo $data['nama_barang']; ?></td>
                                            <td><?php echo $data['stok']; ?></td>
                                            <td><?php $rpharga_beli = "Rp ". number_format($data['harga_beli'],2,',','.'); echo $rpharga_beli; ?></td>
                                            <td><?php $rpharga_jual = "Rp ". number_format($data['harga_jual'],2,',','.'); echo $rpharga_jual; ?></td>
                                            <td><img src="gambar/<?php echo $data['gambar_produk']; ?>" style="width: 120px;"></td>
                                            <td><a href="detail_pembelian.php?kd_barang=<?php echo $data['kd_barang']; ?>&no_pembelian=<?php echo $no_pembelian; ?>"><button class="btn btn-primary" type="button">Pilih</button></a></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <br>
                                <div align="center">
                                    <?php for ($i=1; $i<=$pages; $i++){  ?>

                                        <a href="?halaman=<?php echo $i; ?>">
                                            <div class="btn-group pb-2 pb-lg-0" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-primary"><?php echo $i; ?></button>
                                            </div>
                                        </a>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:./partials/_footer.html -->
        <footer class="footer">
          <div class="card">
            <div class="card-body">
              <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com </a>2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a> templates</span>
              </div>
            </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- base:js -->
  <script src="../../assets/template/spica/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../../assets/template/spica/template/vendors/chart.js/Chart.min.js"></script>
  <script src="../../assets/template/spica/template/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../../assets/template/spica/template/js/off-canvas.js"></script>
  <script src="../../assets/template/spica/template/js/hoverable-collapse.js"></script>
  <script src="../../assets/template/spica/template/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
    <script src="../../assets/template/spica/template/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="../../assets/template/spica/template/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>