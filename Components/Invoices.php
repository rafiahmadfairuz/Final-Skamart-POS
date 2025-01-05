<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skamart</title>
  <!-- STYLE CSS -->
  <link rel="stylesheet" href="<?= '../Assets/Css/style.css' ?>">
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container my-5">
    <p class="text-center display-4">Thank you for your purchase</p>
    
    <div class="row mb-5">
      <div class="col-12">
        <ul class="list-unstyled">
          <li>Email Pembeli: <?= $_SESSION['username'] ?></li>
          <li><strong>Invoice: </strong> <?= $data['kode_invoice'] ?></li>
          <li>Tanggal Pembelian: <?= $data['tanggal_transaksi'] ?></li>
          <li>Nama Barang: <?= $data['nama_barang'] ?></li>
        </ul>
      </div>
    </div>
    
    <div class="row mb-5">
      <div class="col-12 col-xl-10">
        <p>Total Harga Barang: <span class="float-end">Rp <?= number_format($data['total_barang'], 0, ',', '.') ?></span></p>
        <p>Dibayar: <span class="float-end">Rp <?= number_format($data['dibayar'], 0, ',', '.') ?></span></p>
        <p>Kembali: <span class="float-end fw-bold">Rp <?= number_format($data['kembali'], 0, ',', '.') ?></span></p>
      </div>
    </div>

    <div class="text-center mt-5">
      <p>Terima kasih telah berbelanja! Semoga belanja Anda menyenangkan.</p>
    </div>
  </div>
</body>
</html>
