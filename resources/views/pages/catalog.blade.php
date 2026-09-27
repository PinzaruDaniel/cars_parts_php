@extends('layouts.app')

@section('content')
    <div class="content-container inner-page">
        <header class="page-hero">
            <span class="section-label">Produse disponibile</span>
            <h1>Catalog de piese auto</h1>
            <p>O selecție demonstrativă de produse pentru principalele sisteme ale automobilului.</p>
        </header>

        <section class="product-grid" aria-label="Catalog">
            @foreach ($carParts as $carPart)
                <article class="product-card">
                    <div class="product-card-topline">
                        <span>{{ $carPart->code }}</span>
                        <span class="status-dot {{ $carPart->isAvailable ? 'is-available' : 'is-unavailable' }}">{{ $carPart->isAvailable ? 'Disponibil' : 'Indisponibil' }}</span>
                    </div>
                    <h2>{{ $carPart->name }}</h2>
                    <p>{{ $carPart->category }} · {{ $carPart->manufacturer }}</p>
                    <div class="product-card-footer">
                        <strong>{{ number_format($carPart->price, 2, ',', ' ') }} MDL</strong>
                        <span>Stoc: {{ $carPart->stockQuantity }}</span>
                    </div>
                </article>
            @endforeach
        </section>
    </div>
@endsection
