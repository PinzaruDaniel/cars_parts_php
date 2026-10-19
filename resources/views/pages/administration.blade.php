@extends('layouts.app')

@section('content')
    <div class="content-container inner-page">
        <header class="page-hero">
            <span class="section-label">Gestionarea magazinului</span>
            <h1>Administrare piese</h1>
            <p>Rol demonstrativ: {{ $role->label() }}</p>
            <p>Datele se păstrează temporar în sesiune, fără bază de date.</p>
        </header>

        @if (session('successMessage'))
            <p role="status">{{ session('successMessage') }}</p>
        @endif

        @if ($role->canManageCarParts())
            <h2>Adaugă o piesă</h2>

            <form class="contact-form"
                  method="POST"
                  action="{{ route('project.car-parts.store') }}"
                  novalidate>
                @csrf

                @foreach ([
                    'name' => ['label' => 'Denumire', 'type' => 'text'],
                    'code' => ['label' => 'Cod', 'type' => 'text'],
                    'category' => ['label' => 'Categorie', 'type' => 'text'],
                    'manufacturer' => ['label' => 'Producător', 'type' => 'text'],
                    'price' => ['label' => 'Preț (MDL)', 'type' => 'number', 'step' => '0.01'],
                    'stockQuantity' => ['label' => 'Stoc', 'type' => 'number', 'step' => '1'],
                ] as $field => $settings)
                    <div class="contact-field">
                        <label for="part-{{ $field }}">
                            {{ $settings['label'] }}
                        </label>

                        <div class="contact-field-control">
                            <input id="part-{{ $field }}"
                                   name="{{ $field }}"
                                   type="{{ $settings['type'] }}"
                                   value="{{ is_scalar(old($field)) ? old($field) : '' }}"
                                   required
                                   @if (isset($settings['step']))
                                       min="0" step="{{ $settings['step'] }}"
                                   @endif
                                   aria-invalid="{{ $errors->has($field) ? 'true' : 'false' }}"
                                   @error($field)
                                   aria-describedby="part-{{ $field }}-error"
                                @enderror>

                            @error($field)
                            <p id="part-{{ $field }}-error"
                               class="contact-field-error"
                               role="alert">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                    </div>
                @endforeach

                <div class="contact-field">
                    <input type="hidden" name="isAvailable" value="0">

                    <div class="contact-field-control">
                        <label class="administration-checkbox" for="part-isAvailable">
                            <input id="part-isAvailable"
                                   type="checkbox"
                                   name="isAvailable"
                                   value="1"
                                   @checked(in_array(old('isAvailable', '1'), ['1', 1, true], true))
                                   aria-invalid="{{ $errors->has('isAvailable') ? 'true' : 'false' }}"
                                   @error('isAvailable')
                                   aria-describedby="part-isAvailable-error"
                                @enderror>
                            Disponibilă
                        </label>

                        @error('isAvailable')
                        <p id="part-isAvailable-error"
                           class="contact-field-error"
                           role="alert">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button class="button button-primary" type="submit">
                    <x-heroicon-o-plus class="ui-icon" aria-hidden="true"/>
                    Adaugă piesa
                </button>
            </form>
        @endif

        <h2>Inventarul pieselor</h2>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Piesă / Cod</th>
                    <th>Categorie</th>
                    <th>Producător</th>
                    <th>Preț</th>
                    <th>Stoc</th>
                    <th>Disponibilitate</th>

                    @if ($role->canManageCarParts())
                        <th>Acțiuni</th>
                    @endif
                </tr>
                </thead>

                <tbody>
                @forelse ($carParts as $carPart)
                    <tr>
                        <td>{{ $carPart->id }}</td>
                        <th scope="row">
                            {{ $carPart->name }}
                            <small>{{ $carPart->code }}</small>
                        </th>
                        <td>{{ $carPart->category }}</td>
                        <td>{{ $carPart->manufacturer }}</td>
                        <td>{{ number_format($carPart->price, 2, ',', ' ') }} MDL</td>
                        <td>{{ $carPart->stockQuantity }}</td>
                        <td>{{ $carPart->isAvailable ? 'Da' : 'Nu' }}</td>

                        @if ($role->canManageCarParts())
                            <td>
                                <form method="POST"
                                      action="{{ route('project.car-parts.destroy', ['id' => $carPart->id]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="button" type="submit">
                                        <x-heroicon-o-trash class="ui-icon" aria-hidden="true"/>
                                        Șterge
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $role->canManageCarParts() ? 8 : 7 }}">
                            Inventarul este gol.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
