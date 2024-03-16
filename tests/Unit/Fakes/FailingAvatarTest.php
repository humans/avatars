<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Fakes;

use Humans\Avatars\Fakes\FailingAvatars;
use Humans\Avatars\UnableToFetchAvatar;

it('always throw an UnableToFetchAvatar exception', function () {
    try {
        (new FailingAvatars)->fetch();
    } catch (UnableToFetchAvatar $e) {
        expect($e)->getMessage()->toBe('Unable to fetch any of the avatars.');
    }
});
