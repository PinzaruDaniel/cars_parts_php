<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
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
            'v0.0.1',
        ]);
    }
}
