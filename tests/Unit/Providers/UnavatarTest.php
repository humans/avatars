<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Providers;

use Humans\Avatars\Providers;
use Humans\Avatars\Providers\Unavatar;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::preventStrayRequests();
});

it('downloads the unavatar photo', function () {
    Http::fake([
        'unavatar.io/*' => Http::response(['url' => 'https://images.weserv.nl/some-path-here'], 200),
        'images.weserv.nl/*' => Http::response('abc-123', 200),
    ]);

    $response = (new Unavatar('jaggy@humans.ph'))->download();

    expect($response)
        ->toBeInstanceOf(Providers\Response::class)
        ->contents->toBe('abc-123')
        ->extension->toBe('png');
});

it('throws an exception if the response url is an avatar fallback.png', function () {
    Http::fake([
        'unavatar.io/*' => Http::response(['url' => 'https://unavatar.io/fallback.png'], 200),
    ]);

    try {
        (new Unavatar('jaggy@humans.ph'))->download();

        $this->fail('This should not run successfully.');
    } catch (Providers\UnavatarFallbackImageFound $throwable) {
        expect($throwable)->toBeInstanceOf(Providers\UnavatarFallbackImageFound::class);
    }
});

it('throws an exception if the unavatar request fails', function () {
    Http::fake([
        'unavatar.io/*' => Http::response(status: 500),
    ]);

    try {
        (new Unavatar('jaggy@humans.ph'))->download();

        $this->fail('This should not run successfully.');
    } catch (RequestException $e) {
        expect($e)
            ->toBeInstanceOf(RequestException::class)
            ->getMessage()->toBe('HTTP request returned status code 500');
    }
});

it('throws an exception if fetching the image fails', function () {
    Http::fake([
        'unavatar.io/*'      => Http::response(['url' => 'https://images.weserv.nl/some-path-here'], 200),
        'images.weserv.nl/*' => Http::response(status: 500),
    ]);

    try {
        (new Unavatar('jaggy@humans.ph'))->download();

        $this->fail('This should not run successfully.');
    } catch (RequestException $e) {
        expect($e)
            ->toBeInstanceOf(RequestException::class)
            ->getMessage()->toBe('HTTP request returned status code 500');
    }
});
