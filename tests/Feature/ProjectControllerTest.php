<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    public function test_project_presentation_is_displayed(): void
    {
        $response = $this->get('/');

        $response->assertSeeText([
            'Cars Parts',
            'Pînzaru Daniel',
            'PAPP-231',
            'Clienți',
            'Operatori magazin',
            'Administratori',
            'Piesă auto',
            'Categorie',
            'Client',
            'Comandă',
            'Entitatea principală: Piesă auto',
            'ID',
            'Plăcuțe de frână față',
            'Cod',
            'BP-BRE-001',
            'Sistem de frânare',
            'Brembo',
            '849,99 MDL',
            '12 bucăți',
            'Disponibilă',
            'Da',
            'Pragul stocului redus:',
            '5 bucăți',
            'Reducerea standard:',
            '10%',
            'Calcule pentru piesă',
            'Valoarea reducerii:',
            '85,00 MDL',
            'Preț după reducere:',
            '764,99 MDL',
            'Valoarea stocului după reducere:',
            '9 179,89 MDL',
            'Scenarii de testare',
            'Compararea rezultatelor obținute cu trei seturi de date',
            'Filtru de ulei',
            'OF-MAN-002',
            'Kit ambreiaj',
            'CK-LUK-003',
            'Compararea și documentarea rezultatelor',
            'Cea mai mare valoare a stocului după reducere aparține piesei',
            'Cea mai mică valoare aparține piesei',
            'v0.0.2',
        ]);
    }
}
