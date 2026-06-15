<?php
include('koneksi.php');
$action = $_GET['action'];//isi action adalah login
if($action == "login")
    {   session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // menyeleksi data admin dengan username dan password yang sesuai
        $data = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
        $data2 = mysqli_query($koneksi,"select * from tb_customer where email_customer='$username' and pass_customer='$password'");
        $data3 = mysqli_query($koneksi,"select * from tb_supplier where email_supplier='$username' and pass_supplier='$password'");

        $hasil=mysqli_fetch_row($data);
        $hasil2=mysqli_fetch_row($data2);
        $hasil3=mysqli_fetch_row($data3);

        // menghitung jumlah data yang ditemukan
        $cek = mysqli_num_rows($data);
        $cek2 = mysqli_num_rows($data2);
        $cek3 = mysqli_num_rows($data3);
        echo $cek;

        if($cek > 0){
            $_SESSION['username'] = $username;
            $_SESSION['tipe_user'] = "Administrator";
            $tipe_user = $_SESSION['tipe_user'];
            echo "<script>alert('Login Berhasil Selamat Datang - $tipe_user');window.location='backend/admin/index_admin.php';</script>";
        }
        else if($cek2 > 0){
            $_SESSION['username'] = $username;
            $_SESSION['tipe_user'] = "Customer";
            $tipe_user = $_SESSION['tipe_user'];
            echo "<script>alert('Login Berhasil Selamat Datang - $tipe_user');window.location='backend/customer/index_customer.php';</script>";
        }
        else if($cek3 > 0){
            $_SESSION['username'] = $username;
            $_SESSION['tipe_user'] = "Supplier";
            $tipe_user = $_SESSION['tipe_user'];
            echo "<script>alert('Login Berhasil Selamat Datang - $tipe_user');window.location='backend/supplier/index_supplier.php';</script>";
        }
        else{
            echo "<script>alert('Login Gagal Username Password Tidak Sesuai !');window.location='login.php';</script>";
        }
}

else if($action == "add")
{

$kd_barang = $_POST['kd_barang'];
$kode_jenis = $_POST['kode_jenis'];
$nama_barang = $_POST['nama_barang'];
$stok = $_POST['stok'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$gambar_produk = $_FILES['gambar_produk']['name'];

//cek dulu jika ada gambar produk jalankan coding ini
if($gambar_produk != null) {
    $ekstensi_diperbolehkan = array('jpg','png','jpeg'); //ekstensi file gambar yang bisa diupload
    $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                    move_uploaded_file($file_tmp, 'backend/admin/gambar/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                        // Jalankan query INSERT untuk menambah data ke database pastikan sesuai urutan (id tidak perlu karena dibikin otomatis)
                        $query = "INSERT INTO tb_barang (kd_barang,kode_jenis,nama_barang,stok,harga_beli,harga_jual,gambar_produk) VALUES ('$kd_barang', '$kode_jenis', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
                        $result = mysqli_query($koneksi, $query);
                        // periska query apakah ada error
                        if(!$result){
                            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                                 " - ".mysqli_error($koneksi));
                        } else {
                            //tampil alert dan akan redirect ke halaman index.php
                            //silahkan ganti index.php sesuai halaman yang akan dituju
                            echo "<script>alert('Data berhasil ditambah.');window.location='backend/admin/data_barang.php';</script>";
                        }

                 } else {
                    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                     echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='backend/admin/tambah_data_barang.php';</script>";
                 }
  } else {//jika tidak ada gambar maka akan menjalankan coding ini
     $query = "INSERT INTO tb_barang (kd_barang,kode_jenis,nama_barang,stok,harga_beli,harga_jual,gambar_produk) VALUES ('$kd_barang', '$kode_jenis', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', null)";
                        $result = mysqli_query($koneksi, $query);
                        // periska query apakah ada error
                        if(!$result){
                            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                                " - ".mysqli_error($koneksi));
                        } else {
                            //tampil alert dan akan redirect ke halaman index.php
                            //silahkan ganti index.php sesuai halaman yang akan dituju
                            echo "<script>alert('Data berhasil ditambah.');window.location='backend/admin/data_barang.php';</script>";
                        }
    }

}

else if($action == "edit")
{
$kd_barang = $_GET['kd_barang'];
$kd_barang = $_POST['kd_barang'];
$kode_jenis = $_POST['kode_jenis'];
$nama_barang = $_POST['nama_barang'];
$stok = $_POST['stok'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$gambar_produk = $_FILES['gambar_produk']['name'];

  //jalankan apabila terdapat gambar edit yang di upload
if($gambar_produk != "") {
    $ekstensi_diperbolehkan = array('jpg','png','jpeg'); //ekstensi file gambar yang bisa diupload
    $x = explode('.', $gambar_produk); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_produk']['tmp_name'];
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                    move_uploaded_file($file_tmp, '../gambar/'.$nama_gambar_baru); //m
                        // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                    $query = "UPDATE tb_barang SET nama_barang = '$nama_barang', kode_jenis = '$kode_jenis', stok = '$stok', harga_beli = '$harga_beli', harga_jual = '$harga_jual', gambar_produk = '$nama_gambar_baru'";
                    $query .= " WHERE kd_barang = '$kd_barang'";
                    $result = mysqli_query($koneksi, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                            " - ".mysqli_error($koneksi));
                    } else {

                        //tampil alert dan akan redirect ke halaman index.php
                        //silahkan ganti index.php sesuai halaman yang akan dituju
                        echo "<script>alert('Data berhasil diubah.');window.location='data_barang.php';</script>";
                    }
                } else {
                //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.');window.location='edit_data_barang.php';</script>";
                }
        } else {
        // jalankan query UPDATE jika tidak ada gambar edit yg di upload
        $query  = "UPDATE tb_barang SET nama_barang = '$nama_barang', kode_jenis = '$kode_jenis', stok = '$stok', harga_beli = '$harga_beli', harga_jual = '$harga_jual'";
        $query .= "WHERE kd_barang = '$kd_barang'";
        $result = mysqli_query($koneksi, $query);
        // periska query apakah ada error
        if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                " - ".mysqli_error($koneksi));
        } else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='data_barang.php';</script>";
}
}
}

else if($action == "delete")
{
$kd_barang = $_GET['kd_barang'];
$query = "DELETE FROM tb_barang WHERE kd_barang = '$kd_barang'";
$result = mysqli_query($koneksi, $query);
echo "<script>alert('Data berhasil dihapus.');window.location='backend/admin/data_barang.php';</script>";
}
else if($action == "tambah_pembelian")
{
    $no_pembelian = $_POST['no_pembelian' ];
    $tanggal_pembelian = $_POST[ 'tanggal_pembelian' ];
    $id_supplier = $_POST['id_supplier'];
    $total_barangall = null;
    $total_hargaall = null;
try {
    $query = "insert into tb_pembelian values ('$no_pembelian','$tanggal_pembelian', '$id_supplier','$total_barangall', '$total_hargaall')";
    $result = mysqli_query($koneksi, $query);
    echo "<script>alert('Data transaksi pembelian berhasil ditambah. ');window. location='backend/admin/transaksi_pembelian.php' ;< /script>";
    } catch (mysqli_sql_exception $e) {
    var_dump($e);
    echo "<script>alert('Data transaksi pembelian gagal. ');window. location='backend/admin/transaksi_pembelian.php'; </script>";
    }
}

else if($action == "tambah_detail_pembelian")
{
    $no_pembelian = $_POST['no_pembelian' ];
    $kd_barang = $_POST['kd_barang' ];
    $kode_jenis = $_POST['kode_jenis' ];
    $jumlah_barang = $_POST['jumlah_barang' ];
    $harga_barang = $_POST['harga_barang' ];

             $stok = 0;
             $total_harga = 0;
             $total_barang = 0;
             try {
                $stok_barang = mysqli_query($koneksi,"select stok from tb_barang where kd_barang = '$kd_barang'");
                while($d = mysqli_fetch_array($stok_barang)){
                $stok = $d['stok'];
                }

                $stok_terkini = $jumlah_barang + $stok;
                $total_hargasatuan = $jumlah_barang * $harga_barang;

                $query1 = "insert into detail_pembelian values ('$no_pembelian', '$kd_barang', '$kode_jenis', '$jumlah_barang','$harga_barang','$total_hargasatuan','')";
                $query2 = "update tb_barang set stok='$stok_terkini' where kd_barang='$kd_barang'";
                $result1 = mysqli_query($koneksi, $query1);
                $result2 = mysqli_query($koneksi, $query2);

                $total_barangall = mysqli_query($koneksi,"SELECT SUM(jumlah_barang) as jumlah_barangall FROM detail_pembelian where no_pembelian='$no_pembelian'");
                while($d = mysqli_fetch_array($total_barangall)){
                $total_barang = $d['jumlah_barangall'];
                }

                $total_hargaall = mysqli_query($koneksi,"SELECT SUM(total_harga) as jumlah_hargaall FROM detail_pembelian where no_pembelian='$no_pembelian'");
                while($d = mysqli_fetch_array($total_hargaall)){
                $total_harga = $d['jumlah_hargaall'];
                }

                $query3 = "update tb_pembelian set total_barangall='$total_barang', total_hargaall='$total_harga' where no_pembelian='$no_pembelian='$no_pembelian'";
                $result3 = mysqli_query($koneksi, $query3);

                echo "<script>alert('Data transaksi pembelian berhasil.');window.location='backend/admin/detail_pembelian.php?no_pembelian=$no_pembelian';</script>";

                } catch (mysqli_sql_exception $e) {
                    var_dump($e);
                    echo "<script>alert('Data transaksi pembelian gagal.');window.location='backend/admin/detail_pembelian.php?no_pembelian=$no_pembelian';</script>";

                }
}
?>