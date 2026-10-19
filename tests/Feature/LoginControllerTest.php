<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    public function test_role_cards_are_grouped_inside_the_login_panel_separately_from_credentials(): void
    {
        $response = $this->get('/autentificare');

        $response->assertSeeText([
            'Alege rolul tău',
            'Explorează catalogul și trimite solicitări.',
            'Consultă inventarul, fără modificări.',
            'Adaugă și șterge piese din inventar.',
            'Simulare locală, fără autentificare reală.',
            'Aplică rolul',
        ]);

        $elements = $this->elements($response);
        $this->assertSame(2, $elements->query('//section[@class="auth-panel"]/form')->length);
        $this->assertSame(1, $elements->query('//section[@class="auth-panel"]/form[@aria-labelledby="role-switcher-heading"]')->length);
        $this->assertSame(3, $elements->query('//fieldset/input | //fieldset/label/input[@name="role"]')->length);
        $this->assertSame(0, $elements->query('//form[@class="auth-form"][@method="POST"]')->length);
    }

    #[DataProvider('roles')]
    public function test_the_active_role_and_checked_option_match_the_session(string $value, string $label): void
    {
        $response = $this->withSession(['demo_role' => $value])->get('/autentificare');

        $elements = $this->elements($response);
        $checked = $elements->query('//input[@name="role"][@checked]');
        $badge = $elements->query('//span[@class="role-current-badge"]')->item(0);

        $this->assertSame(1, $checked->length);
        $this->assertSame($value, $checked->item(0)->getAttribute('value'));
        $this->assertSame('Rol activ: '.$label, preg_replace('/\s+/u', ' ', trim($badge->textContent)));
    }

    #[DataProvider('roles')]
    public function test_applying_a_role_keeps_the_existing_session_workflow(string $value, string $label): void
    {
        $response = $this->post('/autentificare/rol', ['role' => $value]);

        $response->assertRedirectToRoute('project.login');
        $response->assertSessionHas('demo_role', $value);
        $response->assertSessionHas('roleMessage', 'Rolul demonstrativ a fost schimbat.');
    }

    public function test_an_unknown_role_is_rejected_without_replacing_the_active_role(): void
    {
        $response = $this->withSession(['demo_role' => 'operator'])
            ->from('/autentificare')
            ->post('/autentificare/rol', ['role' => 'super-admin']);

        $response->assertSessionHasErrors(['role' => 'Rolul nu este valid.']);
        $response->assertSessionHas('demo_role', 'operator');
    }

    public function test_a_missing_role_shows_the_required_field_message(): void
    {
        $response = $this->from('/autentificare')->post('/autentificare/rol', []);

        $response->assertSessionHasErrors(['role' => 'Alege un rol.']);
        $response->assertSessionMissing('demo_role');
    }

    public function test_role_switching_is_hidden_and_refused_in_production(): void
    {
        $this->app['env'] = 'production';

        $this->get('/autentificare')->assertDontSee('id="role-switcher-heading"', false);
        $this->withSession(['_token' => 'role-switcher-test-token'])
            ->post('/autentificare/rol', [
                'role' => 'administrator',
                '_token' => 'role-switcher-test-token',
            ])
            ->assertForbidden()
            ->assertSessionMissing('demo_role');
    }

    private function elements(TestResponse $response): DOMXPath
    {
        $document = new DOMDocument;
        $document->loadHTML($response->getContent(), LIBXML_NOERROR | LIBXML_NOWARNING);

        return new DOMXPath($document);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function roles(): array
    {
        return [
            'visitor' => ['vizitator', 'Vizitator'],
            'operator' => ['operator', 'Operator'],
            'administrator' => ['administrator', 'Administrator'],
        ];
    }
}
