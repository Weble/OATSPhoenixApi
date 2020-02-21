<?php


namespace Weble\OATSPhoenixApi\Model;


trait HasIds
{
    public function getId(): ?string
    {
        return $this->get('@id');
    }

    public function getCxid(): ?string
    {
        return $this->get('@cxid');
    }

    public function getBtid(): ?string
    {
        return $this->get('@btid');
    }

    public function getGuid(): ?string
    {
        return $this->get('@guid');
    }
}
