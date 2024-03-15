<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers;

use Illuminate\Support\Facades\Http;

class UiAvatars implements Provider
{
    private const BASE_URL = 'https://ui-avatars.com';

    public function __construct(private string $handle)
    {
    }

    public function download(): Response
    {
        $response = Http::throw()->baseUrl(self::BASE_URL)->get('api', [
            'name' => $this->handle,
        ]);

        return new Response($response->body(), 'svg');
    }
}
