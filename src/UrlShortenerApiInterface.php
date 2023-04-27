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

namespace Datana\UrlShortener\Api;

use Datana\UrlShortener\Api\Response\UrlShortenerResponse;

/**
 * @author Oskar Stark <oskar.stark@googlemail.de>
 */
interface UrlShortenerApiInterface
{
    public function generateShortUrl(string $targetUrl): UrlShortenerResponse;
}
