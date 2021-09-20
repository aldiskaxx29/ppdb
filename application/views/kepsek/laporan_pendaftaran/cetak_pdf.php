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
                <th>NISN</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Status Diterima</th>
                <th>Waktu Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $no => $item) : ?>
                <tr>
                    <td><?= $no + 1 ?></td>
                    <td><?= $item->nisn ?></td>
                    <td><?= $item->nama ?></td>
                    <td><?= $item->jenis_kelamin ?></td>
                    <td>
                        <?php if ($item->status == 0) : ?>
                            <span class="badge badge-danger">Belum</span>
                        <?php else : ?>
                            <span class="badge badge-success">Sudah</span>
                        <?php endif ?>
                    </td>
                    <td><?= $item->created ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>