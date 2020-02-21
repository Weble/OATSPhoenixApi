<?php


namespace Weble\OATSPhoenixApi\Response;


use Tightenco\Collect\Contracts\Support\Arrayable;
use Tightenco\Collect\Contracts\Support\Jsonable;
use Weble\OATSPhoenixApi\Model\Equipment;
use Weble\OATSPhoenixApi\Model\Index;
use Weble\OATSPhoenixApi\OATS;

class Response implements Arrayable, Jsonable
{
    /** @var \DateTimeInterface */
    protected $created;

    /** @var string|null */
    protected $type;

    /** @var Index|null */
    protected $index;

    /** @var Equipment|null */
    protected $equipment;

    /** @var OATS */
    protected $oats;

    public function __construct(array $data, OATS $oats)
    {
        $this->oats = $oats;
        $this->created = $this->parseCreatedTime($data);
        $this->parseIndex($data);
        $this->parseEquipment($data);
    }

    protected function parseCreatedTime(array $data): \DateTimeInterface
    {
        return new \DateTimeImmutable($data['@created'] ?? null);
    }

    protected function parseIndex(array $data): void
    {
        if (!isset($data['index'])) {
            return;
        }

        $this->index = new Index($data['index'], $this->oats);
    }

    protected function parseEquipment(array $data): void
    {
        if (!isset($data['equipment'])) {
            return;
        }

        $this->equipment = new Equipment($data['equipment'], $this->oats);
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function toArray()
    {
        return array_filter([
            'created' => $this->getCreatedTime(),
            'index' => $this->getIndex()->toArray(),
            'equipment' => $this->getEquipment()->toArray(),
        ]);
    }

    public function getCreatedTime(): \DateTimeInterface
    {
        return $this->created;
    }

    public function isIndex(): bool
    {
        return $this->index ? true : false;
    }

    public function isEquipment(): bool
    {
        return $this->equipment ? true : false;
    }

    public function getIndex(): ?Index
    {
        return $this->index;
    }

    public function getEquipment(): ?Equipment
    {
        return $this->equipment;
    }

    /**
     * @return Equipment|Index|null
     */
    public function getData()
    {
        return $this->isEquipment() ? $this->equipment : $this->index;
    }

}
