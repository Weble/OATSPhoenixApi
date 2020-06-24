<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class Equipment extends Item
{
    use HasIds, HasTranslatableTexts;

    public function getName(): string
    {
        return $this->get('display_name_long', '');
    }

    public function getManufacturer(): string
    {
        return $this->get('manufacturer', '');
    }

    public function getYear(): string
    {
        return $this->get('display_year', '');
    }

    public function getChangeIntervals(): Collection
    {
        return (new Collection($this->get('change_intervals', [])))->mapWithKeys(function($interval){
            $interval = new ChangeInterval($interval);
            $interval->setApplications($this->getApplications());
            return [$interval->getApplicationId() => $interval];
        });
    }

    public function getAppNotes(): Collection
    {
        return (new Collection($this->get('app_note', [])))->mapWithKeys(function($note){
            $note = new AppNote($note);
            return [$note->getId() => $note];
        });
    }

    public function getOtherNotes(): Collection
    {
        return $this->getAppNotes()->filter(function (AppNote $note) {
            return !$note->getNoteIndex();
        });
    }

    public function getModel(): string
    {
        return $this->get('model', '');
    }

    public function getFuelName(): string
    {
        return $this->get('alt_fueltype', $this->getFuelType());
    }

    public function getFuelType(): string
    {
        return $this->getTranslatableText('fueltype') ?: '';
    }

    public function getShortName(): string
    {
        return $this->get('display_name_short', '');
    }

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
        return (new Collection($this->get('series', [])))->map(function ($item) {
            return new TranslatableText($item);
        });
    }

    public function getApplications(): Collection
    {
        return (new Collection($this->get('application', [])))->mapWithKeys(function($application){
            $application = new Application($application);
            $application->withNotes($this->getAppNotes());
            return [$application->getId() => $application];
        });
    }

    public function getCapacityUnit(): string
    {
        return $this->get('capacity_unit', '');
    }
}
