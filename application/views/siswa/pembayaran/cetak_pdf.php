<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3><?= $title_pdf; ?></h3>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Tagihan</th>
                <th>Tahun Ajaran</th>
                <th>Jumlah Bayar</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalBayar = 0 ?>
            <?php $telahBayar = 0 ?>
            <?php $kurangBayar = 0 ?>
            <?php foreach ($tagihan as $no => $item) : ?>
                <?php $totalBayar = $totalBayar + intval($item->jumlah_tagihan) ?>
                <?php $tagihanCheck = $this->pembayaran->checkBayar($user->id, $item->id) ?>
                <tr>
                    <td><?= $no + 1 ?></td>
                    <td><?= $item->jenis ?></td>
                    <td><?= $tahun_ajaran ?></td>
                    <td>Rp. <?= number_format($item->jumlah_tagihan, 0, ',', '.') ?></td>
                    <td>
                        <?php if ($tagihanCheck) : ?>
                            <?php if ($tagihanCheck->konfirm == 0) : ?>
                                <?php $kurangBayar = $kurangBayar + intval($item->jumlah_tagihan) ?>
                                Menunggu Konfirmasi
                            <?php else : ?>
                                <?php $telahBayar = $telahBayar + intval($item->jumlah_tagihan) ?>
                                Sudah
                            <?php endif ?>
                        <?php else : ?>
                            <?php $kurangBayar = $kurangBayar + intval($item->jumlah_tagihan) ?>
                            Belum
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="4">Telah di Bayar</td>
                <td>Rp. <?= number_format($telahBayar, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="4">Belum di Bayar</td>
                <td>Rp. <?= number_format($kurangBayar, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td colspan="4">Total Bayar</td>
                <td>Rp. <?= number_format($totalBayar, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>