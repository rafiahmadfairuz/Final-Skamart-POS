<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Memulai session dan memuat template HTML
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
            echo "<script>alert('Tanggal akhir tidak boleh lebih awal dari tanggal mulai.');</script>";
        } else {
            $data = allHistoryTransaksi($conn, $startDate, $endDate);
        }
    } else {
        $data = allHistoryTransaksi($conn);
    }
}

// Tangkap isi template HTML ke dalam buffer
ob_start();
include 'laporan-cetak.php';
$html = ob_get_clean();

// Konfigurasi Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Memuat HTML ke Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

// Render PDF
$dompdf->render();

// Mengirimkan file PDF ke browser (tanpa mendownload)
$dompdf->stream("invoice.pdf", ["Attachment" => false]);
