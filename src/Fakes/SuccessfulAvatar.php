<?php

declare(strict_types=1);

namespace Humans\Avatars\Fakes;

use Humans\Avatars\AvatarsContract;
use Humans\Avatars\Providers;

class SuccessfulAvatar implements AvatarsContract
{
    public function __construct(
        private string $contents,
        private string $extension,
    ) {
    }

    public function fetch(Providers\Provider ...$sources): Providers\Response
    {
        return new Providers\Response(
            $this->contents,
            $this->extension,
        );
    }
}
