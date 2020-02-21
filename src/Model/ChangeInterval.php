<?php


namespace Weble\OATSPhoenixApi\Model;

use Tightenco\Collect\Support\Collection;

class ChangeInterval extends Model
{
    public function getApplicationName(): ?string
    {
        return $this->get('@application_name');
    }

    public function getApplication(Collection $applications): ?Application
    {
        return $applications->get($this->getApplicationId());
    }

    public function getApplicationId(): ?string
    {
        return $this->get('@application_id');
    }

    public function getIntervals(): Collection
    {
        return (new Collection($this->get('interval', [])))->map(function ($interval) {
            return new Interval($interval);
        });
    }
}
