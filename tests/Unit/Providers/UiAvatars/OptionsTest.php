<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit\Providers\UiAvatars;

use Humans\Avatars\Providers\UiAvatars\Options;
use Humans\Avatars\Providers\UiAvatars\UnsupportedFormat;

describe('format', function () {
    it('uses svg as the default', function () {
        expect(new Options)->format->toBe('svg');
    });

    it('throws an exception when the given format is not supported', function () {
        try {
            (new Options)->format('not-a-format');
        } catch (UnsupportedFormat $exception) {
            expect($exception)->getMessage()->toBe(
                '[not-a-format] is not supported by ui-avatars.com.'
            );
        }
    });
});
