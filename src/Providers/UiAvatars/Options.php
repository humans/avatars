<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers\UiAvatars;

class Options
{
    public string $format = 'svg';

    public static function new(): self
    {
        return new self;
    }

    public function format(string $format): self
    {
        $this->format = $format;

        return $this;
    }
}
