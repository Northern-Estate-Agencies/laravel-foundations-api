<?php

namespace NorthernEstateAgencies\ReapitFoundations\Endpoints;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use NorthernEstateAgencies\ReapitFoundations\Foundations;

class Endpoint
{
    public const BASE_URL = 'https://platform.reapit.cloud/';
    public const APPLICANTS = 'applicants';
    public const AREAS = 'areas';
    public const APPOINTEMNTS = 'appointments';
    public const COMPANIES = 'companies';
    public const CONFIGURATION = 'configuration';
    public const CONTACTS = 'contacts';
    public const CONVEYANCING = 'conveyancing';
    public const DEPARTMENTS = 'departments';
    public const DOCUMENTS = 'documents';
    public const ENQUIRIES = 'enquiries';
    public const IDENTITYCHECKS = 'identitychecks';
    public const JOURNALENTRIES = 'journalentries';
    public const LANDLORDS = 'landlords';
    public const METADATA = 'metadata';
    public const METADATASCHEMA = 'metadataschema';
    public const NEGOTIATORS = 'negotiators';
    public const OFFERS = 'offers';
    public const OFFICES = 'offices';
    public const PROPERTIES = 'properties';
    public const PROPERTYIMAGES = 'propertyimages';
    public const RESTHOOKS = 'resthooks';
    public const SOURCES = 'sources';
    public const TASKS = 'tasks';
    public const TENANCIES = 'tenancies';
    public const TRANSACTIONS = 'transactions';
    public const VENDORS = 'vendors';
    public const WORKSORDERS = 'worksorders';

    /**
     * @var Foundations
     */
    private $foundations;

    /**
     * @var int
     */
    protected $pageSize = 25;

    /**
     * @var Response | null
     */
    protected $response = null;

    /**
     * @var int
     */
    protected $pageNumber = 0;

    /**
     * Class constructor.
     * @param Foundations $foundations
     * @throws \Exception
     */
    public function __construct(Foundations $foundations)
    {
        $this->foundations = $foundations;
        if ($this->foundations->getConnection() === null) {
            // TODO: Custom exception.
            throw new \Exception('Connection error, please check your token');
        }
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return string
     */
    protected function url(string $endpoint, array $parameters = []): string
    {
        $parameters['pageSize'] = $this->pageSize;
        $parameters['pageNumber'] = $this->pageNumber;
        return self::BASE_URL . $endpoint . '?' . http_build_query($parameters);
    }

    /**
     * @param string $url
     * @return Endpoint
     * @throws \Exception
     */
    protected function get(string $url): Endpoint
    {
        $response = $this->foundations->getConnection()->get($url);
        if ($response->failed()) {
            // TODO: Custom exception.
            throw new \Exception($response);
        }
        $this->response = $response;
        return $this;
    }

    /**
     * @param string $url
     * @param array $body
     * @return Endpoint
     * @throws \Exception
     */
    protected function post(string $url, array $body): Endpoint
    {
        $response = $this->foundations->getConnection()->post($url, $body);
        if ($response->failed()) {
            // TODO: Custom exception.
            throw new \Exception($response);
        }
        $this->response = $response;
        return $this;
    }

    /**
     * @param string $url
     * @param array $body
     * @return Endpoint
     * @throws \Exception
     */
    protected function patch(string $url, array $body, string $eTag): Endpoint
    {
        $response = $this->foundations->getConnection()->withHeaders(
            [
                'if-match' => $eTag
            ]
        )->post($url, $body);
        if ($response->failed()) {
            // TODO: Custom exception.
            throw new \Exception($response);
        }
        $this->response = $response;
        return $this;
    }
    /**
     * @param string $url
     * @param array $body
     * @return Endpoint
     * @throws \Exception
     */
    protected function put(string $url, array $body): Endpoint
    {
        $response = $this->foundations->getConnection()->put($url, $body);
        if ($response->failed()) {
            // TODO: Custom exception.
            throw new \Exception($response);
        }
        $this->response = $response;
        return $this;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit): Endpoint
    {
        $this->pageSize = $limit;
        return $this;
    }

    /**
     * @param int $pageNumber
     * @return $this
     */
    public function pageNumber(int $pageNumber): Endpoint
    {
        $this->pageNumber = $pageNumber;
        return $this;
    }

    protected function toArray(): array
    {
        return $this->response->json();
    }

    public function toCollection(): Collection
    {
        return collect($this->toArray());
    }

    protected function response(): Response
    {
        return $this->response;
    }
}
