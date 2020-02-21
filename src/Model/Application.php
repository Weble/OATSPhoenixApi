<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class Application extends Model
{
    use HasIds, HasDisplayName, HasTranslatableTexts, HasChoices;

    public function getName(): string
    {
        return $this->get('name', '');
    }

    public function getProducts(): Collection
    {
        return (new Collection($this->get('product', [])))->mapWithKeys(function ($item) {
            $product = new Product($item);
            return [$product->getId() => $product];
        });
    }

    public function getFuelType(): ?TranslatableText
    {
        return $this->getTranslatableText('fueltype');
    }

    public function getCapacities(): ?Choice
    {
        return $this->getChoice('capacity');
    }

    public function getCapacity(string $unit = ''): string
    {
        return implode(" ", array_filter([
            $this->get('display_capacity'),
            $unit
        ]));
    }
}
