<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>SIMO_Dinkes - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('https://images.unsplash.com/photo-1504215680853-026ed2a45def') center center / cover no-repeat;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .top-nav a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-weight: 500;
        }
        .top-nav a:hover {
            text-decoration: underline;
        }
        footer .footer-links a {
            color: #ccc;
            text-decoration: none;
        }
        footer .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    {{-- Include the reusable top navigation partial --}}
    @include('profile.partials.topnav')

    {{-- Hero Section --}}
    <section class="hero">
        <div class="container">
            <h1 class="display-4 fw-bold">Sistem Informasi Mobil Operasional</h1>
            <p class="lead">Dinas Kesehatan Kabupaten Kampar</p>
            <a href="#carros" class="btn btn-warning btn-lg mt-3">Lihat Mobil yang Tersedia</a>
        </div>
    </section>

    {{-- Company Highlights --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <h4>1 Lokasi</h4>
                    <p>Menjangkau 21 Kecamatan</p>
                </div>
                <div class="col-md-4">
                    <h4>Berbagai Model</h4>
                    <p>Dari Minibus hingga SUV untuk semua kebutuhan.</p>
                </div>
                <div class="col-md-4">
                    <h4>BBM sesuai spesifikasi</h4>
                    <p>Kembali dalam keadaan bersih, tangki penuh</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Cars --}}
    <section id="carros" class="py-5">
        <div class="container">
            <h2 class="mb-4 text-center">Mobil yang Tersedia</h2>

            {{-- Filter Form --}}
<form method="GET" action="{{ route('home') }}" class="mb-4">
    <div class="row justify-content-center g-3 mb-3">
        {{-- City Filter --}}
        <div class="col-md-4 col-sm-6">
            <input type="text" name="cidade" value="{{ request('cidade') }}" class="form-control" placeholder="Filter lokasi">
        </div>

        {{-- Brand Filter --}}
        <div class="col-md-4 col-sm-6">
            <input type="text" name="marca" value="{{ request('marca') }}" class="form-control" placeholder="Filter merek">
        </div>
    </div>

    {{-- 💰 Single Price Range Slider --}}
    <div class="row justify-content-center g-3 mb-3 text-center">
        <div class="col-md-6 col-sm-8">
            <label for="price_max" class="form-label">Maksimum BBM (Rp.): <span id="priceDisplay">{{ request('price_max', 200000) }}</span></label>
            <input type="range" class="form-range" min="0" max="200000" step="50000" id="price_max" name="price_max" value="{{ request('price_max', 200000) }}">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

            <div class="row">
                @foreach($carros as $carro)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            @if(!empty($carro->imagem))
                                <img src="{{ $carro->imagem }}"
                                     class="card-img-top"
                                     alt="{{ $carro->modelo }}">
                            @else
                                <img src="https://placehold.co/400x250?text={{ urlencode($carro->modelo) }}"
                                     class="card-img-top"
                                     alt="{{ $carro->modelo }}">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $carro->modelo }} ({{ $carro->marca->nome }})</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Warna:</strong> {{ ucfirst($carro->cor) }}</li>
                                    <li><strong>Transmisi:</strong> {{ ucfirst($carro->transmissao) }}</li>
                                    <li><strong>Bahan Bakar:</strong> {{ ucfirst($carro->combustivel) }}</li>
                                    <li><strong>Isi BBM:</strong> Rp.{{ number_format($carro->preco_diario, 2, ',', '.') }}/Hari</li>
                                </ul>
                                <p>
                                    <strong>Lokasi:</strong><br>
                                    @foreach($carro->localizacoes as $loc)
                                        <span class="badge bg-secondary">{{ $loc->cidade }}</span>
                                    @endforeach
                                </p>
                                <a href="/carro/{{ $carro->id }}" class="btn btn-primary mt-2">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-dark text-light pt-5 pb-3">
        <div class="container">
            <div class="row footer-links">
                <div class="col-md-3">
                    <h5>Puskesmas</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://nomorptphn.secretariat.id/login/index">Petapahan</a></li>
                        <li><a href="https://nomorkampa.secretariat.id/login/index">Kampa</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Umum</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://penomoran.secretariat.id/login/index">Nomor Surat</a></li>
                        <li><a href="https://arsip.secretariat.id/login">Arsip Surat</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Hukum</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://regulasi.secretariat.id">Regulasi</a></li>
                        <li><a href="https://lhp.secretariat.id/login">LHP</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Lain-Lain</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://duk-kampar.presensiapp.com/login">DUK</a></li>
                        <li><a href="https://dinkes.kamparkab.go.id">Dinkes</a></li>
                    </ul>
                </div>
            </div>

            <hr class="bg-secondary">

            <div class="text-center text-muted small">
                &copy; {{ date('Y') }} Dinas Kesehatan Kaubupaten Kampar. All rights reserved.
            </div>
        </div>
    </footer>

<script>
    const priceMaxInput = document.getElementById('price_max');
    const priceDisplay = document.getElementById('priceDisplay');

    priceMaxInput.addEventListener('input', () => {
        priceDisplay.textContent = priceMaxInput.value;
    });
</script>
</body>
</html>
