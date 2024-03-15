<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers;

use Illuminate\Support\Facades\Http;

class Unavatar implements Provider
{
    private const BASE_URL = 'https://unavatar.io';

    public function __construct(private string $handle)
    {
    }

    public function download(): Response
    {
        $response = Http::throw()->baseUrl(self::BASE_URL)->get($this->handle, [
            'json' => true,
        ]);

        $url = $response->json('url');

        if (str_ends_with($url, 'unavatar.io/fallback.png')) {
            throw new UnavatarFallbackImageFound;
        }

        return new Response(Http::throw()->get($url)->body(), 'png');
    }
}
