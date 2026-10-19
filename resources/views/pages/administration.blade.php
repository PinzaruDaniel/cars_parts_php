@extends('layouts.app')

@section('content')
    <div class="content-container inner-page">
        <header class="page-hero">
            <span class="section-label">Suntem aici să ajutăm</span>
            <h1>Contact</h1>
            <p>Contactează magazinul pentru informații despre produse și disponibilitate.</p>
        </header>
        <section class="contact-grid" aria-label="Date de contact">
            <article class="info-card">
                <x-heroicon-o-clock class="card-icon" aria-hidden="true"/>
                <h2>Luni–Vineri</h2>
                <p>08:30–18:00<br>Sâmbătă: 09:00–14:00</p></article>
            <article class="info-card">
                <x-heroicon-o-phone class="card-icon" aria-hidden="true"/>
                <h2>Asistență clienți</h2>
                <p><a href="tel:+37360000000">+373 60 000 000</a></p></article>
            <article class="info-card">
                <x-heroicon-o-envelope class="card-icon" aria-hidden="true"/>
                <h2>Mesaj direct</h2>
                <p><a href="mailto:contact@carparts.local">contact@carparts.local</a></p></article>
        </section>
    </div>
@endsection
