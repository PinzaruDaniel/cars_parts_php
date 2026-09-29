@extends('layouts.app')

@section('content')
    <div class="content-container inner-page auth-page">
        <section class="auth-panel">
            <div class="auth-copy">
                <x-heroicon-o-lock-closed class="auth-icon" aria-hidden="true"/>
                <span class="section-label">Cont utilizator</span>
                <h1>Autentificare</h1>
                <p>Aceasta este interfața demonstrativă. Datele introduse nu sunt verificate și nu sunt salvate.</p>
            </div>
            <form class="auth-form">
                <label for="email">Adresa de email</label>
                <input id="email" type="email" name="email" autocomplete="email" placeholder="nume@exemplu.md">
                <label for="password">Parola</label>
                <input id="password" type="password" name="password" autocomplete="current-password"
                       placeholder="••••••••">
                <label class="checkbox-label"><input type="checkbox" name="remember"> Ține-mă minte</label>
                <button class="button button-primary button-full" type="button">Conectare</button>
            </form>
        </section>
    </div>
@endsection
