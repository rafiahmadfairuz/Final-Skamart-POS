<?php

session_start();  
require_once "Controllers/paymentController.php";
require_once "Config/database.php";
$conn = connectDatabase();
$data = semuaHistoryTransaksiUser($conn, $_SESSION['kode_user']);
?>
<?php require_once "Components/Head-User.php"; ?>
<?php include 'Components/Navbar-User.php'; ?>  
<div class="container my-5">
    <div class="text-center fw-bold fs-1 d-none d-md-block logo mb-2">Histori Pembelian</div>
    <div class="row column-gap-3 p-3 ms-3">
   <style>
    .main-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .main-table th,
    .main-table td {
        border: 1px solid #ddd;
        padding: 6px;
        text-align: left;
    }

    .main-table th {
        background-color: #f2f2f2;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 10px;
    }

    .main-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>
    <table class="main-table">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode INVOICE</th>
                <th>Tanggal Pemesanan</th>
                <th>Nama Produk</th>
                <th>Total Harga</th>
                <th class="text-center">Dibayar</th>
                <th class="text-center">Kembali</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
$nomor = 1;

if (!empty($data)) { // Jika data tidak kosong
    foreach ($data as $row) {
        ?>
        <tr>
            <td class="text-center"><?= $nomor ?></td>
            <td><?= $row['kode_invoice'] ?></td>
            <td><?= $row['tanggal_transaksi'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td class="text-start">Rp <?= number_format($row['total_barang'], 0, ',', '.') ?></td>
            <td class="text-center">Rp <?= number_format($row['dibayar'], 0, ',', '.') ?></td>
            <td class="text-center">Rp <?= number_format($row['kembali'], 0, ',', '.') ?></td>
            <td class="text-center"><?= $row['status'] ?></td>
            <td class="text-center"> <a href="Components/generatePdf.php?user=<?= $row['id'] ?>" target="_blank" class="btn border rounded btn-sm px-3"><i class="bi bi-printer"></i></a></td>
        </tr>
        <?php
        $nomor++;
    }
} else { // Jika data kosong
    ?>
    <tr>
        <td colspan="9" class="text-center">Belum Ada Transaksi Di Akun Ini</td>
    </tr>
    <?php
}
?>

        </tbody>
    </table>

    <div class=" mt-3 pt-3">
        <h3 class="text-bold text-muted mb-2">Ringkasan Pembelian</h3>
        <table class="table table-borderless w-100">
        <?php
$totalPendapatan = 0;
$totalTransaksi = count($data);
$penjualanTertinggi = 0;
$penjualanTerendah = $totalTransaksi > 0 ? PHP_INT_MAX : 0; // Menghindari kesalahan jika data kosong

foreach ($data as $row) {
    $totalPendapatan += $row['dibayar'] ?? 0;  // Jumlahkan total pembayaran
    if ($row['dibayar'] > $penjualanTertinggi) {
        $penjualanTertinggi = $row['dibayar'];  // Cari penjualan tertinggi
    }
    if ($row['dibayar'] < $penjualanTerendah) {
        $penjualanTerendah = $row['dibayar'];  // Cari penjualan terendah
    }
}
// Menghitung rata-rata per transaksi
$rataRata = $totalTransaksi > 0 ? $totalPendapatan / $totalTransaksi : 0;
?>

            <tr>
                <td>
                    <div class="summary-label">Total Yang Dikeluarkan:</div>
                    <div class="summary-value"><strong>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></strong></div>
                </td>
                <td>
                    <div class="summary-label">Rata-rata per Transaksi:</div>
                    <div class="summary-value"><strong>Rp <?= number_format($rataRata, 0, ',', '.') ?></strong></div>
                </td>
                <td>
                    <div class="summary-label">Total Produk Dibeli:</div>
                    <div class="summary-value"><strong><?= $totalTransaksi ?> pcs</strong></div>
                </td>
                <td>
                    <div class="summary-label">Pembelian Tertinggi:</div>
                    <div class="summary-value"><strong>Rp <?= number_format($penjualanTertinggi, 0, ',', '.') ?></strong></div>
                </td>
                <td>
                    <div class="summary-label">Pembelian Terendah:</div>
                    <div class="summary-value"><strong>Rp <?= number_format($penjualanTerendah, 0, ',', '.') ?></strong></div>
                </td>
            </tr>
        </table>
    </div>
    </div>
  </div>
<?php require_once "Components/ClosingBodyUser.php"; ?>

