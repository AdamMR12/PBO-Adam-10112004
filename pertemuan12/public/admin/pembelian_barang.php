<?php
// Cek session sebelum start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../app/classes/database.php';
require_once __DIR__ . '/../crud/admin/read.php';

// Ambil parameter dari URL (dari halaman transaksi_pembelian.php)
$no_faktur_from_url = isset($_GET['no_pembelian']) ? $_GET['no_pembelian'] : '';
$supplier_from_url = isset($_GET['supplier']) ? $_GET['supplier'] : '';
$tanggal_from_url = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');

// Generate nomor faktur otomatis jika tidak ada dari URL
if (!empty($no_faktur_from_url)) {
    $no_faktur = $no_faktur_from_url;
} else {
    $no_faktur = generateNoFaktur();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin - Tambah Detail Pembelian</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../assets/template/spica/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/template/spica/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/template/spica/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/template/spica/images/favicon.png" />
  
  <!-- Tambahan CSS untuk modal lookup -->
  <style>
    .lookup-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }
    .lookup-modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 900px;
        border-radius: 10px;
    }
    .lookup-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }
    .lookup-close:hover {
        color: black;
    }
    .lookup-search {
        margin-bottom: 15px;
    }
    .lookup-table tbody tr {
        cursor: pointer;
    }
    .lookup-table tbody tr:hover {
        background-color: #f0f0f0;
    }
    #alertMessage {
        display: none;
    }
  </style>
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
      <?php
      include('navbar.php');
      ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Form Transaksi Pembelian (Barang Masuk)</h4>
                  <div id="alertMessage" class="alert"></div>
                  <form class="forms-sample" id="formPembelian">
                    
                    <!-- Nomor Faktur Pembelian (Readonly) -->
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Nomor Faktur Pembelian</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="<?= htmlspecialchars($no_faktur) ?>" readonly>
                      </div>
                    </div>
                    
                    <!-- Tanggal Pembelian -->
                    <div class="form-group row">
                      <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal pembelian</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= htmlspecialchars($tanggal_from_url) ?>" required>
                      </div>
                    </div>
                    
                    <!-- Supplier -->
                    <div class="form-group row">
                      <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                      <div class="col-sm-9">
                        <?php
                            $db = new Database();
                            $conn = $db->getConnection();
                            
                            // Query supplier dari tb_supplier
                            $query_supplier = "SELECT id_supplier, nama_supplier FROM tb_supplier ORDER BY nama_supplier ASC";
                            $result_supplier = $conn->query($query_supplier);
                            $suppliers = [];
                            if ($result_supplier && $result_supplier->num_rows > 0) {
                                while ($row = $result_supplier->fetch_assoc()) {
                                    $suppliers[] = $row;
                                }
                            }
                            $db->closeConnection();
                        ?>
                        <select name="supplier" id="supplier" class="form-control" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach($suppliers as $supplier): ?>
                                <option value="<?php echo $supplier['id_supplier']; ?>"
                                    <?php echo ($supplier_from_url == $supplier['id_supplier']) ? 'selected' : ''; ?>>
                                    <?php echo $supplier['id_supplier'] . ' - ' . $supplier['nama_supplier']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    
                    <hr>
                    <h5 class="mb-3">Detail Barang</h5>
                    
                    <!-- Kode Barang (Readonly + Lookup) -->
                    <div class="form-group row">
                      <label for="kd_barang" class="col-sm-3 col-form-label">Kode Barang</label>
                      <div class="col-sm-7">
                        <input type="text" class="form-control" id="kd_barang" name="kd_barang" readonly placeholder="Klik tombol Cari untuk memilih barang...">
                      </div>
                      <div class="col-sm-2">
                        <button type="button" class="btn btn-primary btn-sm" onclick="openLookupModal()">
                          <i class="mdi mdi-magnify"></i> Cari
                        </button>
                      </div>
                    </div>
                    
                    <!-- Nama Barang (Readonly) -->
                    <div class="form-group row">
                      <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                      </div>
                    </div>
                    
                    <!-- Kode Jenis Barang (Readonly) -->
                    <div class="form-group row">
                      <label for="kode_jenis" class="col-sm-3 col-form-label">Kode Jenis Barang</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_jenis" name="kode_jenis" readonly>
                      </div>
                    </div>
                    
                    <!-- Jumlah Barang -->
                    <div class="form-group row">
                      <label for="jumlah_barang" class="col-sm-3 col-form-label">Jumlah Barang</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="1" min="1" onchange="hitungTotal()" required>
                      </div>
                    </div>
                    
                    <!-- Stok Saat Ini (Readonly) -->
                    <div class="form-group row">
                      <label for="stok_saat_ini" class="col-sm-3 col-form-label">Stok Saat Ini</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="stok_saat_ini" name="stok_saat_ini" readonly>
                      </div>
                    </div>
                    
                    <!-- Harga Barang (Readonly) -->
                    <div class="form-group row">
                      <label for="harga_barang" class="col-sm-3 col-form-label">Harga Barang (Satuan)</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_barang_display" readonly>
                        <input type="hidden" id="harga_barang" name="harga_barang">
                      </div>
                    </div>
                    
                    <!-- Total Harga (Readonly) -->
                    <div class="form-group row">
                      <label for="total_harga" class="col-sm-3 col-form-label">Total Harga</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="total_harga_display" readonly>
                        <input type="hidden" id="total_harga" name="total_harga">
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary me-2">
                      <i class="mdi mdi-content-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-light" onclick="window.location.href='transaksi_pembelian.php'">
                      <i class="mdi mdi-arrow-left"></i> Kembali
                    </button>
                  </form>
                </div>
              </div>
            </div>
            
            <!-- Lookup Modal -->
            <div id="lookupModal" class="lookup-modal">
              <div class="lookup-modal-content">
                <span class="lookup-close" onclick="closeLookupModal()">&times;</span>
                <h4 class="mb-3">Pilih Barang</h4>
                <div class="lookup-search">
                  <input type="text" class="form-control" id="searchBarang" placeholder="Cari kode atau nama barang..." onkeyup="filterBarang()">
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                  <table class="table table-hover lookup-table">
                    <thead>
                      <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Harga</th>
                      </tr>
                    </thead>
                    <tbody id="lookupTableBody">
                      <!-- Data akan diisi via JavaScript -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
            <!-- Tabel Detail Pembelian (untuk no_faktur ini) -->
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Detail Pembelian - <?= htmlspecialchars($no_faktur) ?></h4>
                  <p class="card-description">Daftar barang dalam transaksi ini</p>
                  <div id="tableAlert" style="display:none;" class="alert"></div>
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="tabelDetail">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Jenis</th>
                          <th>Jumlah</th>
                          <th>Harga Satuan</th>
                          <th>Total Harga</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="detailTableBody">
                        <tr>
                          <td colspan="8" class="text-center">Memuat data...</td>
                        </tr>
                      </tbody>
                    </table>
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
  <script src="../assets/template/spica/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="../assets/template/spica/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/template/spica/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../assets/template/spica/js/off-canvas.js"></script>
  <script src="../assets/template/spica/js/hoverable-collapse.js"></script>
  <script src="../assets/template/spica/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../assets/template/spica/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  
  <script>
    // Data barang dari database
    let dataBarang = [];
    const noFaktur = '<?= htmlspecialchars($no_faktur) ?>';
    
    // Fungsi untuk menampilkan alert
    function showAlert(message, type, elementId = 'alertMessage') {
        const alert = document.getElementById(elementId);
        alert.className = `alert alert-${type}`;
        alert.innerHTML = message;
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    }
    
    // Ambil data barang dari server (gunakan crud/get_barang.php)
    function loadDataBarang() {
        fetch('../crud/get_barang.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Server error:', data.error);
                    showAlert('Gagal memuat data barang: ' + data.error, 'danger');
                    return;
                }
                dataBarang = data;
                renderLookupTable(dataBarang);
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Gagal memuat data barang. Periksa koneksi database.', 'danger');
            });
    }
    
    // Load detail pembelian untuk no_faktur ini
    function loadDetailPembelian() {
        fetch(`../crud/admin/read.php?action=api&no_pembelian=${encodeURIComponent(noFaktur)}`)
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('detailTableBody');
                
                if (data.error) {
                    tbody.innerHTML = '<tr><td colspan="8" class="text-center text-danger">Error: ' + data.error + '</td></tr>';
                    return;
                }
                
                if (!data.details || data.details.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="8" class="text-center">Belum ada detail barang</td></tr>';
                    return;
                }
                
                let html = '';
                let totalKeseluruhan = 0;
                
                data.details.forEach((item, index) => {
                    totalKeseluruhan += parseFloat(item.total_harga);
                    html += `
                        <tr id="detail-row-${item.no_item}">
                            <td>${index + 1}</td>
                            <td>${item.kd_barang}</td>
                            <td>${item.nama_barang || '-'}</td>
                            <td>${item.jenis || '-'}</td>
                            <td>${Number(item.jumlah_barang).toLocaleString('id-ID')}</td>
                            <td>Rp ${Number(item.harga_barang).toLocaleString('id-ID')}</td>
                            <td>Rp ${Number(item.total_harga).toLocaleString('id-ID')}</td>
                            <td>
                                <button class="btn btn-sm btn-danger" onclick="deleteDetail(${item.no_item})" title="Hapus">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                
                // Tambah total
                html += `
                    <tr class="table-info font-weight-bold">
                        <td colspan="6" class="text-right">Total Keseluruhan</td>
                        <td>Rp ${totalKeseluruhan.toLocaleString('id-ID')}</td>
                        <td></td>
                    </tr>
                `;
                
                tbody.innerHTML = html;
            })
            .catch(error => {
                document.getElementById('detailTableBody').innerHTML = 
                    '<tr><td colspan="8" class="text-center text-danger">Error: ' + error.message + '</td></tr>';
            });
    }
    
    // Render tabel lookup
    function renderLookupTable(data) {
        const tbody = document.getElementById('lookupTableBody');
        if (!data || data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">Tidak ada data barang</td></tr>';
            return;
        }
        
        tbody.innerHTML = '';
        data.forEach(item => {
            const tr = document.createElement('tr');
            tr.onclick = function() { pilihBarang(item); };
            tr.innerHTML = `
                <td>${item.kd_barang}</td>
                <td>${item.nama_barang}</td>
                <td>${item.jenis || '-'}</td>
                <td>${item.stok}</td>
                <td>Rp ${Number(item.harga).toLocaleString('id-ID')}</td>
            `;
            tbody.appendChild(tr);
        });
    }
    
    // Filter barang
    function filterBarang() {
        const keyword = document.getElementById('searchBarang').value.toLowerCase();
        const filtered = dataBarang.filter(item => 
            item.kd_barang.toLowerCase().includes(keyword) || 
            item.nama_barang.toLowerCase().includes(keyword) ||
            (item.jenis && item.jenis.toLowerCase().includes(keyword))
        );
        renderLookupTable(filtered);
    }
    
    // Pilih barang
    function pilihBarang(item) {
        document.getElementById('kd_barang').value = item.kd_barang;
        document.getElementById('nama_barang').value = item.nama_barang;
        document.getElementById('kode_jenis').value = item.kode_jenis || '';
        document.getElementById('stok_saat_ini').value = item.stok;
        document.getElementById('harga_barang_display').value = 'Rp ' + Number(item.harga).toLocaleString('id-ID');
        document.getElementById('harga_barang').value = item.harga;
        closeLookupModal();
        hitungTotal();
    }
    
    // Hitung total
    function hitungTotal() {
        const harga = parseFloat(document.getElementById('harga_barang').value) || 0;
        const jumlah = parseInt(document.getElementById('jumlah_barang').value) || 1;
        
        if (harga > 0) {
            const total = harga * jumlah;
            document.getElementById('total_harga_display').value = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('total_harga').value = total;
        } else {
            document.getElementById('total_harga_display').value = '';
            document.getElementById('total_harga').value = '';
        }
    }
    
    // Modal functions
    function openLookupModal() {
        document.getElementById('lookupModal').style.display = 'block';
        document.getElementById('searchBarang').value = '';
        if (dataBarang.length === 0) {
            loadDataBarang();
        } else {
            renderLookupTable(dataBarang);
        }
    }
    
    function closeLookupModal() {
        document.getElementById('lookupModal').style.display = 'none';
    }
    
    window.onclick = function(event) {
        const modal = document.getElementById('lookupModal');
        if (event.target == modal) {
            closeLookupModal();
        }
    }
    
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeLookupModal();
        }
    });
    
    // Submit form menggunakan CRUD create.php
    document.getElementById('formPembelian').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const kdBarang = document.getElementById('kd_barang').value;
        const supplier = document.getElementById('supplier').value;
        
        if (!supplier) {
            showAlert('Silakan pilih supplier terlebih dahulu!', 'warning');
            return;
        }
        
        if (!kdBarang) {
            showAlert('Silakan pilih barang terlebih dahulu!', 'warning');
            return;
        }
        
        // Siapkan FormData
        const formData = new FormData(this);
        
        // Submit ke crud/create.php
        fetch('../crud/create.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                resetFormBarang();
                loadDetailPembelian(); // Refresh tabel detail
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            showAlert('Error: ' + error.message, 'danger');
        });
    });
    
    // Reset form barang (pertahankan no_faktur, tanggal, supplier)
    function resetFormBarang() {
        document.getElementById('kd_barang').value = '';
        document.getElementById('nama_barang').value = '';
        document.getElementById('kode_jenis').value = '';
        document.getElementById('jumlah_barang').value = '1';
        document.getElementById('stok_saat_ini').value = '';
        document.getElementById('harga_barang_display').value = '';
        document.getElementById('harga_barang').value = '';
        document.getElementById('total_harga_display').value = '';
        document.getElementById('total_harga').value = '';
    }
    
    // Hapus detail menggunakan CRUD delete.php
    function deleteDetail(noItem) {
        if (!confirm('Yakin ingin menghapus detail barang ini?')) {
            return;
        }
        
        const formData = new FormData();
        formData.append('no_item', noItem);
        
        fetch('../crud/delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success', 'tableAlert');
                loadDetailPembelian(); // Refresh tabel
            } else {
                showAlert(data.message, 'danger', 'tableAlert');
            }
        })
        .catch(error => {
            showAlert('Error: ' + error.message, 'danger', 'tableAlert');
        });
    }
    
    // Load data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        loadDataBarang();
        loadDetailPembelian();
        // Set tanggal default jika belum ada
        if (!document.getElementById('tanggal_pembelian').value) {
            document.getElementById('tanggal_pembelian').value = new Date().toISOString().split('T')[0];
        }
    });
  </script>
</body>
</html>