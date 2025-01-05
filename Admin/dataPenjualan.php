<?php
require_once "../Components/Head-User.php";
session_start();
require_once "../Controllers/paymentController.php";
require_once "../Config/database.php";
$conn = connectDatabase();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Ambil input dari form
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
    if ($startDate && $endDate) {
        if ($endDate < $startDate) {
            echo "<script>
            alert('Tanggal akhir tidak boleh lebih awal dari tanggal mulai.');
            window.history.back(); // Kembali ke halaman sebelumnya
          </script>";
    exit();
        } else {
            $data = allHistoryTransaksi($conn, $startDate, $endDate);
        }
    } else {
        $data = allHistoryTransaksi($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Skamart</title>
    <!-- STYLE CSS -->
    <link rel="stylesheet" href="<?= '../Assets/Css/style.css' ?>">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include '../Components/Navbar-Admin.php'; ?>
    <div class="container">
        <div class="row column-gap-3 p-3 ms-3">
        <a class="col-4 mt-5 btn btn-success fw-bold text-nowrap" href="cetak.php?<?= http_build_query($_GET) ?>"><i class="bi bi-receipt-cutoff me-3"></i>Export File Pdf</a>

            <div class="container mt-5">
                <form method="GET">
                    <div class=" mb-3 d-flex justify-content-between">
                        <div class="col-sm-4 d-flex align-items-center">
                            <input type="date" name="startDate" id="startDate" class="form-control" required>
                        </div>

                        <div class="col-sm-4 d-flex align-items-center">
                            <input type="date" name="endDate" id="endDate" class="form-control" required>
                        </div>

                        <div class="d-flex">
                            <div class=" ">
                                <button type="submit" class="btn btn-success px-5 mx-2">Kirim</button>
                            </div>
                            <div class=" ">
                                <a href="dataPenjualan.php"  class="btn btn-outline-success px-5">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
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
            </head>

            <body>

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
                                    <td><?= $row['tanggal_transaksi']  ?></td>
                                    <td><?= $row['nama_barang'] ?></td>
                                    <td class="text-start">Rp <?= number_format($row['total_barang'], 0, ',', '.') ?></td>
                                    <td class="text-center">Rp <?= number_format($row['dibayar'], 0, ',', '.') ?></td>
                                    <td class="text-center">Rp <?= number_format($row['kembali'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= $row['status'] ?></td>
                                </tr>
                            <?php
                                $nomor++;
                            }
                        } else { // Jika data kosong
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">Belum Ada Transaksi </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

                <div class=" mt-3 pt-3">
                    <h3 class="text-bold text-muted mb-2">Ringkasan Penjualan</h3>
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
                                <div class="summary-label">Total Pendapatan:</div>
                                <div class="summary-value"><strong>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></strong></div>
                            </td>
                            <td>
                                <div class="summary-label">Rata-rata per Transaksi:</div>
                                <div class="summary-value"><strong>Rp <?= number_format($rataRata, 0, ',', '.') ?></strong></div>
                            </td>
                            <td>
                                <div class="summary-label">Total Produk Terjual:</div>
                                <div class="summary-value"><strong><?= $totalTransaksi ?> pcs</strong></div>
                            </td>
                            <td>
                                <div class="summary-label">Penjualan Tertinggi:</div>
                                <div class="summary-value"><strong>Rp <?= number_format($penjualanTertinggi, 0, ',', '.') ?></strong></div>
                            </td>
                            <td>
                                <div class="summary-label">Penjualan Terendah:</div>
                                <div class="summary-value"><strong>Rp <?= number_format($penjualanTerendah, 0, ',', '.') ?></strong></div>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>