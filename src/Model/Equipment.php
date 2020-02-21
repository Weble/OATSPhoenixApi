<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class Equipment extends Item
{
    use HasIds, HasTranslatableTexts;

    public function getLanguage(): ?string
    {
        return $this->get('@language');
    }

    public function getFamily(): ?TranslatableText
    {
        return $this->getTranslatableText('family');
    }

    public function getFamilyGroup(): ?TranslatableText
    {
        return $this->getTranslatableText('family');
    }

    public function getSeries(): Collection
    {
        return collect($this->get('series', []))->map(function ($item) {
            return new TranslatableText($item);
        });
    }

    public function getApplication(): ?Application
    {
        if (!$this->get('application')) {
            return null;
        }
        return new Application($this->get('application'));
    }
}
