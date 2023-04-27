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

use OskarStark\Value\TrimmedNonEmptyString;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final class UrlShortenerClient
{
    private HttpClientInterface $client;
    private string $username;
    private string $password;

    public function __construct(
        string $baseUri,
        string $username,
        #[\SensitiveParameter]
        string $password,
    ) {
        $this->client = HttpClient::createForBaseUri($baseUri);
        $this->username = TrimmedNonEmptyString::fromString($username, '$username must not be an empty string')->toString();
        $this->password = TrimmedNonEmptyString::fromString($password, '$password must not be an empty string')->toString();
    }

    /**
     * Requests an HTTP resource.
     *
     * Responses MUST be lazy, but their status code MUST be
     * checked even if none of their public methods are called.
     *
     * Implementations are not required to support all options described above; they can also
     * support more custom options; but in any case, they MUST throw a TransportExceptionInterface
     * when an unsupported option is passed.
     *
     * @param array<mixed> $options
     *
     * @throws TransportExceptionInterface When an unsupported option is passed
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        Assert::notStartsWith($url, 'http', '$url should be relative: Got: %s');
        Assert::startsWith($url, '/', '$url should start with a "/". Got: %s');

        return $this->client->request(
            $method,
            $url,
            array_merge(
                $options,
                [
                    'auth_basic' => [$this->username, $this->password],
                ],
            ),
        );
    }
}
