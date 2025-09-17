<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Edit Reservasi - SIMO_Dinkes Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .top-nav { background: #343a40; padding: 10px 20px; color: white; }
        .top-nav a { color: white; margin-left: 15px; text-decoration: none; font-weight: 500; }
        .top-nav a:hover { text-decoration: underline; }
        footer { background: #343a40; color: #ccc; text-align: center; padding: 20px 0; margin-top: 50px; }
    </style>
</head>
<body>

{{-- 🔝 Top Navigation --}}
<nav class="top-nav d-flex justify-content-between align-items-center">
    <span class="fw-bold fs-4">SIMO_Dinkes - Admin</span>
    <div>
        <a href="{{ route('admin.dashboard') }}">Panel Admin</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</nav>

@php $reserva = $reserva ?? null; @endphp

@if($reserva)
    @if($reserva->payment_status === 'pending')
        <div class="alert alert-warning text-center">
            Reservasi #{{ $reserva->id }} sedang menunggu pembayaran.
        </div>
    @elseif($reserva->payment_status === 'paid')
        <div class="alert alert-success text-center">
            Reservasi #{{ $reserva->id }} berhasil dibayar.
        </div>
    @elseif($reserva->payment_status === 'refunded')
        <div class="alert alert-danger text-center">
            Reservasi #{{ $reserva->id }} telah dikembalikan.
        </div>
    @endif
@endif

<div class="container mt-5">
    <h2>Edit Reservasi #{{ $reserva->id }}</h2>

    {{-- Validation Feedback --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Update Form --}}
    <form action="{{ route('admin.reservas.update', $reserva->id) }}" method="POST" class="bg-white p-4 shadow-sm rounded">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Karyawan</label>
            <input type="text" class="form-control" value="{{ $reserva->nome_cliente }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Email Karyawan</label>
            <input type="email" class="form-control" value="{{ $reserva->email }}" disabled>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="data_inicio" class="form-control" value="{{ $reserva->data_inicio->format('Y-m-d') }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Berakhir</label>
                <input type="date" name="data_fim" class="form-control" value="{{ $reserva->data_fim->format('Y-m-d') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Metode Reservasi</label>
            <input type="text" class="form-control" value="{{ ucfirst($reserva->payment_method) }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Status Reservasi</label>
            <select name="payment_status" class="form-select">
                <option value="pending" {{ $reserva->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $reserva->payment_status === 'paid' ? 'selected' : '' }}>Ada Kuitansi</option>
                <option value="refunded" {{ $reserva->payment_status === 'refunded' ? 'selected' : '' }}>Dikembalikan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-sm" style="background-color:gold; color:black; border:none;">Simpan Perubahan</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">Cancel</a>
    </form>
</div>

</body>
</html>
