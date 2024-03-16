<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Providers\Fakes;

use Humans\Avatars\Providers\Fakes\SuccessfulDownload;
use Humans\Avatars\Providers\Response;

it('should always return a valid response', function () {
    $provider = new SuccessfulDownload(
        'I am the image contents',
        'webp',
    );

    $response = $provider->download();

    expect($response)
        ->toBeInstanceOf(Response::class)
        ->contents->toBe('I am the image contents')
        ->extension->toBe('webp');
});
