@extends('layouts.app')

@section('content')
    <div class="content-container inner-page">
        <header class="page-hero">
            <span class="section-label">Suntem aici să ajutăm</span>
            <h1>Contact</h1>
            <p>Contactează magazinul pentru informații despre produse și disponibilitate.</p>
        </header>
        @if ($role->canSubmitContact())
            <form class="contact-form" method="POST" action="{{route('project.contact.submit')}}" novalidate>
                @csrf
                <div class="contact-field">
                    <label for="name">Name</label>
                    <div class="contact-field-control">
                        <input id="name" name="name" value="{{ $formData['name'] }}"
                               aria-invalid="{{ isset($formErrors['name']) ? 'true' : 'false' }}"
                               @if (isset($formErrors['name'])) aria-describedby="name-error" @endif>
                        @if (isset($formErrors['name']))
                            <p id="name-error" class="contact-field-error" role="alert">{{ $formErrors['name'] }}</p>
                        @endif
                    </div>
                </div>

                <div class="contact-field">
                    <label for="email">Email</label>
                    <div class="contact-field-control">
                        <input id="email" name="email" value="{{ $formData['email'] }}"
                               aria-invalid="{{ isset($formErrors['email']) ? 'true' : 'false' }}"
                               @if (isset($formErrors['email'])) aria-describedby="email-error" @endif>
                        @if (isset($formErrors['email']))
                            <p id="email-error" class="contact-field-error" role="alert">{{ $formErrors['email'] }}</p>
                        @endif
                    </div>
                </div>

                <div class="contact-field">
                    <label for="message">Mesa</label>
                    <div class="contact-field-control">
                        <textarea id="message" name="message"
                                  aria-invalid="{{ isset($formErrors['message']) ? 'true' : 'false' }}"
                                  @if (isset($formErrors['message'])) aria-describedby="message-error" @endif>{{ $formData['message'] }}</textarea>
                        @if (isset($formErrors['message']))
                            <p id="message-error" class="contact-field-error"
                               role="alert">{{ $formErrors['message'] }}</p>
                        @endif
                    </div>
                </div>
                <button class="button button-primary" type="submit">Trimite solicitarea</button>
            </form>

        @endif
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
    @if ($successMessage !== null)
        <p>{{ $successMessage }}</p>
        <p>Nume: {{ $formData['name'] }}</p>
        <p>E-mail: {{ $formData['email'] }}</p>
        <p>Mesaj: {{ $formData['message'] }}</p>
    @endif
@endsection
