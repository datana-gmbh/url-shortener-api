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

namespace Datana\UrlShortener\Api\Tests\Unit\Response;

use Datana\UrlShortener\Api\Response\UrlShortenerResponse;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Datana\UrlShortener\Api\Response\UrlShortenerResponse
 */
final class UrlShortenerResponseTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function valid(): void
    {
        $shortUrl = 'http://url-shortener.datana.rocks/123';

        self::assertSame(
            $shortUrl,
            (new UrlShortenerResponse(['short_url' => $shortUrl]))->getShortUrl(),
        );
    }
}
