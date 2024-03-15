<?php

declare(strict_types=1);

namespace Humans\Avatars;

interface AvatarsContract
{
    public function fetch(Providers\Provider ...$sources): Providers\Response;
}
