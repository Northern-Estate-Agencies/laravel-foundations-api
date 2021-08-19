<?php

namespace NorthernEstateAgencies\ReapitFoundations\Entities\Property;

class PropertyCollection
{
    public function __construct(array $properties)
    {
        $collection = new Collection();
        foreach ($properties as $property) {
            $collection->add()
        }
    }
}
