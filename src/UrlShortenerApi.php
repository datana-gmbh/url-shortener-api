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
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

final class UrlShortenerApi implements UrlShortenerApiInterface
{
    private UrlShortenerClient $client;
    private LoggerInterface $logger;

    public function __construct(UrlShortenerClient $client, ?LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger ?? new NullLogger();
    }

    public function generateShortUrl(string $targetUrl, ?string $domain = null): UrlShortenerResponse
    {
        $targetUrl = TrimmedNonEmptyString::fromString($targetUrl, '$target must be a non empty string.');

        if ($domain !== null) {
            $domain = TrimmedNonEmptyString::fromString($domain, '$domain must be a non-empty string.');
        }

        try {
            $response = $this->client->request(
                'POST',
                '/api/generate-short-url',
                [
                    'body' => array_filter([
                        'target' => $targetUrl->toString(),
                        'domain' => $domain,
                    ]),
                ],
            );

            $this->logger->debug('Response', $response->toArray(false));

            /** @var array{short_url: string} $array */
            $array = $response->toArray();

            return new UrlShortenerResponse($array);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }
}
