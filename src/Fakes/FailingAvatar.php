<?php

declare(strict_types=1);

namespace Humans\Avatars\Fakes;

use Humans\Avatars\AvatarsContract;
use Humans\Avatars\Providers;
use Humans\Avatars\UnableToFetchAvatar;

class FailingAvatar implements AvatarsContract
{
    public function fetch(Providers\Provider ...$sources): Providers\Response
    {
        throw new UnableToFetchAvatar('Unable to fetch any of the avatars.');
    }
}
