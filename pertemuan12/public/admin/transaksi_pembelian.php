<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../app/classes/database.php';
require_once __DIR__ . '/../crud/admin/read.php';

// Ambil data pembelian untuk tabel
$data_pembelian = getDataPembelian();

// Generate nomor faktur untuk form
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
    .table-hover tbody tr {
        cursor: pointer;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
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
    
    <?php include('navbar.php'); ?>
    
    <div class="main-panel">
      <div class="content-wrapper">
        <!-- Form Transaksi Pembelian -->
        <div class="col-md-8 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Form Transaksi Pembelian (Barang Masuk)</h4>
              <div id="alertMessage" class="alert"></div>
              <form class="forms-sample" id="formPembelianHeader">
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
                        $conn = $db->getConnection();
                        
                        // Query tanpa kode_supplier, hanya id_supplier dan nama_supplier
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
                    <select name="supplier" id="supplier" class="form-control">
                        <option value="">-- Pilih Supplier --</option>
                        <?php foreach($suppliers as $supplier): ?>
                            <option value="<?php echo $supplier['id_supplier']; ?>">
                                <?php echo $supplier['id_supplier'] . ' - ' . $supplier['nama_supplier']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">
                  <i class="mdi mdi-content-save"></i> Buat Transaksi
                </button>
                <button type="button" class="btn btn-light" onclick="resetForm()">
                  <i class="mdi mdi-refresh"></i> Cancel
                </button>
              </form>
            </div>
          </div>
        </div>
        
        <!-- Tabel Pembelian -->
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Tabel Pembelian</h4>
              <p class="card-description">
                Daftar transaksi pembelian dari database
              </p>
              <div id="tableAlert" style="display:none;" class="alert"></div>
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tabelPembelian">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Faktur Pembelian</th>
                      <th>Tanggal Pembelian</th>
                      <th>ID Supplier</th>
                      <th>Nama Supplier</th>
                      <th>Total Barang</th>
                      <th>Total Harga</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($data_pembelian)): ?>
                      <?php $no = 1; ?>
                      <?php foreach ($data_pembelian as $row): ?>
                        <tr id="row-<?= htmlspecialchars($row['no_pembelian']); ?>">
                          <td><?= $no++; ?></td>
                          <td><?= htmlspecialchars($row['no_pembelian']); ?></td>
                          <td><?= date('d-m-Y', strtotime($row['tanggal_pembelian'])); ?></td>
                          <td><?= htmlspecialchars($row['id_supplier']); ?></td>
                          <td><?= htmlspecialchars($row['nama_supplier'] ?? '-'); ?></td>
                          <td><?= number_format($row['total_barangall'], 0, ',', '.'); ?></td>
                          <td>Rp <?= number_format($row['total_hargaall'], 2, ',', '.'); ?></td>
                          <td>
                            <button class="btn btn-sm btn-info" onclick="viewDetail('<?= htmlspecialchars($row['no_pembelian']); ?>')" title="Lihat Detail">
                              <i class="mdi mdi-information-outline"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deletePembelian('<?= htmlspecialchars($row['no_pembelian']); ?>')" title="Hapus">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="8" class="text-center">Tidak ada data pembelian</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal Detail Pembelian -->
      <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="detailModalLabel">Detail Pembelian</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="detailContent">
              <!-- Konten detail akan dimuat via AJAX -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
  
  <!-- Bootstrap JS untuk modal -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
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
    
    // Reset form
    function resetForm() {
        document.getElementById('formPembelianHeader').reset();
        document.getElementById('no_faktur').value = '<?= $no_faktur ?>';
        document.getElementById('tanggal_pembelian').value = '<?= date('Y-m-d') ?>';
    }
    
    // Submit form pembelian header
    document.getElementById('formPembelianHeader').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const noFaktur = document.getElementById('no_faktur').value;
        const tanggalPembelian = document.getElementById('tanggal_pembelian').value;
        const supplier = document.getElementById('supplier').value;
        
        if (!supplier) {
            showAlert('Silakan pilih supplier terlebih dahulu!', 'warning');
            return;
        }
        
        if (!tanggalPembelian) {
            showAlert('Silakan pilih tanggal pembelian!', 'warning');
            return;
        }
        
        // Redirect ke halaman detail transaksi dengan parameter
        window.location.href = `detail_transaksi.php?no_pembelian=${encodeURIComponent(noFaktur)}&supplier=${encodeURIComponent(supplier)}&tanggal=${encodeURIComponent(tanggalPembelian)}`;
    });
    
    // Lihat detail pembelian
    // Lihat detail pembelian
function viewDetail(noPembelian) {
    // Tampilkan loading
    document.getElementById('detailContent').innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"></div><p>Memuat data...</p></div>';
    
    // Buka modal
    $('#detailModal').modal('show');
    
    // Ambil data detail via AJAX
    fetch(`../crud/admin/read.php?action=api&no_pembelian=${encodeURIComponent(noPembelian)}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('detailContent').innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                return;
            }
            
            let html = '';
            
            // Header informasi
            if (data.header) {
                html += `
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr><td width="40%"><strong>No Faktur</strong></td><td>: ${data.header.no_pembelian || '-'}</td></tr>
                                <tr><td><strong>Tanggal</strong></td><td>: ${data.header.tanggal_pembelian ? new Date(data.header.tanggal_pembelian).toLocaleDateString('id-ID') : '-'}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr><td width="40%"><strong>ID Supplier</strong></td><td>: ${data.header.id_supplier || '-'}</td></tr>
                                <tr><td><strong>Nama Supplier</strong></td><td>: ${data.header.nama_supplier || '-'}</td></tr>
                            </table>
                        </div>
                    </div>
                `;
            }
            
            // ... sisa kode untuk tabel detail
        })
        .catch(error => {
            document.getElementById('detailContent').innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        });
}
    
    // Hapus pembelian
    function deletePembelian(noPembelian) {
        if (!confirm(`Apakah Anda yakin ingin menghapus transaksi ${noPembelian}? Semua detail pembelian juga akan dihapus!`)) {
            return;
        }
        
        const formData = new FormData();
        formData.append('no_pembelian', noPembelian);
        formData.append('action', 'delete_header');
        
        fetch('../crud/delete.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success', 'tableAlert');
                // Hapus baris dari tabel
                const row = document.getElementById(`row-${noPembelian}`);
                if (row) {
                    row.remove();
                }
                // Reload halaman setelah 1.5 detik
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showAlert(data.message, 'danger', 'tableAlert');
            }
        })
        .catch(error => {
            showAlert('Error: ' + error.message, 'danger', 'tableAlert');
        });
    }
    
    // Set tanggal default
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('tanggal_pembelian').value) {
            document.getElementById('tanggal_pembelian').value = new Date().toISOString().split('T')[0];
        }
    });
  </script>
</body>
</html>