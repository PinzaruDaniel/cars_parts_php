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
            'v0.0.1',
        ]);
    }
}
