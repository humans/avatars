<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers\UiAvatars;

class UnsupportedFormat extends \Exception
{
    public static function format(string $format): self
    {
        return new self("[{$format}] is not supported by ui-avatars.com.");
    }
}
