<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    public function test_home_page_displays_project_data_and_lab_results(): void
    {
        $response = $this->get('/');

        $response->assertSeeText([
            'Car Parts',
            'Sisteme de frânare',
            'Motor și consumabile',
            'Transmisie și suspensie',
            'Pînzaru Daniel',
            'PAPP-231',
            'Entitatea principală',
            'Plăcuțe de frână față',
            'BP-BRE-001',
            'Rezultate comerciale',
            '85,00 MDL',
            '764,99 MDL',
            '9 179,89 MDL',
            'Scenarii de testare',
            '3 seturi de date',
            'Versiunea 0.1.0',
        ]);
    }

    public function test_home_page_contains_three_carousel_images_and_navigation(): void
    {
        $response = $this->get('/');

        $response->assertSee([
            'assets/images/brakes.png',
            'assets/images/maintenance.png',
            'assets/images/drivetrain.png',
            'data-carousel-previous',
            'data-carousel-next',
            'data-carousel-dot="0"',
            'data-carousel-dot="1"',
            'data-carousel-dot="2"',
        ], false);

        $this->assertFileExists(public_path('assets/images/brakes.png'));
        $this->assertFileExists(public_path('assets/images/maintenance.png'));
        $this->assertFileExists(public_path('assets/images/drivetrain.png'));
    }

    #[DataProvider('menuPages')]
    public function test_menu_pages_render_shared_header_footer_and_specific_content(
        string $path,
        string $heading,
        string $specificContent,
    ): void {
        $response = $this->get($path);

        $response->assertSeeText([
            'Car Parts',
            'Acasă',
            'Catalog',
            'Servicii',
            'Contact',
            'Autentificare',
            $heading,
            $specificContent,
            'Versiunea 0.1.0',
        ]);
    }

    public function test_login_page_displays_interface_without_submitting_credentials(): void
    {
        $response = $this->get('/autentificare');

        $response->assertSeeText([
            'Adresa de email',
            'Parola',
            'Ține-mă minte',
            'Conectare',
            'interfața demonstrativă',
        ]);
        $response->assertSee('type="button"', false);
        $response->assertDontSee('method="POST"', false);
    }

    /**
     * @return array<string, array{string, string, string}>
     */
    public static function menuPages(): array
    {
        return [
            'catalog' => ['/catalog', 'Catalog de piese auto', 'Plăcuțe de frână față'],
            'servicii' => ['/servicii', 'Servicii', 'Identificarea piesei'],
            'contact' => ['/contact', 'Contact', 'Luni–Vineri'],
            'autentificare' => ['/autentificare', 'Autentificare', 'Adresa de email'],
        ];
    }
}
