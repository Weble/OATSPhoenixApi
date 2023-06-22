<?php


namespace Weble\OATSPhoenixApi\Model;

use Illuminate\Support\Collection;

class ChangeInterval extends Model
{
    /**
     * @var Collection
     */
    protected $applications;

    public function setApplications(Collection $applications): self
    {
        $this->applications = $applications;
        return $this;
    }

    public function getFullApplicationName(): ?string
    {
        return implode(" ", array_filter([
            $this->getApplicationName(),
            $this->getApplicationCoption()
        ]));
    }

    public function getApplicationName(): ?string
    {
        return $this->getApplication() ? $this->getApplication()->get('display_name') : $this->get('@application_name');
    }

    public function getApplicationCoption(): ?string
    {
        return $this->getApplication() ? $this->getApplication()->get('display_coption') : null;
    }

    public function getApplication(?Collection $applications = null): ?Application
    {
        if (!$applications) {
            $applications = $this->applications;
        }

        if (!$applications) {
            return null;
        }

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
