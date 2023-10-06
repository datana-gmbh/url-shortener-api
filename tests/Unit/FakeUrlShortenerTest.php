<?php

declare(strict_types=1);

/**
 * This file is part of datana-gmbh/url-shortener-api.
 *
 * (c) Datana GmbH <info@datana.rocks>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\UrlShortener\Api\Tests\Unit;

use Datana\UrlShortener\Api\FakeUrlShortenerApi;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Datana\UrlShortener\Api\FakeUrlShortenerApi
 */
final class FakeUrlShortenerTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function validUsingDefaultDomain(): void
    {
        self::assertSame(
            'https://example.de/99999ebcfdb78df077ad2727fd00969f',
            (new FakeUrlShortenerApi())->generateShortUrl('https://google.com')->getShortUrl(),
        );
    }

    /**
     * @test
     */
    public function validUsingCustomDomain(): void
    {
        self::assertSame(
            'https://foo.de/99999ebcfdb78df077ad2727fd00969f',
            (new FakeUrlShortenerApi())->generateShortUrl('https://google.com', 'foo.de')->getShortUrl(),
        );
    }

    /**
     * @test
     */
    public function throwsInvalidArgumentExceptionOnInvalidDomain(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('$domain must be a non-empty string.');

        (new FakeUrlShortenerApi())->generateShortUrl('https://google.com', '')->getShortUrl();
    }
}
