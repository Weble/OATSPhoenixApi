<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class Application extends Model
{
    use HasIds, HasDisplayName, HasTranslatableTexts, HasChoices;

    /**
     * @var Collection
     */
    protected $notes;

    /**
     * @return Collection|AppNote[]
     */
    public function getNotes(): Collection
    {
        if (!$this->notes) {
            return new Collection([]);
        }

        return $this->notes;
    }

    public function withNotes(Collection $notes): self
    {
        $this->notes = new Collection([]);

        $this->notes = Collection::make($this->get('note_ref', []))->mapWithKeys(function($ref) use ($notes) {
            $ref = new AppNote($ref);
            $note = $notes->get($ref->getId());
            if (!$note) {
                return null;
            }

            return [$ref->getId() => $note];
        })->filter();

        return $this;
    }

    public function getName(): string
    {
        return $this->get('name', '');
    }

    public function getFullName(): ?string
    {
        return implode(" ", array_filter([
            $this->getDisplayName(),
            $this->getCoption()
        ]));
    }

    public function getCoption(): ?string
    {
        return $this->get('display_coption');
    }

    public function hasProducts(): bool
    {
        return $this->getProducts()->count() > 0;
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
