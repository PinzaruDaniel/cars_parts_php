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
            <p><strong>Reducerea standard:</strong> {{ number_format($discountPercent, 0) }}%</p>
        </section>

        <section>
            <h2>Calcule pentru piesă</h2>
            <p><strong>Valoarea reducerii:</strong> {{ number_format($discountAmount, 2, ',', ' ') }} MDL</p>
            <p><strong>Preț după reducere:</strong> {{ number_format($priceAfterDiscount, 2, ',', ' ') }} MDL</p>
            <p><strong> Valoarea stocului înainte de
                    reducere:</strong> {{number_format($stockValueBeforeDiscount,2,',', '')}} MDL</p>
            <p><strong>Valoarea stocului după
                    reducere:</strong> {{ number_format($stockValueAfterDiscount, 2, ',', ' ') }} MDL</p>
        </section>

        <section>
            <h2>Scenarii de testare</h2>
            <table>
                <caption>Compararea rezultatelor obținute cu trei seturi de date</caption>
                <thead>
                    <tr>
                        <th scope="col">Piesă</th>
                        <th scope="col">Preț inițial</th>
                        <th scope="col">Stoc</th>
                        <th scope="col">Reducere</th>
                        <th scope="col">Preț redus</th>
                        <th scope="col">Valoare stoc inițială</th>
                        <th scope="col">Valoare stoc redusă</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($testResults as $testResult)
                        <tr>
                            <th scope="row">{{ $testResult['carPart']->name }} ({{ $testResult['carPart']->code }})</th>
                            <td>{{ number_format($testResult['carPart']->price, 2, ',', ' ') }} MDL</td>
                            <td>{{ $testResult['carPart']->stockQuantity }} bucăți</td>
                            <td>{{ number_format($testResult['discountAmount'], 2, ',', ' ') }} MDL</td>
                            <td>{{ number_format($testResult['priceAfterDiscount'], 2, ',', ' ') }} MDL</td>
                            <td>{{ number_format($testResult['stockValueBeforeDiscount'], 2, ',', ' ') }} MDL</td>
                            <td>{{ number_format($testResult['stockValueAfterDiscount'], 2, ',', ' ') }} MDL</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Compararea și documentarea rezultatelor</h3>
            <p>
                Cea mai mare valoare a stocului după reducere aparține piesei
                <strong>{{ $highestStockValueResult['carPart']->name }}</strong>:
                {{ number_format($highestStockValueResult['stockValueAfterDiscount'], 2, ',', ' ') }} MDL.
            </p>
            <p>
                Cea mai mică valoare aparține piesei
                <strong>{{ $lowestStockValueResult['carPart']->name }}</strong>:
                {{ number_format($lowestStockValueResult['stockValueAfterDiscount'], 2, ',', ' ') }} MDL,
                deoarece stocul este zero.
            </p>
            <p>Reducerea standard de {{ number_format($discountPercent) }}% micșorează proporțional prețul și valoarea fiecărui stoc.</p>
        </section>
    </main>

    <footer>
        <p>Autor: {{ $author }} | Grupa: {{ $group }} | Versiune: {{ $version }}</p>
        </footer>
    </body>
</html>
