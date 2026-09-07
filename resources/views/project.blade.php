<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $description }}">

        <title>{{ $projectName }} — Magazin de piese auto</title>
    </head>
    <body>
        <header>
            <h1>{{ $projectName }}</h1>
            <p>Versiunea aplicației: {{ $version }}</p>
        </header>

        <main>
            <section>
                <h2>Prezentarea proiectului</h2>
                <p><strong>Tema:</strong> Magazin de piese auto</p>
                <p><strong>Autor:</strong> {{ $author }}</p>
                <p><strong>Grupa:</strong> {{ $group }}</p>
                <p><strong>Descriere:</strong> {{ $description }}</p>
            </section>

            <section>
                <h2>Utilizatorii aplicației</h2>
                <ul>
                    @foreach ($users as $user)
                        <li>{{ $user }}</li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2>Entitățile proiectului</h2>
                <ul>
                    @foreach ($entities as $entity)
                        <li>{{ $entity }}</li>
                    @endforeach
                </ul>
            </section>

            <section>
                <h2>Entitatea principală: Piesă auto</h2>
                <dl>
                    <dt>ID</dt>
                    <dd>{{ $carPart->id }}</dd>

                    <dt>Denumire</dt>
                    <dd>{{ $carPart->name }}</dd>

                    <dt>Cod</dt>
                    <dd>{{ $carPart->code }}</dd>

                    <dt>Categorie</dt>
                    <dd>{{ $carPart->category }}</dd>

                    <dt>Producător</dt>
                    <dd>{{ $carPart->manufacturer }}</dd>

                    <dt>Preț</dt>
                    <dd>{{ number_format($carPart->price, 2, ',', ' ') }} MDL</dd>

                    <dt>Cantitate în stoc</dt>
                    <dd>{{ $carPart->stockQuantity }} bucăți</dd>

                    <dt>Disponibilă</dt>
                    <dd>{{ $carPart->isAvailable ? 'Da' : 'Nu' }}</dd>
                </dl>
            </section>

            <section>
                <h2>Constantele aplicației</h2>
                <p><strong>Pragul stocului redus:</strong> {{ $lowStockThreshold }} bucăți</p>
            </section>
        </main>

        <footer>
            <p>Autor: {{ $author }} | Grupa: {{ $group }} | Versiune: {{ $version }}</p>
        </footer>
    </body>
</html>
