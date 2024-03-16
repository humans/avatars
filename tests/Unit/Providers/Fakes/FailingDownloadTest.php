<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Providers\Fakes;

use Humans\Avatars\Providers\Fakes\FailingAvatarException;
use Humans\Avatars\Providers\Fakes\FailingDownload;

it('only throws an exception', function () {
    $provider = new FailingDownload('Ollie');

    try {
        $provider->download();

        $this->fail('This testing fake should always throw an exception.');
    } catch (FailingAvatarException $e) {
        expect($e)->getMessage()->toBe(
            'Could not download the image for the handle [Ollie]',
        );
    }
});
