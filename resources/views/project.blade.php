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
        </main>

        <footer>
            <p>Autor: {{ $author }} | Grupa: {{ $group }} | Versiune: {{ $version }}</p>
        </footer>
    </body>
</html>
