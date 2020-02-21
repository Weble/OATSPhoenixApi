<?php


namespace Weble\OATSPhoenixApi\Model;


trait HasDisplayName
{
    public function getDisplayName(): ?string
    {
        return $this->get('@display_name', $this->get('display_name'));
    }
}
