<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Ask for Help - SIMO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .chat-box {
        max-height: 300px;
        overflow-y: auto;
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 10px;
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .message-user,
    .message-admin {
        padding: 6px 10px;
        border-radius: 10px;
        margin-bottom: 6px;
        max-width: 55%;
        font-size: 13px;
        line-height: 1.3;
        box-shadow: 0 1px 1px rgba(0,0,0,0.05);
        word-wrap: break-word;
        word-break: break-word;
    }

    .message-user {
        background-color: #d1e7dd;
        align-self: flex-end;
        text-align: left;
    }

    .message-admin {
        background-color: #f8d7da;
        align-self: flex-start;
        text-align: left;
    }

    .message-user small,
    .message-admin small {
        font-size: 10px;
        color: #adb5bd;
        display: block;
        margin-top: 2px;
    }

    .input-group {
        max-width: 500px;
        margin: 0 auto;
    }

    .input-group input {
        border-radius: 6px 0 0 6px;
        font-size: 13px;
        padding: 6px 10px;
    }

    .input-group .btn {
        border-radius: 0 6px 6px 0;
        font-size: 13px;
        padding: 6px 12px;
    }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
    <div class="ms-auto">
        <a href="{{ route('home') }}" class="text-white me-3">Home</a>
        <a href="{{ route('reservas.minhas') }}" class="text-white me-3">Kelola Reservasi</a>
        <a href="{{ route('profile.edit') }}" class="text-white me-3">Halo, {{ Auth::user()->name }}</a>
        <a href="{{ route('logout') }}" class="text-white"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</nav>

<div class="container py-5">
    <h3 class="text-center mb-4">Bantuan</h3>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="chat-box">
        @forelse ($messages as $msg)
            <div class="{{ $msg->is_admin ? 'message-admin' : 'message-user' }}">
                <div><strong>{{ $msg->is_admin ? 'Admin' : 'User' }}:</strong> {{ $msg->message }}</div>
                <small>{{ $msg->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @empty
            <p class="text-muted text-center">Belum ada pesan.</p>
        @endforelse
    </div>

    <form method="POST" action="{{ route('messages.store') }}">
        @csrf
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Ketik pesan Anda..." required>
            <button class="btn btn-primary" type="submit">Kirim</button>
        </div>
    </form>
</div>

</body>
</html>
