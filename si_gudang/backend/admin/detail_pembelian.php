<?php
include('../../koneksi.php');
session_start();

if(isset($_GET['kd_barang'])){
    $kd_barang = $_GET['kd_barang'];
    $data = mysqli_query($koneksi, "SELECT * FROM tb_barang where kd_barang= '$kd_barang'");
}

$no_pembelian = $_GET['no_pembelian'];
$data2 = mysqli_query($koneksi, "SELECT * FROM detail_pembelian where no_pembelian='$no_pembelian'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Form Transaksi Pembelian (Barang Masuk)</title>
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

                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Detail Transaksi Pembelian Faktur - <?php echo $no_pembelian; ?></h4>
                            <br>

                            <form method="post" action="../../proses.php?no_pembelian=<?php echo $no_pembelian; ?>&action=tambah_detail_pembelian" enctype="multipart/form-data">
                            <?php 
                            if(isset($_GET['kd_barang'])){
                                $data3 = mysqli_query($koneksi, "SELECT * FROM tb_barang where kd_barang='$kd_barang'");
                                foreach($data3 as $d){
                            ?>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nomor Faktur Pembelian</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="no_pembelian" value="<?php echo $no_pembelian; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Kode Barang</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="hidden" name="kd_barang" value="<?php echo $d['kd_barang']; ?>">
                                    <input type="text" class="form-control" name="kd_barang" value="<?php echo $d['kd_barang']; ?>" placeholder="Kode Barang" readonly>
                                    <a href="pembelian_barang.php?no_pembelian=<?php echo $no_pembelian; ?>&action=pilih_barang">
                                      <button class="btn- btn-success" type="button">Cari Barang</button>
                                    </a>
                                </div>
                                <script type="text/javascript">
                                  function tengah(meh)
                                  {
                                    var x = screen.width/2 - 1600/2;
                                    var y = screen.height/2 - 785/2;
                                    window.open(meh.href, 'sharegplus', 'height=785, width=1600, left='+x+', top='+y);
                                  }
                                </script>
                            </div>

                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3">Nama Barang</label>
                              <div class="col-md-4 col-sm-4">
                                <input type="text" class="form-control" name="nama_barang" value="<?php echo $d['nama_barang']; ?>" readonly>
                              </div>
                            </div>

                            <div  class="form-group row">
                              <label class="control-label col-md-3 col-sm-3">Kode Jenis Barang</label>
                              <div class="col-md-4 col-sm-4">
                                <select class="form-control" name="kode_jenis">
                                  <?php if ($d['kode_jenis'] == 'ALT') {?>
                                  <option value="<?php echo $d['kode_jenis']; ?>">Alat Tulis</option>
                                  <?php 
                                  }
                                  ?>
                                  <?php if ($d['kode_jenis'] == 'ARC') {?>
                                  <option value="<?php echo $d['kode_jenis']; ?>">Archiver</option>
                                  <?php
                                  }
                                  ?>
                                  <?php if ($d['kode_jenis'] == 'CET') {?>
                                  <option value="<?php echo $d['kode_jenis']; ?>">Cetakan</option>
                                  <?php 
                                  }
                                  ?>
                                  <?php if ($d['kode_jenis'] == 'HELP') {?>
                                  <option value="<?php echo $d['kode_jenis']; ?>">Helper</option>
                                  <?php 
                                  }
                                  ?>
                                  <?php if ($d['kode_jenis'] == 'KOM') {?>
                                  <option value="<?php echo $d['kode_jenis']; ?>">Komputer</option>
                                  <?php 
                                  }
                                  ?>
                                </select>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3">Jumlah Barang</label>
                              <div class="col-md-4 col-sm-4">
                                <input type="text" class="form-control" name="jumlah_barang" placeholder="Jumlah Barang">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3">Stok Saat ini</label>
                              <div class="col-md-4 col-sm-4">
                                <input type="text" class="form-control" value="<?php echo $d['stok']; ?>">
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="control-label col-md-3 col-sm-3">Harga Barang</label>
                              <div class="col-md-4 col-sm-4">
                                <input type="text" class="form-control" name="harga_barang" value="<?php echo $d['harga_beli']; ?>" readonly>
                              </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <a href="transaksi_pembelian.php">
                                        <button type="button" class="btn btn-danger">Cancel</button>
                                    </a>
                                </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <?php
                    }
                    } else
                    { 
                    ?>

                    <form method="post" action="../../proses.php?no_pembelian=<?php echo $no_pembelian; ?>&action=tambah_detail_pembelian" enctype="multipart/form-data"></form>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Nomor Faktur Pembelian</label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="no_pembelian"  value="<?php echo $no_pembelian; ?>" readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Kode Barang</label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="kd_barang" value="-" placeholder="Kode Barang" readonly>
                        <a href="pembelian_barang.php?no_pembelian=<?php echo $no_pembelian; ?>&action=pilih_barang">Cari Barang</a>
                      </div>
                      <script type="text/javascript">
                        function tengah(meh)
                        {
                          var x = screen.width/2 - 1600/2;
                          var y = screen.height/2 - 785/2;
                          window.open(meh.href, 'sharegplus', 'height=785, width=1600, left='+x+', top='+y);
                        }
                      </script>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Nama Barang</label>
                      <div class="col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="nama_barang" value="-" readonly>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Kode Jenis Barang</label>
                      <div class="col-md-6 col-sm-6">
                        <select class="form-control" name="kode_jenis">
                          <option value="ALT">Alat Tulis</option>
                          <option value="ARC">Archiver</option>
                          <option value="CET">Cetakan</option>
                          <option value="HELP">Helper</option>
                          <option value="KOM">Komputer</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Jumlah Barang</label>
                      <div class="col-md-4 col-sm-4">
                        <input type="text" class="form-control" name="jumlah_barang" placeholder="Jumlah Barang">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Stok Saat ini</label>
                      <div class="col-md-3 col-sm-3">
                        <input type="text" class="form-control" value="-">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3 col-sm-3">Harga Barang</label>
                      <div class="col-md-5 col-sm-5">
                        <input type="text" class="form-control" name="harga_barang" value="-" readonly>
                      </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-9 col-sm-9 offset-md-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                        <a href="transaksi_pembelian.php">
                        <button type="button" class="btn btn-danger">Cancel</button>
                        </a>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

              <?php
                    }
              ?>

              <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><h3>Data Detail Transaksi Pembelian</h3></h4>
                            <p class="card-description">
                            </p>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="6%">No</th>
                                            <th width="16%">No Faktor Pembelian</th>
                                            <th width="16%">Kode Barang</th>
                                            <th width="16%">Nama Barang</th>
                                            <th width="15%">Kode Jenis</th>
                                            <th width="15%">Jenis</th>
                                            <th width="15%">Jumlah Barang</th>
                                            <th width="7%">Harga Barang</th>
                                            <th width="7%">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $data = mysqli_query($koneksi,"select * from detail_pembelian where no_pembelian = '$no_pembelian' order by no_pembelian desc");
                                            $detail_pembelian = mysqli_query($koneksi, "SELECT a.no_pembelian as no_pembelian, a.kd_barang as kd_barang, a.kode_jenis as kode_jenis, a.jumlah_barang as jumlah_barang, a.harga_barang as harga_barang, a.total_harga as total_harga, b.nama_barang as nama_barang, c.jenis FROM detail_pembelian as a, tb_barang as b, tb_jenis as c WHERE a.kd_barang = b.kd_barang AND b.kode_jenis = c.kode_jenis AND no_pembelian = '$no_pembelian' ORDER BY no_pembelian DESC");
                                           

                                            $halaman = 5;
                                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                                            $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                                            $query_mysql = mysqli_query($koneksi, "SELECT a.no_pembelian as no_pembelian, a.kd_barang as kd_barang, a.kode_jenis as kode_jenis, a.jumlah_barang as jumlah_barang, a.harga_barang as harga_barang, a.total_harga as total_harga, b.nama_barang as nama_barang, c.jenis FROM detail_pembelian as a, tb_barang as b, tb_jenis as c WHERE a.kd_barang = b.kd_barang AND b.kode_jenis = c.kode_jenis AND no_pembelian = '$no_pembelian' ORDER BY no_pembelian DESC");
                                            $total = mysqli_num_rows($query_mysql);
                                            $pages = ceil($total/$halaman);
                                            $query = mysqli_query($koneksi,"SELECT a.no_pembelian as no_pembelian, a.kd_barang as kd_barang, a.kode_jenis as kode_jenis, a.jumlah_barang as jumlah_barang, a.harga_barang as harga_barang, a.total_harga as total_harga, b.nama_barang as nama_barang, c.jenis FROM detail_pembelian as a, tb_barang as b, tb_jenis as c WHERE a.kd_barang = b.kd_barang AND b.kode_jenis = c.kode_jenis AND no_pembelian = '$no_pembelian' ORDER BY no_pembelian DESC LIMIT $mulai, $halaman") or die(mysqli_error($koneksi));
                                            $nomor = $mulai+1;
                                            while($d = mysqli_fetch_array($query)){
                                            $harga_barang = "Rp " . number_format($d['harga_barang'],2,',','.');
                                            $total_harga = "Rp " . number_format($d['total_harga'],2,',','.');
                                        ?>

                                        <tr>
                                            <td><?php echo $nomor++; ?></td>
                                            <td><?php echo $d['no_pembelian']; ?></td>
                                            <td><?php echo $d['kd_barang']; ?></td>
                                            <td><?php echo $d['nama_barang']; ?></td>
                                            <td><?php echo $d['kode_jenis']; ?></td>
                                            <td><?php echo $d['jenis']; ?></td>
                                            <td><?php echo $d['jumlah_barang']; ?></td>
                                            <td><?php echo $harga_barang; ?></td>
                                            <td><?php echo $total_harga; ?></td>
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