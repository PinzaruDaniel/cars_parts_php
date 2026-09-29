@extends('layouts.app')

@section('content')
    <div class="content-container inner-page">
        <header class="page-hero">
            <span class="section-label">Asistență pentru clienți</span>
            <h1>Servicii</h1>
            <p>Te ajutăm să alegi piesa compatibilă și să pregătești corect comanda.</p>
        </header>
        <section class="service-grid" aria-label="Servicii disponibile">
            <article class="info-card">
                <x-heroicon-o-identification class="card-icon" aria-hidden="true"/>
                <h2>Identificarea piesei</h2>
                <p>Verificăm codul și compatibilitatea piesei cu modelul automobilului.</p></article>
            <article class="info-card">
                <x-heroicon-o-chat-bubble-left-right class="card-icon" aria-hidden="true"/>
                <h2>Consultanță tehnică</h2>
                <p>Oferim informații despre producători, alternative și caracteristici.</p></article>
            <article class="info-card">
                <x-heroicon-o-clipboard-document-check class="card-icon" aria-hidden="true"/>
                <h2>Pregătirea comenzii</h2>
                <p>Confirmăm disponibilitatea și pregătim piesele pentru ridicare.</p></article>
        </section>
    </div>
@endsection
