<!DOCTYPE html>
<html>
<head>
    <title>Detail Pelanggan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 100%;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .details {
            margin-top: 10px;
        }
        .details div {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detail Pelanggan</h1>
        </div>

        <div class="details">
            <div><strong>Nama Pelanggan:</strong> {{ $record->nama }}</div>
            <div><strong>Nomor Handphone:</strong> {{ $record->no_hp }}</div>
            <div><strong>Alamat:</strong> {{ $record->alamat }}</div>
        </div>

        <div class="footer">
            <p>Dibuat pada {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
