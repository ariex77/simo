@props([
    'client' => 'Cliente',
    'local' => 'Loja Central',
])
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: Arial, sans-serif;
      color: #333;
      line-height: 1.5;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #f9f9f9;
      padding: 20px;
      border-radius: 8px;
    }
    .header {
      background-color: #4f46e5;
      color: white;
      padding: 20px;
      text-align: center;
      border-radius: 8px 8px 0 0;
    }
    .content {
      padding: 20px;
      background-color: white;
    }
    .button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background-color: #4f46e5;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
      font-family: sans-serif;
    }
    .footer {
      font-size: 12px;
      color: #777;
      margin-top: 30px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Konfirmasi Reservasi</h1>
    </div>
    <div class="content">
      <p>Halo, <strong>{{ $client }}</strong>!</p>

      <p>Kami dengan senang hati mengonfirmasi reservasi Anda.</p>

      <p><strong>Pengambilan:</strong> {{ $local }}, dari pukul 08:00 WIB.</p>

      <p>Harap membawa dokumen SPT Anda untuk menyelesaikan pengambilan.</p>

      <p>Terima kasih telah memilih layanan kami! Jika Anda memiliki pertanyaan, kami siap membantu.</p>

      <a href="{{ url('/dashboard') }}" class="button">Akses detail reservasi</a>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} Dinkes Kampar. All rights reserved.
    </div>
  </div>
</body>
</html>
