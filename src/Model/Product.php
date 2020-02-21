<?php


namespace Weble\OATSPhoenixApi\Model;

class Product extends Model
{
    use HasIds, HasType;

    public function getChannelName(): ?string
    {
        return $this->get('@channel_name');
    }

    public function getTier(): ?string
    {
        return $this->get('@tier');
    }

    public function getTierName(): ?string
    {
        return $this->get('@tier_name');
    }

    public function getName(): ?string
    {
        return $this->get('name');
    }

    public function getExternalId(): ?string
    {
        return $this->get('external_id');
    }

    public function getExternalData(): ?array
    {
        return $this->get('external_data');
    }
}
