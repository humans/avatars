<?php

declare(strict_types=1);

namespace Humans\Avatars\Providers\UiAvatars;

class Options
{
    const SupportedFormats = ['svg', 'png'];

    /**
     * @var 'png'|'svg'
     */
    public string $format = 'svg';

    public static function new(): self
    {
        return new self;
    }

    /**
     * @see https://ui-avatars.com/#format
     *
     * @param  'png'|'svg'  $format
     * @return $this
     */
    public function format(string $format): self
    {
        if (! in_array($format, self::SupportedFormats)) {
            throw UnsupportedFormat::format($format);
        }

        $this->format = $format;

        return $this;
    }
}
