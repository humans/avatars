<?php

declare(strict_types=1);

namespace Humans\Avatars\Tests\Unit;

use Humans\Avatars\Avatars;
use Humans\Avatars\Providers\Fakes\FailingDownload;
use Humans\Avatars\Providers\Fakes\SuccessfulDownload;
use Humans\Avatars\UnableToFetchAvatar;

describe('attempt', function () {
    it('returns the first successful attempt', function () {
        $avatar = new Avatars;

        $response = $avatar->fetch(
            new SuccessfulDownload('first', 'png'),
            new SuccessfulDownload('second', 'jpg'),
            new SuccessfulDownload('third', 'gif'),
        );

        expect($response)
            ->contents->toBe('first')
            ->extension->toBe('png');
    });

    it('returns the next successful attempt if the first one fails', function () {
        $avatar = new Avatars;

        $response = $avatar->fetch(
            new FailingDownload('some@email.com'),
            new FailingDownload('some.username'),
            new SuccessfulDownload('third', 'jpg'),
            new FailingDownload('Some Name'),
        );

        expect($response)
            ->contents->toBe('third')
            ->extension->toBe('jpg');
    });

    it('throws an exception if all the attempts fail', function () {
        $avatar = new Avatars;

        try {
            $avatar->fetch(
                new FailingDownload('some@email.com'),
                // new SuccessfulDownload('third', 'jpg'),
                new FailingDownload('some.username'),
                new FailingDownload('Some Name'),
            );

            $this->fail('This test should fail since all attempts should fail.');
        } catch (UnableToFetchAvatar $e) {
            expect($e)
                ->toBeInstanceOf(UnableToFetchAvatar::class)
                ->getMessage()->toBe('Unable to find avatars for all the provided handles.');
        }
    });

});
