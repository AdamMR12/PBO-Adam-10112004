<?php
include("../../koneksi.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Halaman <?php echo $_SESSION['tipe_user'] ?> </title>
    <!-- base:css -->
    <!-- ../../assets/template/spica/template/ -->
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
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                    <div class="ps-lg-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                            <a href="https://www.bootstrapdash.com/product/spica-admin/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="https://www.bootstrapdash.com/product/spica-admin/"><i class="mdi mdi-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="mdi mdi-close text-white mr-0"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:./partials/_sidebar.html -->
        <?php include("navbar.php"); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="">
                        <!-- input  -->
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Default form</h4>
                                    <p class="card-description">
                                        Basic form layout
                                    </p>
                                    <form class="forms-sample" method="post" action="../../proses.php?action=add">

                                        <div class="form-group">
                                            <label for="kd_barang">Kode Barang</label>
                                            <input type="text" class="form-control" id="kd_barang" placeholder="kode barang" name="kd_barang">
                                        </div>

                                        <div class="form-group">
                                            <label for="kode_jenis">Kode jenis Barang</label>
                                            <select class="form-control" id="kode_jenis" name="kode_jenis">
                                            <?php
                                            include "../../koneksi.php";
                                            $query_mysql = mysqli_query($koneksi, "SELECT * FROM tb_jenis");
                                            $nomor = 1;
                                            while ($data = mysqli_fetch_array($query_mysql)) {
                                            ?>
                                                <option value="<?php echo $data["kode_jenis"]; ?>">
                                                <?php echo $data["kode_jenis"]." - ".$data["jenis"]; ?>
                                                </option>
                                        <?php } ?>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text" class="form-control" id="nama_barang" placeholder="nama barang" name="nama_barang">
                                        </div>


                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" id="stok" placeholder="0" name="stok">
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_beli">harga beli</label>
                                            <input type="text" class="form-control" id="harga_beli" placeholder="nama barang" name="harga_beli">
                                        </div>

                                        <div class="form-group">
                                            <label for="harga_jual">harga jual</label>
                                            <input type="text" class="form-control" id="harga_jual" placeholder="harga beli" name="harga_jual">
                                        </div>


                                        <div class="form-group">
                                            <label for="gambar_produk">gambar produk</label>
                                            <input type="file" class="form-control" id="gambar_produk" placeholder="gambar produk" name="gambar_produk">
                                        </div>

                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                                        <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- tabel -->
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Inverse table</h4>
                                    <p class="card-description">
                                        <!-- Add class <code>.table-dark</code> -->
                                    </p>
                                    <div class="table-responsive pt-3">
                                        <table class="table ">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        No
                                                    </th>
                                                    <th>
                                                        Kode Barang
                                                    </th>
                                                    <th>
                                                        Kode Jenis
                                                    </th>
                                                    <th>
                                                        Nama Barang
                                                    </th>
                                                    <th>
                                                        Stok
                                                    </th>
                                                    <th>
                                                        Harga Beli
                                                    </th>
                                                    <th>
                                                        Harga Jual
                                                    </th>
                                                    <th>
                                                        Gambar Produk
                                                    </th>

                                                </tr>
                                            </thead>
                                            <?php
                                            include "../../koneksi.php";
                                            $query_mysql = mysqli_query($koneksi, "SELECT * FROM tb_barang");
                                            $nomor = 1;
                                            while ($data = mysqli_fetch_array($query_mysql)) {
                                            ?>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <?php echo $nomor++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data["kd_barang"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data["kode_jenis"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data["nama_barang"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data["stok"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data["harga_beli"]; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $data["harga_jual"]; ?>
                                                        </td>
                                                        <td>
                                                            <img style="width: 200px; height: 100%; border-radius: 0px;" src="
                                                                <?php echo $data["gambar_produk"]; ?>
                                                            " alt="">
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            <?php } ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:../../partials/_footer.html -->
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