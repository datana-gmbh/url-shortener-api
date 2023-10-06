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
use OskarStark\Value\TrimmedNonEmptyString;

final class FakeUrlShortenerApi implements UrlShortenerApiInterface
{
    public function generateShortUrl(string $targetUrl, ?string $domain = null): UrlShortenerResponse
    {
        if ($domain === null) {
            $domain = 'example.de';
        }

        TrimmedNonEmptyString::fromString(
            $domain,
            '$domain must be a non-empty string.'
        );

        return new UrlShortenerResponse([
            'short_url' => sprintf('https://%s/%s',$domain , md5($targetUrl)),
        ]);
    }
}
