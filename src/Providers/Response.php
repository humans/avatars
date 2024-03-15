<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers;

class Response
{
    public function __construct(
        public string $contents,
        public string $extension,
    ) {
    }
}
