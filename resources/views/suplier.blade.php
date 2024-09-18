<!DOCTYPE html>
<html>
<head>
    <title>Supplier PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #4CAF50;
        }
        p {
            font-size: 14px;
            margin: 5px 0;
        }
        .container {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 10px;
            border-bottom: 2px solid #ddd;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $record->nama_perusahaan }}</h1>
        </div>
        <p><strong>Nama Kontak:</strong> {{ $record->nama }}</p>
        <p><strong>Nomor Handphone:</strong> {{ $record->no_hp }}</p>
        <p><strong>Email:</strong> {{ $record->email }}</p>
        <p><strong>Alamat:</strong> {{ $record->alamat }}</p>
        <p><strong>Alamat Pribadi:</strong> {{ $record->alamat_pribadi }}</p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
</body>
</html>
