# url-shortener-api

| Branch    | PHP                                         |
|-----------|---------------------------------------------|
| `master`  | [![PHP][build-status-master-php]][actions]  |

## Usage

### Installation

```bash
composer require datana-gmbh/url-shortener-api
```

### Setup
```php
use Datana\UrlShortener\Api\UrlShortenerClient;

$baseUri = 'https://url-shortner.datana.app';
$username = '...';
$password = '...';

$client = new UrlShortenerClient($baseUri, $username, $password);
```

### Generate short URL

```php
use Datana\UrlShortener\Api\UrlShortenerApi;
use Datana\UrlShortener\Api\UrlShortenerClient;

$client = new UrlShortenerClient(/* ... */);

$api = new UrlShortenerApi($client);
$response = $api->generateShortUrl('https://www.google.com');

$response->getShortUrl(); // returns sth. like https://......./12DDFFS3
```

[build-status-master-php]: https://github.com/datana-gmbh/url-shortener-api/workflows/PHP/badge.svg?branch=master
[coverage-status-master]: https://codecov.io/gh/datana-gmbh/url-shortener-api/branch/master/graph/badge.svg

[actions]: https://github.com/datana-gmbh/url-shortener-api/actions
