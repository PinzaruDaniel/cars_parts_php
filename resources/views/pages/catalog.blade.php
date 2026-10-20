@extends('layouts.app')

@section('content')
    <div class="content-container inner-page">
        <header class="page-hero">
            <span class="section-label">Produse disponibile</span>
            <h1>Catalog de piese auto</h1>
            <p>O selecție demonstrativă de produse pentru principalele sisteme ale automobilului.</p>
        </header>
        <form class="catalog-search" method="GET" action="{{ route('project.catalog') }}" role="search" aria-label="Căutare piese auto">
            <label for="search">Denumirea sau codul piesei</label>
            <div class="catalog-search-controls">
                <div class="catalog-search-input">
                    <x-heroicon-o-magnifying-glass class="ui-icon" aria-hidden="true" />
                    <input id="search" type="search" name="q" value="{{ $search }}" placeholder="Ex.: filtru de ulei sau BP-BRE-001">
                </div>
                <button class="button button-primary" type="submit">Caută</button>
            </div>
        </form>
        <section class="product-grid" aria-label="Catalog">
            @forelse($carParts as $carPart)
                <article class="product-card">
                    <div class="product-card-topline">
                        <span>{{ $carPart->code }}</span>
                        <span
                            class="status-dot {{ $carPart->isAvailable ? 'is-available' : 'is-unavailable' }}">{{ $carPart->isAvailable ? 'Disponibil' : 'Indisponibil' }}</span>
                    </div>
                    <h2>{{ $carPart->name }}</h2>
                    <p>{{ $carPart->category }} · {{ $carPart->manufacturer }}</p>
                    <div class="product-card-footer">
                        <strong>{{ number_format($carPart->price, 2, ',', ' ') }} MDL</strong>
                        <span>Stoc: {{ $carPart->stockQuantity }}</span>
                    </div>
                </article>
            @empty
                <p>Nu au fost găsite piese pentru „{{ $search }}”.</p>
            @endforelse
        </section>
    </div>
@endsection
