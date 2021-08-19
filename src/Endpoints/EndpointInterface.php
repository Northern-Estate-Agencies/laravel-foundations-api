<?php

namespace NorthernEstateAgencies\ReapitFoundations\Endpoints;

interface EndpointInterface
{
    public function all(array $searchCriteria): Endpoint;

    public function find(string $resourceId): Endpoint;
}
