@extends('layouts.app')

@section('content')
    <section class="carousel" aria-label="Categorii recomandate" data-carousel>
        <div class="carousel-track">
            <article class="carousel-slide is-active" aria-hidden="false" data-carousel-slide>
                <button class="carousel-image-button" type="button"
                        aria-label="Mărește imaginea: Componente pentru sistemul de frânare" data-image-preview>
                    <img src="{{ asset('assets/images/brakes.png') }}" alt="Componente pentru sistemul de frânare">
                    <span class="carousel-zoom-hint"><x-heroicon-o-magnifying-glass-plus
                            aria-hidden="true"/>Mărește</span>
                </button>
                <div class="carousel-content">
                    <span class="eyebrow">Siguranță la fiecare drum</span>
                    <h1>Sisteme de frânare</h1>
                    <p>Plăcuțe, discuri și componente atent selectate pentru o frânare sigură.</p>
                    <a class="button button-primary" href="{{ route('project.catalog') }}">Vezi catalogul</a>
                </div>
            </article>

            <article class="carousel-slide" aria-hidden="true" data-carousel-slide>
                <button class="carousel-image-button" type="button"
                        aria-label="Mărește imaginea: Consumabile pentru mentenanța motorului" data-image-preview>
                    <img src="{{ asset('assets/images/maintenance.png') }}"
                         alt="Consumabile pentru mentenanța motorului">
                    <span class="carousel-zoom-hint"><x-heroicon-o-magnifying-glass-plus
                            aria-hidden="true"/>Mărește</span>
                </button>
                <div class="carousel-content">
                    <span class="eyebrow">Întreținere corectă</span>
                    <h2>Motor și consumabile</h2>
                    <p>Filtre, bujii și consumabile pentru funcționarea eficientă a automobilului.</p>
                    <a class="button button-primary" href="{{ route('project.catalog') }}">Descoperă piesele</a>
                </div>
            </article>

            <article class="carousel-slide" aria-hidden="true" data-carousel-slide>
                <button class="carousel-image-button" type="button"
                        aria-label="Mărește imaginea: Componente de transmisie și suspensie" data-image-preview>
                    <img src="{{ asset('assets/images/drivetrain.png') }}" alt="Componente de transmisie și suspensie">
                    <span class="carousel-zoom-hint"><x-heroicon-o-magnifying-glass-plus
                            aria-hidden="true"/>Mărește</span>
                </button>
                <div class="carousel-content">
                    <span class="eyebrow">Control și performanță</span>
                    <h2>Transmisie și suspensie</h2>
                    <p>Componente rezistente pentru o experiență stabilă și confortabilă.</p>
                    <a class="button button-primary" href="{{ route('project.services') }}">Solicită ajutor</a>
                </div>
            </article>
        </div>

        <button class="carousel-arrow carousel-arrow-left" type="button" aria-label="Imaginea precedentă"
                data-carousel-previous>
            <x-heroicon-o-chevron-left class="carousel-arrow-icon" aria-hidden="true"/>
        </button>
        <button class="carousel-arrow carousel-arrow-right" type="button" aria-label="Imaginea următoare"
                data-carousel-next>
            <x-heroicon-o-chevron-right class="carousel-arrow-icon" aria-hidden="true"/>
        </button>

        <div class="carousel-dots" aria-label="Selectează imaginea">
            <button class="carousel-dot is-active" type="button" aria-label="Imaginea 1" aria-current="true"
                    data-carousel-dot="0"></button>
            <button class="carousel-dot" type="button" aria-label="Imaginea 2" aria-current="false"
                    data-carousel-dot="1"></button>
            <button class="carousel-dot" type="button" aria-label="Imaginea 3" aria-current="false"
                    data-carousel-dot="2"></button>
        </div>
    </section>

    <dialog class="image-modal" aria-labelledby="image-modal-title" data-image-modal>
        <div class="image-modal-panel">
            <div class="image-modal-header">
                <h2 id="image-modal-title">Previzualizare imagine</h2>
                <button class="icon-button" type="button" aria-label="Închide imaginea" data-image-modal-close>
                    <x-heroicon-o-x-mark class="ui-icon" aria-hidden="true"/>
                </button>
            </div>
            <img src="" alt="" data-image-modal-content>
        </div>
    </dialog>

    <div class="content-container">
        <section class="page-section intro-grid">
            <div>
                <span class="section-label">Despre proiect</span>
                <h2>{{ $projectName }}</h2>
                <p>{{ $description }}</p>
            </div>
            <dl class="project-summary">
                <div>
                    <dt>Autor</dt>
                    <dd>{{ $author }}</dd>
                </div>
                <div>
                    <dt>Grupa</dt>
                    <dd>{{ $group }}</dd>
                </div>
                <div>
                    <dt>Utilizatori</dt>
                    <dd>{{ implode(', ', $users) }}</dd>
                </div>
                <div>
                    <dt>Entități</dt>
                    <dd>{{ implode(', ', $entities) }}</dd>
                </div>
            </dl>
        </section>

        <section class="page-section">
            <div class="section-heading">
                <div><span class="section-label">Sarcinile 3 și 4</span>
                    <h2>Entitatea principală</h2></div>
                <span
                    class="status-badge {{ $carPart->isAvailable ? 'is-available' : 'is-unavailable' }}">{{ $carPart->isAvailable ? 'Disponibil' : 'Indisponibil' }}</span>
            </div>
            <dl class="detail-grid">
                <div>
                    <dt>ID</dt>
                    <dd>{{ $carPart->id }}</dd>
                </div>
                <div>
                    <dt>Denumire</dt>
                    <dd>{{ $carPart->name }}</dd>
                </div>
                <div>
                    <dt>Cod</dt>
                    <dd>{{ $carPart->code }}</dd>
                </div>
                <div>
                    <dt>Categorie</dt>
                    <dd>{{ $carPart->category }}</dd>
                </div>
                <div>
                    <dt>Producător</dt>
                    <dd>{{ $carPart->manufacturer }}</dd>
                </div>
                <div>
                    <dt>Preț</dt>
                    <dd>{{ number_format($carPart->price, 2, ',', ' ') }} MDL</dd>
                </div>
                <div>
                    <dt>Stoc</dt>
                    <dd>{{ $carPart->stockQuantity }} buc.</dd>
                </div>
                <div>
                    <dt>Prag stoc redus</dt>
                    <dd>{{ $lowStockThreshold }} buc.</dd>
                </div>
            </dl>
        </section>

        <section class="page-section">
            <div class="section-heading">
                <div><span class="section-label">Sarcina 5</span>
                    <h2>Rezultate comerciale</h2></div>
                <span class="discount-badge">Reducere {{ number_format($discountPercent, 0) }}%</span>
            </div>
            <div class="metrics-grid">
                <article class="metric-card">
                    <x-heroicon-o-tag class="card-icon" aria-hidden="true"/>
                    <span>Valoarea reducerii</span><strong>{{ number_format($discountAmount, 2, ',', ' ') }}
                        MDL</strong></article>
                <article class="metric-card metric-card-accent">
                    <x-heroicon-o-calculator class="card-icon" aria-hidden="true"/>
                    <span>Preț după reducere</span><strong>{{ number_format($priceAfterDiscount, 2, ',', ' ') }}
                        MDL</strong></article>
                <article class="metric-card">
                    <x-heroicon-o-cube class="card-icon" aria-hidden="true"/>
                    <span>Stoc înainte de reducere</span><strong>{{ number_format($stockValueBeforeDiscount, 2, ',', ' ') }}
                        MDL</strong></article>
                <article class="metric-card">
                    <x-heroicon-o-chart-bar class="card-icon" aria-hidden="true"/>
                    <span>Stoc după reducere</span><strong>{{ number_format($stockValueAfterDiscount, 2, ',', ' ') }}
                        MDL</strong></article>
            </div>
        </section>

        <section class="page-section">
            <div class="section-heading">
                <div><span class="section-label">Sarcina 7</span>
                    <h2>Scenarii de testare</h2></div>
                <span class="test-count">3 seturi de date</span>
            </div>
            <div class="table-wrapper">
                <table>
                    <caption>Compararea calculelor pentru trei piese auto</caption>
                    <thead>
                    <tr>
                        <th>Piesă</th>
                        <th>Preț</th>
                        <th>Stoc</th>
                        <th>Reducere</th>
                        <th>Preț final</th>
                        <th>Valoare stoc finală</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($testResults as $result)
                        <tr>
                            <th scope="row">{{ $result['carPart']->name }}<small>{{ $result['carPart']->code }}</small>
                            </th>
                            <td>{{ number_format($result['carPart']->price, 2, ',', ' ') }} MDL</td>
                            <td>{{ $result['carPart']->stockQuantity }}</td>
                            <td>{{ number_format($result['discountAmount'], 2, ',', ' ') }} MDL</td>
                            <td>{{ number_format($result['priceAfterDiscount'], 2, ',', ' ') }} MDL</td>
                            <td>{{ number_format($result['stockValueAfterDiscount'], 2, ',', ' ') }} MDL</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="comparison-note">
                <p><strong>Cea mai mare valoare a stocului:</strong> {{ $highestStockValueResult['carPart']->name }}
                    — {{ number_format($highestStockValueResult['stockValueAfterDiscount'], 2, ',', ' ') }} MDL.</p>
                <p><strong>Cea mai mică valoare a stocului:</strong> {{ $lowestStockValueResult['carPart']->name }}
                    — {{ number_format($lowestStockValueResult['stockValueAfterDiscount'], 2, ',', ' ') }} MDL.</p>
            </div>
        </section>
    </div>
@endsection
