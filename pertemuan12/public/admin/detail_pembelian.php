<?php
session_start();
require_once __DIR__ . '../../crud/admin/read.php';

// Ambil data untuk tabel
$data_detail_pembelian = getDetailPembelian();

// Generate nomor faktur
$no_faktur = generateNoFaktur();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin - Transaksi Pembelian</title>
  <link rel="stylesheet" href="../assets/template/spica/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/template/spica/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/template/spica/css/style.css">
  <link rel="shortcut icon" href="../assets/template/spica/images/favicon.png" />
  
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
    .loading-spinner {
        display: none;
        text-align: center;
        padding: 20px;
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
    
    <?php include('navbar.php'); ?>
    
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Transaksi Pembelian (Barang Masuk)</h4>
              <div id="alertMessage" style="display:none;" class="alert"></div>
              <form class="forms-sample" id="formPembelian">
                <input type="hidden" id="no_item" name="no_item" value="">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Nomor Faktur Pembelian</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="<?= $no_faktur ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal pembelian</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= date('Y-m-d') ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="supplier" class="col-sm-3 col-form-label">Supplier</label>
                  <div class="col-sm-9">
                    <?php
                        $db = new Database();
                        $suppliers = $db->getSuppliers();
                    ?>
                    <select name="supplier" id="supplier" class="form-control">
                        <option value="">-- Pilih Supplier --</option>
                        <?php foreach($suppliers as $supplier): ?>
                            <option value="<?php echo $supplier['id_supplier']; ?>">
                                <?php echo $supplier['kode_supplier'] . ' - ' . $supplier['nama_supplier']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php $db->closeConnection(); ?>
                  </div>
                </div>
                
                <hr>
                <h5 class="mb-3">Detail Barang</h5>
                
                <div class="form-group row">
                  <label for="kd_barang" class="col-sm-3 col-form-label">Kode Barang</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="kd_barang" name="kd_barang" readonly placeholder="Pilih barang...">
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-primary btn-sm" id="btnLookup" onclick="openLookupModal()">
                      <i class="mdi mdi-magnify"></i> Cari
                    </button>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="kode_jenis" class="col-sm-3 col-form-label">Kode Jenis Barang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="kode_jenis" name="kode_jenis" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="jumlah_barang" class="col-sm-3 col-form-label">Jumlah Barang</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" value="1" min="1" onchange="hitungTotal()">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="stok_saat_ini" class="col-sm-3 col-form-label">Stok Saat Ini</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="stok_saat_ini" name="stok_saat_ini" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="harga_barang" class="col-sm-3 col-form-label">Harga Barang (Satuan)</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="harga_barang" name="harga_barang" readonly>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="total_harga" class="col-sm-3 col-form-label">Total Harga</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary me-2" id="btnSubmit">Submit</button>
                <button type="button" class="btn btn-light" onclick="resetForm()">Cancel</button>
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
            <div class="loading-spinner" id="loadingSpinner">
              <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
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
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        <!-- TABEL DETAIL PEMBELIAN -->
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tabel Detail Pembelian</h4>
              <p class="card-description">Daftar detail transaksi pembelian dari database</p>
              <div id="tableAlert" style="display:none;" class="alert"></div>
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tabelPembelian">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Faktur Pembelian</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Kode Jenis</th>
                      <th>Jenis</th>
                      <th>Jumlah Barang</th>
                      <th>Harga Barang</th>
                      <th>Total Harga</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($data_detail_pembelian)): ?>
                      <?php $no = 1; ?>
                      <?php foreach ($data_detail_pembelian as $row): ?>
                        <tr id="row-<?= $row['no_item']; ?>">
                          <td><?= $no++; ?></td>
                          <td><?= htmlspecialchars($row['no_pembelian']); ?></td>
                          <td><?= htmlspecialchars($row['kd_barang']); ?></td>
                          <td><?= htmlspecialchars($row['nama_barang'] ?? '-'); ?></td>
                          <td><?= htmlspecialchars($row['kode_jenis']); ?></td>
                          <td><?= htmlspecialchars($row['jenis'] ?? '-'); ?></td>
                          <td><?= number_format($row['jumlah_barang'], 0, ',', '.'); ?></td>
                          <td>Rp <?= number_format($row['harga_barang'], 2, ',', '.'); ?></td>
                          <td>Rp <?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                          <td>
                            <button class="btn btn-sm btn-warning" onclick="editDetail(<?= $row['no_item']; ?>)">
                              <i class="mdi mdi-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteDetail(<?= $row['no_item']; ?>)">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="10" class="text-center">Tidak ada data detail pembelian</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
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
    </div>
  </div>

  <script src="../assets/template/spica/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/template/spica/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/template/spica/js/jquery.cookie.js"></script>
  <script src="../assets/template/spica/js/off-canvas.js"></script>
  <script src="../assets/template/spica/js/hoverable-collapse.js"></script>
  <script src="../assets/template/spica/js/template.js"></script>
  <script src="../assets/template/spica/js/dashboard.js"></script>
  
  <script>
    let dataBarang = [];
    
    // Load data barang
    function loadDataBarang() {
        document.getElementById('loadingSpinner').style.display = 'block';
        fetch('crud/get_barang.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('loadingSpinner').style.display = 'none';
                if (data.error) {
                    console.error('Server error:', data.error);
                    showAlert('Gagal memuat data barang: ' + data.error, 'danger');
                    return;
                }
                dataBarang = data;
                renderLookupTable(dataBarang);
            })
            .catch(error => {
                document.getElementById('loadingSpinner').style.display = 'none';
                console.error('Error:', error);
                showAlert('Gagal memuat data barang. Periksa koneksi database.', 'danger');
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
        document.getElementById('kode_jenis').value = item.kode_jenis;
        document.getElementById('stok_saat_ini').value = item.stok;
        document.getElementById('harga_barang').value = 'Rp ' + Number(item.harga).toLocaleString('id-ID');
        document.getElementById('harga_barang').dataset.harga = item.harga;
        closeLookupModal();
        hitungTotal();
    }
    
    // Hitung total
    function hitungTotal() {
        const harga = document.getElementById('harga_barang').dataset.harga;
        const jumlah = parseInt(document.getElementById('jumlah_barang').value) || 1;
        
        if (harga) {
            const total = parseFloat(harga) * jumlah;
            document.getElementById('total_harga').value = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('total_harga').dataset.total = total;
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
    
    // Show alert
    function showAlert(message, type, elementId = 'alertMessage') {
        const alert = document.getElementById(elementId);
        alert.className = `alert alert-${type}`;
        alert.innerHTML = message;
        alert.style.display = 'block';
        setTimeout(() => {
            alert.style.display = 'none';
        }, 5000);
    }
    
    // Submit form (Create/Update)
    document.getElementById('formPembelian').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const noItem = document.getElementById('no_item').value;
        const isUpdate = noItem !== '';
        const url = isUpdate ? 'crud/update.php' : 'crud/create.php';
        
        const formData = new FormData(this);
        
        // Ambil harga asli dari dataset
        formData.set('harga_barang', document.getElementById('harga_barang').dataset.harga || 0);
        formData.set('total_harga', document.getElementById('total_harga').dataset.total || 0);
        
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                resetForm();
                reloadTable();
            } else {
                showAlert(data.message, 'danger');
            }
        })
        .catch(error => {
            showAlert('Error: ' + error.message, 'danger');
        });
    });
    
    // Edit detail
    function editDetail(noItem) {
        fetch(`crud/read.php?action=api&no_item=${noItem}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    showAlert(data.error, 'danger');
                    return;
                }
                
                document.getElementById('no_item').value = data.no_item;
                document.getElementById('no_faktur').value = data.no_pembelian;
                document.getElementById('kd_barang').value = data.kd_barang;
                document.getElementById('nama_barang').value = data.nama_barang;
                document.getElementById('kode_jenis').value = data.kode_jenis;
                document.getElementById('jumlah_barang').value = data.jumlah_barang;
                document.getElementById('harga_barang').value = 'Rp ' + Number(data.harga_barang).toLocaleString('id-ID');
                document.getElementById('harga_barang').dataset.harga = data.harga_barang;
                document.getElementById('total_harga').value = 'Rp ' + Number(data.total_harga).toLocaleString('id-ID');
                document.getElementById('total_harga').dataset.total = data.total_harga;
                
                document.getElementById('btnSubmit').textContent = 'Update';
                window.scrollTo(0, 0);
            })
            .catch(error => {
                showAlert('Error: ' + error.message, 'danger');
            });
    }
    
    // Delete detail
    function deleteDetail(noItem) {
        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }
        
        const formData = new FormData();
        formData.append('no_item', noItem);
        
        fetch('crud/delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success', 'tableAlert');
               