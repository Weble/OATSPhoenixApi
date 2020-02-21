<?php


namespace Weble\OATSPhoenixApi\Model;


trait HasValue
{
    public function getDisplayValue(): ?string
    {
        return $this->get('@display_value');
    }

    public function getValue(): ?string
    {
        return $this->get('@value');
    }
}
