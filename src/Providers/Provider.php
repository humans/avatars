<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers;

interface Provider
{
    public function download(): Response;
}
