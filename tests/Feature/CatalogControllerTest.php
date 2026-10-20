<?php

namespace Tests\Feature;

use DOMDocument;
use DOMXPath;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CatalogControllerTest extends TestCase
{
    public function test_search_form_has_a_label_and_submits_the_query_using_get(): void
    {
        $response = $this->getCatalog('');

        $response->assertOk();
        $elements = $this->elements($response);
        $this->assertSame(1, $elements->query('//form[@role="search"][@method="GET"]')->length);
        $form = $elements->query('//form[@role="search"]')->item(0);
        $this->assertSame('/catalog', parse_url($form->getAttribute('action'), PHP_URL_PATH));
        $this->assertSame(1, $elements->query('//form[@role="search"]//label[@for="search"]')->length);
        $this->assertSame(1, $elements->query('//form[@role="search"]//input[@id="search"][@type="search"][@name="q"]')->length);
        $this->assertSame(1, $elements->query('//form[@role="search"]//button[@type="submit"]')->length);
        $this->assertSame(3, $elements->query('//article[@class="product-card"]')->length);
    }

    #[DataProvider('matchingSearches')]
    public function test_search_filters_by_name_or_code_and_keeps_the_query(string $term, string $productName): void
    {
        $response = $this->getCatalog($term);

        $response->assertOk()->assertSeeText($productName);
        $elements = $this->elements($response);
        $this->assertSame($term, $elements->query('//input[@name="q"]')->item(0)->getAttribute('value'));
        $this->assertSame(1, $elements->query('//article[@class="product-card"]')->length);
    }

    public function test_search_without_matches_keeps_the_query_and_displays_a_clean_message(): void
    {
        $response = $this->getCatalog('alternator');

        $response->assertOk()->assertSeeText('Nu au fost găsite piese pentru „alternator”.');
        $elements = $this->elements($response);
        $this->assertSame('alternator', $elements->query('//input[@name="q"]')->item(0)->getAttribute('value'));
        $this->assertSame(0, $elements->query('//article[@class="product-card"]')->length);
    }

    public function test_search_escapes_html_in_the_input_and_in_the_empty_result_message(): void
    {
        $term = '"><script>alert(1)</script>';
        $response = $this->getCatalog($term);

        $response->assertOk()->assertDontSee('<script>alert(1)</script>', false);
        $elements = $this->elements($response);
        $this->assertSame($term, $elements->query('//input[@name="q"]')->item(0)->getAttribute('value'));
        $this->assertSame(0, $elements->query('//article[@class="product-card"]')->length);
    }

    private function getCatalog(string $term): TestResponse
    {
        $previousQuery = $_GET;
        $_GET = ['q' => $term];

        try {
            return $this->get('/catalog?'.http_build_query(['q' => $term]));
        } finally {
            $_GET = $previousQuery;
        }
    }

    private function elements(TestResponse $response): DOMXPath
    {
        $document = new DOMDocument;
        $document->loadHTML('<?xml encoding="UTF-8">'.$response->getContent(), LIBXML_NOERROR | LIBXML_NOWARNING);

        return new DOMXPath($document);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function matchingSearches(): array
    {
        return [
            'name' => ['filtru', 'Filtru de ulei'],
            'code' => ['bp-bre-001', 'Plăcuțe de frână față'],
        ];
    }
}
