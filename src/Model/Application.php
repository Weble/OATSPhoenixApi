<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class Application extends Model
{
    use HasIds, HasTranslatableTexts, HasChoices;

    public function getProducts(): Collection
    {
        return collect($this->get('product', []))->map(function ($item) {
            return new Product($item);
        });
    }

    public function getFuelType(): ?TranslatableText
    {
        return $this->getTranslatableText('fueltype');
    }

    public function getCapacity(): ?Choice
    {
        return $this->getChoice('capacity');
    }
}
