<?php

namespace NorthernEstateAgencies\ReapitFoundations\Endpoints;

class Property extends Endpoint implements EndpointInterface
{

    /**
     * @throws \Exception
     */
    public function all(array $searchCriteria = []): Property
    {
        $this->get(
            $this->url(Endpoint::PROPERTIES, $searchCriteria)
        );
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function find(string $resourceId): Property
    {
        $this->get(
            $this->url(Endpoint::PROPERTIES . '/' . $resourceId)
        );
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function update(string $resourceId, array $body, string $eTag): Property
    {
        $this->patch(
            $this->url(Endpoint::PROPERTIES . '/' . $resourceId),
            $body,
            $eTag
        );
        return $this;
    }

    /**
     * @param string $resourceId
     * @param array $body
     * @return $this
     * @throws \Exception
     */
    public function create(array $body): Property
    {
        $this->post(
            $this->url(Endpoint::PROPERTIES),
            $body
        );
        return $this;
    }

    /**
     * @param string $resourceId
     * @throws \Exception
     */
    public function certificates(string $resourceId)
    {
        $this->get(
            $this->url(Endpoint::PROPERTIES . '/' . $resourceId . '/certificates')
        );
        return $this;
    }
}
