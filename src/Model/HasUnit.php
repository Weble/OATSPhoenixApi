<?php


namespace Weble\OATSPhoenixApi\Model;


trait HasUnit
{
    public function getUnitName(): ?string
    {
        return $this->get('@display_unit');
    }

    public function getUnit(): ?string
    {
        return $this->get('@unit');
    }
}
