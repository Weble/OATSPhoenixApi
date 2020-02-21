<?php

namespace Weble\OATSPhoenixApi;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Weble\OATSPhoenixApi\Model\Equipment;
use Weble\OATSPhoenixApi\Model\Index;
use Weble\OATSPhoenixApi\Model\Item;
use Weble\OATSPhoenixApi\Response\Response;

class OATS
{
    /**
     * @var ClientInterface
     */
    protected $client;
    /**
     * @var string
     */
    protected $baseUrl;
    /**
     * @var string
     */
    protected $token;

    public function __construct(string $baseUrl, string $token, ?ClientInterface $client = null)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;

        if (!$client) {
            $client = $this->createClient();
        }

        $this->client = $client;
    }

    protected function createClient(): ClientInterface
    {
        return new Client([
            'base_uri' => $this->getBaseUrl(),
        ]);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * @param string $url
     * @return Equipment|Index|null
     */
    public function browse(string $url = '/browse')
    {
        return $this->get($url)->getData();
    }

    public function get($relativeUri = '/browse')
    {
        $response = $this->client->request('GET', $this->buildUri($relativeUri), [
            'query' => [
                'token' => $this->getToken()
            ]
        ]);

        return $this->parseResponse($response);
    }

    protected function buildUri(string $relativeUri = '/'): UriInterface
    {
        return new Uri($this->getBaseUrl() . $relativeUri . '.json');
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }

    protected function parseResponse(ResponseInterface $response): Response
    {
        if ($response->getStatusCode() < 200 || $response->getStatusCode() > 299) {
            throw new \HttpResponseException($response->getBody(), $response->getStatusCode());
        }

        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        return new Response($data, $this);
    }

    public function manufacturers(): Index
    {
        $this->get('/browse')->getIndex();
    }

    public function seriesFor(Item $manufacturer): Index
    {
        return $this->listFor($manufacturer);
    }

    protected function listFor(Item $item): Index
    {
        return $this->get($item->getHref())->getIndex();
    }

    public function yearsFor(Item $series): Index
    {
        return $this->listFor($series);
    }

    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    public function setClient(ClientInterface $client): self
    {
        $this->client = $client;
        return $this;
    }
}
