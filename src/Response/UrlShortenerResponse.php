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

namespace Datana\UrlShortener\Api\Response;

use Webmozart\Assert\Assert;

final class UrlShortenerResponse
{
    private string $shortUrl;

    /**
     * @param array{short_url: string} $response
     */
    public function __construct(
        array $response,
    ) {
        Assert::notEmpty($response);

        Assert::keyExists($response, 'short_url');
        Assert::stringNotEmpty($response['short_url']);
        $this->shortUrl = $response['short_url'];
    }

    public function getShortUrl(): string
    {
        return $this->shortUrl;
    }
}
