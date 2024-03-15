<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers\Fakes;

use Humans\Avatars\Providers\Provider;
use Humans\Avatars\Providers\Response;

class SuccessfulDownload implements Provider
{
    public function __construct(
        private string $contents,
        private string $extension
    ) {
    }

    public function download(): Response
    {
        return new Response($this->contents, $this->extension);
    }
}
