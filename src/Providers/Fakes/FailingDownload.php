<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers\Fakes;

use Humans\Avatars\Providers\Provider;
use Humans\Avatars\Providers\Response;

class FailingDownload implements Provider
{
    public function __construct(private string $handle)
    {
    }

    public function download(): Response
    {
        throw new FailingAvatarException("Could not download for the handle {$this->handle}");
    }
}
