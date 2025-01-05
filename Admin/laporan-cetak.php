<style>
    @page {
        size: A4;
        margin: 15mm 10mm 15mm 10mm;
        margin: 0 0 0;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 11px;
        line-height: 1.3;
        color: #333;
    }

    .title {
        text-align: center;
        margin-bottom: 15px;
    }

    .title h2 {
        margin: 0;
        color: #444;
        font-size: 18px;
    }

    .title h5 {
        margin: 3px 0;
        color: #666;
        font-size: 13px;
    }

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

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .summary-section {
        margin-top: 20px;
        border-top: 2px solid #444;
        padding-top: 15px;
    }

    .summary-title {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #444;
    }

    .summary-table {
        width: 100%;
        border-collapse: collapse;
    }

    .summary-table td {
        padding: 5px;
        vertical-align: top;
        border: none;
    }

    .summary-label {
        font-weight: bold;
        color: #666;
        font-size: 10px;
    }

    .summary-value {
        color: #333;
        font-size: 11px;
    }

    .text-right {
        text-align: right;
    }

    @media print {
        thead {
            display: table-header-group;
        }
    }

    body {
        margin-top: 2cm;
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 2cm;
    }

    .header {
        width: 100%;
        border-bottom: 2px solid #000;
        padding-bottom: 10px;
        margin-bottom: 5px;
    }

    .logo {
        width: 100px;
        height: auto;
    }

    .company-name {
        font-size: 18pt;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .company-address {
        font-size: 10pt;
        line-height: 1.3;
    }

    .document-title {
        font-size: 16pt;
        font-weight: bold;
        margin-top: 15px;
        text-align: center;
    }
</style>
</head>

<body onload="window.print()">

    <table class="header" cellpadding="0" cellspacing="0">
        <tr>
            <td width="75%" style="vertical-align: top; margin-bottom: 20px;">
                <div class="company-name logo text-success text-nowrap">Ecommerce Skamart</div>
                <div class="company-address">
                    Jl. Kyai Mojo Katrungan-Krian, Bakalan, Katrungan,
                    Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61262<br>
                    Telp: (031) 8971207 | Email: smkbisa@example.com
                </div>
            </td>
        </tr>
    </table>

    <div class="title">
        <h2>Laporan Penjualan</h2>
        <h5>Jenis Penjualan: Semua</h5>
    </div>

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

            foreach ($data as $row) {
            ?>
                <tr>
                    <td class="text-center"><?= $nomor ?></td>
                    <td><?= $row['kode_invoice'] ?></td>
                    <td><?= $row['tanggal_transaksi'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td class="text-start">Rp <?= number_format($row['total_barang'] , 0, ',', '.') ?></td>
                    <td class="text-center">Rp <?=  number_format( $row['dibayar'] , 0, ',', '.') ?></td>
                    <td class="text-center">Rp <?=  number_format(  $row['kembali'] , 0, ',', '.') ?></td>
                    <td class="text-center"><?= $row['status'] ?></td>
                </tr>
            <?php
                $nomor++;
            }
            ?>
        </tbody>
    </table>

    <div class="summary-section">
        <h3 class="summary-title">Ringkasan Penjualan</h3>
        <table class="summary-table">
            <?php
            $totalPendapatan = 0;
            $totalTransaksi = count($data);
            $penjualanTertinggi = 0;
            $penjualanTerendah = PHP_INT_MAX; // Menggunakan nilai maksimum integer sebagai pembanding

            foreach ($data as $row) {
                $totalPendapatan += $row['dibayar'];  // Jumlahkan total pembayaran
                if ($row['dibayar'] > $penjualanTertinggi) {
                    $penjualanTertinggi = $row['dibayar'];  // Cari penjualan tertinggi
                }
                if ($row['dibayar'] < $penjualanTerendah) {
                    $penjualanTerendah = $row['dibayar'];  // Cari penjualan terendah
                }
            }

            // Menghitung rata-rata per transaksi
            $rataRata = $totalPendapatan / $totalTransaksi;

            ?>

            <tr>
                <td>
                    <div class="summary-label">Total Pendapatan:</div>
                    <div class="summary-value"><strong>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></strong></div>
                </td>
                <td>
                    <div class="summary-label">Rata-rata per Transaksi:</div>
                    <div class="summary-value">Rp <?= number_format($rataRata, 0, ',', '.') ?></div>
                </td>
                <td>
                    <div class="summary-label">Total Produk Terjual:</div>
                    <div class="summary-value"><?= $totalTransaksi ?> pcs</div>
                </td>
                <td>
                    <div class="summary-label">Penjualan Tertinggi:</div>
                    <div class="summary-value">Rp <?= number_format($penjualanTertinggi, 0, ',', '.') ?></div>
                </td>
                <td>
                    <div class="summary-label">Penjualan Terendah:</div>
                    <div class="summary-value">Rp <?= number_format($penjualanTerendah, 0, ',', '.') ?></div>
                </td>
            </tr>


        </table>
    </div>

    <div class="summary">
        <p class="text-right">Nama Admin: <strong><?= $_SESSION['username'] ?></strong></p>
        <p class="text-right">Tanggal Cetak: <strong><?= date('d F Y H:i:s'); ?></strong></p>
    </div>
    <?php require_once "../Components/ClosingBodyUser.php" ?>