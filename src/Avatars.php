<?php

declare(strict_types=1);

namespace Humans\Avatars;

class Avatars implements AvatarsContract
{
    public function fetch(Providers\Provider ...$sources): Providers\Response
    {
        foreach ($sources as $provider) {
            try {
                return $provider->download();
            } catch (\Throwable) {
            }
        }

        throw new UnableToFetchAvatar('Unable to find avatars for all the provided handles.');
    }
}
