<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Loader
{
    private const HOST = '89.108.115.241:6969';

    private const KEY = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

    private function getUrl(string $category): string
    {
        return $this::HOST . '/api/' . $category;
    }

    private function getQuery(array $params): array
    {
        $params['key'] = $this::KEY;

        return $params;
    }

    public function call(
        string $category,
        array  $params
    ): ?array {
        $response = Http::get($this->getUrl($category), $this->getQuery($params));

        return $response->json();
    }
}
