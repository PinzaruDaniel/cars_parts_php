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
            @if ($canSwitchRole)
                <form class="role-switcher"
                      method="POST"
                      action="{{ route('project.role.switch') }}"
                      aria-labelledby="role-switcher-heading">
                    @csrf

                    <div class="role-switcher-header">
                        <div>
                            <span class="section-label">Mod demonstrativ</span>
                            <h2 id="role-switcher-heading">Alege rolul tău</h2>
                            <p>Descoperă ce poate face fiecare utilizator în Car Parts.</p>
                        </div>
                        <span class="role-current-badge">
                            <span aria-hidden="true"></span>
                            Rol activ: <strong>{{ $role->label() }}</strong>
                        </span>
                    </div>

                    <fieldset class="role-options" @error('role') aria-describedby="role-error" @enderror>
                        <legend>Roluri disponibile</legend>

                        @foreach ($roles as $availableRole)
                            <label class="role-option" for="demo-role-{{ $availableRole->value }}">
                                <input id="demo-role-{{ $availableRole->value }}"
                                       type="radio" name="role" value="{{ $availableRole->value }}"
                                       @checked(old('role', $role->value) === $availableRole->value)
                                       aria-invalid="{{ $errors->has('role') ? 'true' : 'false' }}"
                                       @error('role') aria-describedby="role-error" @enderror>

                                <span class="role-option-icon" aria-hidden="true">
                                    @switch($availableRole)
                                        @case(\App\Enums\Role::Visitor)
                                            <x-heroicon-o-user-circle/>
                                            @break
                                        @case(\App\Enums\Role::Operator)
                                            <x-heroicon-o-wrench-screwdriver/>
                                            @break
                                        @case(\App\Enums\Role::Administrator)
                                            <x-heroicon-o-shield-check/>
                                            @break
                                    @endswitch
                                </span>
                                <span class="role-option-content">
                                    <strong>{{ $availableRole->label() }}</strong>
                                    <span>{{ match ($availableRole) {
                                        \App\Enums\Role::Visitor => 'Explorează catalogul și trimite solicitări.',
                                        \App\Enums\Role::Operator => 'Consultă inventarul, fără modificări.',
                                        \App\Enums\Role::Administrator => 'Adaugă și șterge piese din inventar.',
                                    } }}</span>
                                </span>
                            </label>
                        @endforeach
                    </fieldset>

                    @error('role')
                        <p id="role-error" class="role-switcher-error" role="alert">{{ $message }}</p>
                    @enderror

                    @if (session('roleMessage'))
                        <p class="role-switcher-feedback" role="status">
                            <x-heroicon-o-check-circle aria-hidden="true"/>
                            {{ session('roleMessage') }}
                        </p>
                    @endif

                    <div class="role-switcher-footer">
                        <p>
                            <x-heroicon-o-information-circle aria-hidden="true"/>
                            Simulare locală, fără autentificare reală.
                        </p>
                        <button class="button button-primary role-apply-button" type="submit">
                            Aplică rolul
                            <x-heroicon-o-arrow-right aria-hidden="true"/>
                        </button>
                    </div>
                </form>
            @endif
        </section>
    </div>
@endsection
