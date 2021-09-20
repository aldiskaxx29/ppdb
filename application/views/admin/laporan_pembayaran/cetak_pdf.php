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
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jenis Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Status Bayar</th>
                <th>Waktu Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $index => $item) : ?>
                <?php $kelas = $this->kelas->edit($item->kelas_id) ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $item->nama ?></td>
                    <td><?= $kelas->grade ?> <?= $kelas->nama_kelas ?></td>
                    <td><?= $item->jenis ?></td>
                    <td>Rp. <?= number_format($item->jumlah, 0, ',', '.') ?></td>
                    <td>
                        <?php if ($item->konfirm == 0) : ?>
                            <span class="badge badge-danger">Belum</span>
                        <?php else : ?>
                            <span class="badge badge-success">Sudah</span>
                        <?php endif ?>
                    </td>
                    <td><?= $item->created_at ?></td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="5">Total Pembayaran</td>
                <td colspan="2">Rp. <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>