<?php

namespace NorthernEstateAgencies\ReapitFoundations;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use NorthernEstateAgencies\ReapitFoundations\Endpoints\Endpoint;
use NorthernEstateAgencies\ReapitFoundations\Endpoints\Property;

class Foundations
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $company;

    /**
     * @var PendingRequest | null
     */
    private $connection = null;

    /**
     * @var Collection
     */
    private $validVersions;

    /**
     * Class constructor.
     * @param string $token
     * @param string $company
     * @param string $version
     */
    public function __construct(string $token, string $company, string $version = '2020-01-31')
    {
        $this->token = $token;
        $this->validVersions = collect(['2020-01-31']);
        $this->setVersion($version);
        $this->company = $company;
        $this->connect();
    }

    public function connect(): Foundations
    {
        $this->connection = Http::withHeaders($this->buildHeaders());
        return $this;
    }

    public function getConnection(): ?PendingRequest
    {
        return $this->connection;
    }

    public function setVersion(string $version): Foundations
    {
        if (!$this->validVersions->contains($version)) {
            // TODO: Custom Exception.
            throw new \BadMethodCallException('Invalid version for Reapit Foundations API');
        }
        $this->version = $version;
        return $this;
    }

    private function buildHeaders(): array
    {
        return [
            'api-version' => $this->version,
            'reapit-customer' => $this->company,
            'Authorization' => 'Bearer ' . $this->token,
        ];
    }

    public function property()
    {
        return new Property($this);
    }
}
