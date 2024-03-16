<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Fakes;

use Humans\Avatars\Fakes\SuccessfulAvatars;
use Humans\Avatars\Providers\Response;

it('always returns a successful response', function () {
    $avatars = new SuccessfulAvatars('contents', 'extension');

    $response = $avatars->fetch();

    expect($response)
        ->toBeInstanceOf(Response::class)
        ->contents->toBe('contents')
        ->extension->toBe('extension');
});
