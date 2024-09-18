<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengguna</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Detail Pengguna</h1>
        </div>

        <div class="details">
            <div><strong>Nama:</strong> {{ $record->name }}</div>
            <div><strong>Email:</strong> {{ $record->email }}</div>
            <div><strong>Role:</strong> {{ ucfirst($record->role) }}</div>
            <div><strong>Dibuat Pada:</strong> {{ $record->created_at->format('d F Y') }}</div>
        </div>

        <div class="footer">
            <p>Dibuat pada {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
