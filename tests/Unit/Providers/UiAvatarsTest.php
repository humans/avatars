<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Providers;

use Humans\Avatars\Providers;
use Humans\Avatars\Providers\UiAvatars;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('downloads the ui avatars photo', function () {
    Http::fake([
        'ui-avatars.com/*' => Http::response('<svg>...</svg>', 200),
    ]);

    $options = UiAvatars\Options::new()->format('svg');

    $response = (new UiAvatars('Jaggy Gauran', $options))->download();

    expect($response)
        ->toBeInstanceOf(Providers\Response::class)
        ->contents->toBe('<svg>...</svg>')
        ->extension->toBe('svg');
});

it('throws an exception if the ui avatars request fails', function () {
    Http::fake([
        'ui-avatars.com/*' => Http::response(status: 500),
    ]);

    try {
        (new UiAvatars('jaggy@humans.ph'))->download();

        $this->fail('This should not run successfully.');
    } catch (RequestException $e) {
        expect($e)
            ->toBeInstanceOf(RequestException::class)
            ->getMessage()->toBe('HTTP request returned status code 500');
    }
});

it('returns the proper extension when set manually', function ($format) {
    Http::fake([
        'ui-avatars.com/*' => Http::response(status: 200),
    ]);

    $options = UiAvatars\Options::new()->format($format);

    $response = (new UiAvatars('Jazel Lim', $options))->download();

    expect($response)
        ->extension->toBe($format);
})->with([
    'svg',
    'png',
]);
