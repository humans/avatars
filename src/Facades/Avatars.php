<?php

declare(strict_types=1);

namespace Humans\Avatars\Facades;

use Humans\Avatars\Fakes\FailingAvatars;
use Humans\Avatars\Fakes\SuccessfulAvatars;
use Humans\Avatars\Providers\Provider;
use Humans\Avatars\Providers\Response;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Response fetch(Provider ...$attempts)
 */
class Avatars extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Humans\Avatars\AvatarsContract::class;
    }

    public static function fail()
    {
        self::swap(new FailingAvatars);
    }

    public static function pass(string $contents, string $extension)
    {
        self::swap(new SuccessfulAvatars($contents, $extension));
    }
}
