<?php

namespace NorthernEstateAgencies\ReapitFoundations\Endpoints;

class PropertyImage extends Endpoint implements EndpointInterface
{

    /**
     * @throws \Exception
     */
    public function all(array $searchCriteria = []): PropertyImage
    {
        $this->get(
            $this->url(Endpoint::PROPERTYIMAGES, $searchCriteria)
        );
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function find(string $resourceId): PropertyImage
    {
        $this->get(
            $this->url(Endpoint::PROPERTYIMAGES . '/' . $resourceId)
        );
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function update(string $resourceId, array $body, string $eTag): PropertyImage
    {
        $this->patch(
            $this->url(Endpoint::PROPERTYIMAGES . '/' . $resourceId),
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
    public function create(array $body): PropertyImage
    {
        $this->post(
            $this->url(Endpoint::PROPERTYIMAGES),
            $body
        );
        return $this;
    }

    public function delete(array $resourceId): PropertyImage
    {
    }
}
